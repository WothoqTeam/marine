<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\GasStations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GasStationsController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = GasStations::query();
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
                ->addColumn('actions', function ($row) {
                    $actions = '<div class="ms-2">
                                <a href="' . route('admin.gasStations.show', $row->id) . '" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="' . route('admin.gasStations.edit', $row->id) . '" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name_ar', 'LIKE', "%$search%")
                                ->orWhere('name_en', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name', 'checkbox', 'actions'])
                ->make(true);
        }
        return view('admin.gasStations.index');
    }

    public function show($id)
    {
        $data = GasStations::with('city', 'country');
        $data=$data->findOrFail($id);
        return view('admin.gasStations.show', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['countries'] = Countries::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        $data['cities'] = Cities::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        return view('admin.gasStations.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'address_en' => 'required|string',
            'address_ar' => 'required|string',
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
        $row = GasStations::create([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'address_en'=>$request->address_en,
            'address_ar'=>$request->address_ar,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
            'country_id'=>$request->country_id,
            'city_id'=>$request->city_id,
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

        return redirect('admin/gasStations')->with('message', trans('labels.labels.added_successfully'))->with('status', 'success');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['gasStations'] =GasStations::FindOrFail($id);
        $data['countries'] = Countries::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        $data['cities'] = Cities::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        return view('admin.gasStations.edit', compact('data'));
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

        $data = GasStations::find($request->id);
        $data->update([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'description_en'=>$request->description_en,
            'description_ar'=>$request->description_ar,
            'address_en'=>$request->address_en,
            'address_ar'=>$request->address_ar,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
            'country_id'=>$request->country_id,
            'city_id'=>$request->city_id,
            'status' => $request->status ?? 0
        ]);

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            Media::where('model_type',GasStations::class)->where('model_id',$request->id)->where('collection_name','profile')->delete();
            $data->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        if (is_array($request->file('covers')) and count($request->file('covers')) > 0){
            foreach ($request->file('covers') as $image) {
                $data->addMedia($image)->toMediaCollection('cover');
            }
        }
        return redirect('admin/gasStations')->with('message', trans('labels.labels.modified_successfully'))->with('status', 'success');
    }

    public function destroy(Request $request)
    {
        try {
            GasStations::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);
    }
}
