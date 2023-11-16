<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marasi;
use App\Models\Yachts;
use App\Models\YachtsMarasi;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class YachtsController extends Controller
{
    public function index(Request $request)
    {
        $emp=Auth::guard('admin')->user();
        if ($request->ajax()) {
            $data = Yachts::query();
            if ($emp->role_id==2){
                $marasi_ids=Marasi::where('employee_id',$emp->id)->pluck('id')->toArray();
                $yacht_ids=YachtsMarasi::wherein('marasi_id',$marasi_ids)->pluck('yacht_id')->toArray();
                $data->wherein('id',$yacht_ids);
            }
            $data = $data->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function ($row) {
                    if (App::getLocale() == 'en') {
                        $name = $row->name_en;
                    } else {
                        $name = $row->name_ar;
                    }
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">' . $name . '</a>';
                    return $name;
                })
                ->addColumn('price', function ($row) {

                    $price = $row->price;

                    return $price;
                })
                ->addColumn('is_approved', function ($row) {
                    $emp=Auth::guard('admin')->user();
                    if ($emp->role_id==2) {
                        $is_approved= $row->is_approved == 1 ? trans("labels.inputs.active") : trans("labels.inputs.in_active");
                    }else{
                        $is_approved = '<select name="is_approved" id="changeStatus" data-control="select2" data-hide-search="true" class="form-select form-select-solid fw-bold" onchange="changeYachtsStatus(' . $row->id . ')"> <option value="1"';
                        $is_approved .= $row->is_approved == 1 ? "selected" : "";
                        $is_approved .= '>' . trans("labels.inputs.active") . '</option> <option value="0"';
                        $is_approved .= $row->is_approved == 0 ? "selected" : "";
                        $is_approved .= '>' . trans("labels.inputs.in_active") . '</option></select>';
                    }

                    return $is_approved;
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<div class="ms-2">
                                <a href="' . route('admin.yachts.show', $row->id) . '" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_approved') == '0' || $request->get('is_approved') == '1') {
                        $instance->where('is_approved', $request->get('is_approved'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name_ar', 'LIKE', "%$search%")
                                ->orWhere('name_en', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name', 'price', 'is_approved', 'checkbox', 'actions'])
                ->make(true);
        }
        return view('admin.yachts.index');
    }

    public function show($id)
    {
        $data = Yachts::with('city', 'country', 'provider', 'specifications')->find($id);
        return view('admin.yachts.show', compact('data'));
    }

    public function updateStatus(Request $request)
    {

        try {
            $yachts = Yachts::find($request->id);
            $yachts->is_approved = $request->status;
            $yachts->save();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
}
