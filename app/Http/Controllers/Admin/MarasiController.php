<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Employee;
use App\Models\Marasi;
use App\Models\MarasiServices;
use App\Models\Services;
use App\Models\YachtsMarasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MarasiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Marasi::query();
            $emp=Auth::guard('admin')->user();
            if ($emp->role_id==2){
                $data->where('employee_id',$emp->id);
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
                    $is_approved = '<select name="is_approved" id="changeStatus" data-control="select2" data-hide-search="true" class="form-select form-select-solid fw-bold" onchange="changeMarasiStatus(' . $row->id . ')"> <option value="1"';
                    $is_approved .= $row->is_approved == 1 ? "selected" : "";
                    $is_approved .= '>' . trans("labels.inputs.active") . '</option> <option value="0"';
                    $is_approved .= $row->is_approved == 0 ? "selected" : "";
                    $is_approved .= '>' . trans("labels.inputs.in_active") . '</option></select>';

                    return $is_approved;
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<div class="ms-2">
                                <a href="' . route('admin.marasi.show', $row->id) . '" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="' . route('admin.marasi.edit', $row->id) . '" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
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
        return view('admin.marasi.index');
    }

    public function show($id)
    {
        $emp=Auth::guard('admin')->user();
        $data = Marasi::with('city', 'country', 'employee');
        if ($emp->role_id==2){
            $data->where('employee_id',$emp->id);
        }
        $data=$data->findOrFail($id);
        return view('admin.marasi.show', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emp=Auth::guard('admin')->user();
        $data['countries'] = Countries::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        $data['cities'] = Cities::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        $data['owner'] = Employee::select('id', 'name_ar as name')->where('role_id','2')->where('is_active', '1')->get();
        $data['services'] = Services::where('employee_id',$emp->id)->select('id',  'name_' . App::getLocale() . ' as name') ->where('status', true)->get();
        return view('admin.marasi.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'employee_id' => 'required|int|exists:employees,id',
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'address_en' => 'required|string',
            'address_ar' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'country_id' => 'required|int|exists:countries,id',
            'city_id' => 'required|int|exists:cities,id',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'covers' => 'required|array|min:1',
            'covers.*' => 'image|mimes:jpeg,png|max:1024', // Validate each image
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error')->withInput($request->all());
        }
        $row = Marasi::create([
            'employee_id'=>$request->employee_id,
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'address_en'=>$request->address_en,
            'address_ar'=>$request->address_ar,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
            'price'=>$request->price,
            'country_id'=>$request->country_id,
            'city_id'=>$request->city_id,
            'is_discount'=>is_null($request->is_discount) ? 0 : 1,
            'discount_value'=>is_null($request->is_discount) ? 0 : $request->discount,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }
        if (is_array($request->file('covers')) and count($request->file('covers')) > 0){
            foreach ($request->file('covers') as $image) {
                $row->addMedia($image)->toMediaCollection('cover');
            }
        }

        if (is_array($request->services) && count($request->services)>0){
            foreach ($request->services as $services){
                if ($services){
                    MarasiServices::create([
                        'marasi_id'=>$row->id,
                        'services_id'=>$services,
                    ]);
                }
            }
        }

        return redirect('admin/marasi')->with('message', trans('labels.labels.added_successfully'))->with('status', 'success');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emp=Auth::guard('admin')->user();
        if ($emp->role_id==2){
            $data['marasi'] =Marasi::where('employee_id',$emp->id)->FindOrFail($id);
        }else{
            $data['marasi'] =Marasi::FindOrFail($id);
        }
        $data['countries'] = Countries::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        $data['cities'] = Cities::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        $data['services'] = Services::where('employee_id',$emp->id)->select('id',  'name_' . App::getLocale() . ' as name') ->where('status', true)->get();
        $data['selectedServices']=MarasiServices::where('marasi_id',$id)->pluck('services_id')->toArray();
        return view('admin.marasi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'address_en' => 'required|string',
            'address_ar' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'country_id' => 'required|int|exists:countries,id',
            'city_id' => 'required|int|exists:cities,id',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'covers' => 'nullable|array|min:1',
            'covers.*' => 'image|mimes:jpeg,png|max:1024', // Validate each image
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error')->withInput($request->all());
        }

        $data = Marasi::find($request->id);
        $data->update([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'address_en'=>$request->address_en,
            'address_ar'=>$request->address_ar,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
            'price'=>$request->price,
            'country_id'=>$request->country_id,
            'city_id'=>$request->city_id,
            'is_discount'=>is_null($request->is_discount) ? 0 : 1,
            'discount_value'=>is_null($request->is_discount) ? 0 : $request->discount,
            'status' => $request->status ?? 0
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            Media::where('model_type',Marasi::class)->where('model_id',$request->id)->where('collection_name','profile')->delete();
            $data->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        if (is_array($request->file('covers')) and count($request->file('covers')) > 0){
            foreach ($request->file('covers') as $image) {
                $data->addMedia($image)->toMediaCollection('cover');
            }
        }

        MarasiServices::where('marasi_id',$data->id)->delete();
        if (is_array($request->services) && count($request->services)>0){
            foreach ($request->services as $services){
                if ($services){
                    MarasiServices::create([
                        'marasi_id'=>$data->id,
                        'services_id'=>$services,
                    ]);
                }
            }
        }
        return redirect('admin/marasi')->with('message', trans('labels.labels.modified_successfully'))->with('status', 'success');
    }

    public function updateStatus(Request $request)
    {

        try {
            $marasi = Marasi::find($request->id);
            $marasi->is_approved = $request->status;
            $marasi->save();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }

    public function destroy(Request $request)
    {
        try {
            Marasi::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);
    }
}
