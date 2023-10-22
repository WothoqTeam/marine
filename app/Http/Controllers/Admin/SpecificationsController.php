<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
class SpecificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = Specifications::query();

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                    if (App::getLocale() == 'en') {
                        $name = $row->name_en;
                    } else {
                        $name = $row->name_ar;
                    }
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$name.'</a>';
                    return $name;
                })
                ->addColumn('status', function($row){
                    if($row->status == 1) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('labels.inputs.active').'</div>';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('labels.inputs.in_active').'</div>';
                    }

                    return $is_active;
                })
                ->addColumn('actions', function($row){
                    $actions = '<div class="ms-2">
                                <a href="'.route('admin.specifications.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.specifications.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                })
                ->rawColumns(['name','status','checkbox','actions'])
                ->make(true);
        }

        return view('admin.specifications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.specifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'cover' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error')->withInput($request->all());
        }
        $row = Specifications::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'status' => $request->status ?? 0,
        ]);
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $row->addMediaFromRequest('cover')->toMediaCollection('icon');
        }
        return redirect('admin/specifications')->with('message', trans('labels.labels.added_successfully'))->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Specifications::find($id);
        return view('admin.specifications.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data =Specifications::find($id);
        return view('admin.specifications.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Specifications::find($request->id);
        $data->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            Media::where('model_type',Specifications::class)->where('model_id',$request->id)->where('collection_name','icon')->delete();
            $data->addMediaFromRequest('cover')->toMediaCollection('icon');
        }
        return redirect('admin/specifications')->with('message', trans('labels.labels.modified_successfully'))->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            Specifications::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);
    }
}
