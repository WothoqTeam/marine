<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeesPermissions;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Employee;
use DataTables;
use Validator;

class MarasiOwnerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::query();
            $data = $data->where('role_id',2)->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function ($row) {
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</a>';
                    $name .= '<span>' . $row->email . '</span></div>';
                    return $name;
                })
                ->addColumn('phone', function ($row) {

                    $phone = $row->phone;

                    return $phone;
                })
                ->addColumn('is_active', function ($row) {
                    if ($row->is_active == 1) {
                        $is_active = '<div class="badge badge-light-success fw-bold">'.trans('labels.inputs.active').'</div>';
                    } else {
                        $is_active = '<div class="badge badge-light-danger fw-bold">'.trans('labels.inputs.in_active').'</div>';
                    }

                    return $is_active;
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<div class="ms-2">
                                <a href="' . route('admin.owners.show', $row->id) . '" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="' . route('admin.owners.edit', $row->id) . '" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-pencil-square fs-1x"></i>
                                </a>
                            </div>';
                    return $actions;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('is_active') == '0' || $request->get('is_active') == '1') {
                        $instance->where('is_active', $request->get('is_active'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name_ar', 'LIKE', "%$search%")
                                ->orWhere('phone', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['name', 'phone', 'is_active', 'checkbox', 'actions'])
                ->make(true);
        }
        return view('admin.owners.index');
    }

    public function show($id)
    {
        $data = Employee::where('role_id',2)->findorFail($id);
        return view('admin.owners.show', compact('data'));
    }

    public function create()
    {
        return view('admin.owners.create');
    }

    public function store(Request $request)
    {
        $phone=$request->phone;
        $request->request->set('phone',$request->code . $request->phone);
        $rule = [
            'name_ar' => 'required|string',
            'email' => 'email|unique:employees',
            'code' => 'required|numeric|digits:3',
            'phone' => 'required|numeric|digits:12|unique:employees',
            'password' => 'nullable|min:6',
            'photo' => 'image|mimes:png,jpg,jpeg|max:2048'
        ];

        $validate = Validator::make($request->all(), $rule);

        if ($validate->fails()) {
            $request->request->set('phone',$phone);
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error')->withInput($request->all());
        }

        $row = Employee::create([
            'name_ar' => $request->name_ar,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'type' => 'dash',
            'is_active' => $request->is_active ?? '0',
        ]);
        $permissions=[
            'yachts.index',
            'marasi.index',
            'marasi.create',
            'marasi.update',
            'marasi.delete',
            'marasi reservations.index',
            'marasi reservations.update',
            'marasi reservations.delete',
            'ratings.index',
        ];
        foreach ($permissions as $permission) {
            $getPermission = Permission::where('slug', $permission)->first();
            if ($getPermission) {
                EmployeesPermissions::create(['employees_id' => $row->id, 'permission_id' => $getPermission->id]);
            }
        }
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        return redirect('admin/owners')->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $data = Employee::where('role_id',2)->findorFail($id);
        return view('admin.owners.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $phone=$request->phone;
        $request->request->set('phone',$request->code . $request->phone);
        $rule = [
            'name_ar' => 'required|string',
            'email' => 'email|unique:employees,email,' . $request->id,
            'phone' => 'required|unique:employees,phone,' . $request->id,
            'password' => 'nullable|min:6',
            'photo' => 'image|mimes:png,jpg,jpeg|max:2048'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            $request->request->set('phone',$phone);
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }

        $data = Employee::find($request->id);
        $data->update([
            'name_ar' => $request->name_ar,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => ($request->password) ? Hash::make($request->password) : $data->password,
            'type' => 'dash',
            'is_active' => $request->is_active ?? '0',
        ]);
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $data->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        return redirect('admin/owners')->with('message', 'تم التعديل بنجاح')->with('status', 'success');
    }

    public function destroy(Request $request)
    {

        try {
            Employee::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'error']);
        }
        return response()->json(['message' => 'success']);

    }
}
