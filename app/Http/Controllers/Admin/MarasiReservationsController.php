<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MarasiReservationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reservations\UpdateRequest;
use App\Http\Requests\Api\Reservations\ReservationsRequest;
use App\Models\Marasi;
use App\Models\MarasiReservations;
use App\Models\Reservations;
use App\Models\User;
use App\Models\Yachts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MarasiReservationsController extends Controller
{
    public function index(){
        $emp=Auth::guard('admin')->user();
        $reservations=MarasiReservations::with('provider')->orderBy('id','DESC');
        if ($emp->role_id==2){
            $marasi_ids=Marasi::where('employee_id',$emp->id)->pluck('id')->toArray();
            $reservations->wherein('marasi_id',$marasi_ids);
        }
        $reservations=$reservations->get()->toArray();
        return view('admin.marasiReservations.index',compact('reservations'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emp=Auth::guard('admin')->user();
        $data=MarasiReservations::with('provider','marasi');
        if ($emp->role_id==2){
            $marasi_ids=Marasi::where('employee_id',$emp->id)->pluck('id')->toArray();
            $data->wherein('marasi_id',$marasi_ids);
        }
        $data=$data->find($id);
        if ($data){
            $data=$data->toArray();
            return view('admin.marasiReservations.show', compact('data'));
        }else{
            abort(403, 'Unauthorized');
        }
    }

    public function print($id)
    {
        $emp=Auth::guard('admin')->user();
        $data=MarasiReservations::with('provider','marasi');
        if ($emp->role_id==2){
            $marasi_ids=Marasi::where('employee_id',$emp->id)->pluck('id')->toArray();
            $data->wherein('marasi_id',$marasi_ids);
        }
        $data=$data->find($id);
        if ($data){
            $data=$data->toArray();
            return view('admin.marasiReservations.print', compact('data'));
        }else{
            abort(403, 'Unauthorized');
        }
    }

    public function updateRequests(UpdateRequest $request){
        $emp=Auth::guard('admin')->user();
        if ($emp->role_id==2) {
            $id = $request->id;
            $marasi_id = $request->marasi_id;
            $employee_id = $emp->id;
            $status = $request->status;
            $checkMarasi = Marasi::where('employee_id', $employee_id)->find($marasi_id);
            $reservations = MarasiReservations::find($id);
            if ($reservations && $checkMarasi) {
                $reservations->update([
                    'reservations_status' => $status,
                ]);

                if ($status == 'in progress') {
                    $statusNameAr = 'الموافقه على';
                    $statusNameEn = $status;
                } elseif ($status == 'completed') {
                    $statusNameAr = 'اكتمال';
                    $statusNameEn = $status;
                } else {
                    $statusNameAr = 'رفض';
                    $statusNameEn = $status;
                }
                $data = [
                    'title_en' => 'Reservations ' . $statusNameEn . ' #' . $reservations->id,
                    'title_ar' => 'تم ' . $statusNameAr . ' الحجز #' . $reservations->id,
                    'body_en' => 'Reservation num #' . $reservations->id . ' has been ' . $statusNameEn,
                    'body_ar' => 'تم ' . $statusNameAr . ' الحجز رقم #' . $reservations->id,
                ];
                $this->sendNotifications(User::class, [$reservations->provider_id], $data);
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['message' => 'error']);
            }
        }else{
            return response()->json(['message' => 'error']);
        }
    }

    public function exportToExcel()
    {
        return Excel::download(new MarasiReservationsExport, 'Marasi Reservations.xlsx');
    }
}
