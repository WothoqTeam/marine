<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvBanners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = AdvBanners::query();

            return Datatables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function($row){
                        $name=trans('labels.banners_tap').' #'.$row->id;
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
                                <a href="'.route('admin.banners.show', $row->id).'" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="'.route('admin.banners.edit', $row->id).'" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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

        return view('admin.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'cover' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error')->withInput($request->all());
        }
        $row = AdvBanners::create([
            'status' => $request->status ?? 0,
        ]);
        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            $row->addMediaFromRequest('cover')->toMediaCollection('cover');
        }
        return redirect('admin/banners')->with('message', trans('labels.labels.added_successfully'))->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=AdvBanners::find($id);
        return view('admin.banners.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data =AdvBanners::find($id);
        return view('admin.banners.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = AdvBanners::find($request->id);
        $data->update([
            'status' => $request->status ?? 0,
        ]);

        if($request->hasFile('cover') && $request->file('cover')->isValid()){
            Media::where('model_type',AdvBanners::class)->where('model_id',$request->id)->where('collection_name','cover')->delete();
            $data->addMediaFromRequest('cover')->toMediaCollection('cover');
        }
        return redirect('admin/banners')->with('message', trans('labels.labels.modified_successfully'))->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            AdvBanners::whereIn('id',$request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);
    }
}
