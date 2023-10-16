<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DataTables;
use Validator;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = Countries::query();

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
                ->addColumn('iso_code', function ($row) {

                    $iso_code = $row->iso_code;

                    return $iso_code;
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
                                <a href="' . route('admin.countries.edit', $row->id) . '" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name_ar', 'LIKE', "%$search%")
                                ->orWhere('name_en', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name', 'iso_code', 'status', 'checkbox', 'actions'])
                ->make(true);
        }

        return view('admin.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'currency_en' => 'required|string',
            'currency_ar' => 'required|string',
            'iso_code' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }

        Countries::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'currency_en' => $request->currency_en,
            'currency_ar' => $request->currency_ar,
            'iso_code' => $request->iso_code,
            'status' => $request->status ?? 0,
        ]);

        return redirect('admin/countries')->with('message', trans('labels.labels.added_successfully'))->with('status', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Countries::find($id);
        return view('admin.countries.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rule = [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'currency_en' => 'required|string',
            'currency_ar' => 'required|string',
            'iso_code' => 'required',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }

        $data = Countries::find($request->id);
        $data->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'currency_en' => $request->currency_en,
            'currency_ar' => $request->currency_ar,
            'iso_code' => $request->iso_code,
            'status' => $request->status ?? 0,
        ]);

        return redirect('admin/countries')->with('message', trans('labels.labels.modified_successfully'))->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Countries::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);
    }
}
