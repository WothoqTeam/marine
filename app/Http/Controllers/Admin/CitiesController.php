<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = Cities::query();

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
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">' . $name . '</a></div>';
                    return $name;
                })
                ->addColumn('country_id', function ($row) {

                    if (App::getLocale() == 'en') {
                        $name = Countries::find($row->country_id)->name_en;
                    } else {
                        $name = Countries::find($row->country_id)->name_ar;
                    }
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">' . $name . '</a></div>';
                    return $name;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $is_active = '<div class="badge badge-light-success fw-bold">' . trans('labels.inputs.active') . '</div>';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">' . trans('labels.inputs.in_active') . '</div>';
                    }

                    return $is_active;
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<div class="ms-2">
                                <a href="' . route('admin.cities.edit', $row->id) . '" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                    if (!empty($request->get('country_id'))) {
                        $instance->where(function ($w) use ($request) {
                            $request->get('country_id');
                            $w->Where('country_id', $request->country_id);
                        });
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name_ar', 'LIKE', "%$search%")
                                ->orWhere('name_en', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name', 'country_id', 'status', 'checkbox', 'actions'])
                ->make(true);
        }
        $data['countries'] = Countries::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        return view('admin.cities.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['countries'] = Countries::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        return view('admin.cities.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'country_id' => 'required|int|exists:countries,id',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }

        Cities::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'country_id' => $request->country_id,
            'status' => $request->status ?? 0,
        ]);

        return redirect('admin/cities')->with('message', trans('labels.labels.added_successfully'))->with('status', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['cities'] = Cities::find($id);
        $data['countries'] = Countries::select('id', 'name_' . App::getLocale() . ' as name')->where('status', 1)->get();
        return view('admin.cities.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'country_id' => 'required|int|exists:countries,id',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }

        $data = Cities::find($request->id);
        $data->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'country_id' => $request->country_id,
            'status' => $request->status ?? 0,
        ]);

        return redirect('admin/cities')->with('message', trans('labels.labels.modified_successfully'))->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Cities::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);
    }
}
