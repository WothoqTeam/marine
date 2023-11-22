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

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::query();
            $data = $data->where('role_id',1)->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function ($row) {
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">' . $row->append_name . '</a>';
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
                                <a href="' . route('admin.employees.show', $row->id) . '" class="btn btn-sm btn-icon btn-warning btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-eye-fill fs-1x"></i>
                                </a>
                                <a href="' . route('admin.employees.edit', $row->id) . '" class="btn btn-sm btn-icon btn-info btn-active-dark me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
        return view('admin.employee.index');
    }

    public function show($id)
    {
        $data = Employee::where('role_id',1)->findorFail($id);
        return view('admin.employee.show', compact('data'));
    }

    public function create()
    {
        $data = [];
        $permissions = Permission::where('status',true)->get();
        foreach ($permissions as $permission) {
            $str = explode(".", $permission->slug);
            $data[$str[0]][] = $str[1];
        }
        return view('admin.employee.create', compact('data'));
    }

    public function store(Request $request)
    {
        $rule = [
            'name_ar' => 'required|string',
            'email' => 'email|unique:employees',
            'phone' => 'required|unique:employees',
            'password' => 'nullable|min:6',
            'photo' => 'image|mimes:png,jpg,jpeg|max:2048'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error');
        }

        $row = Employee::create([
            'name_ar' => $request->name_ar,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'type' => 'dash',
            'is_active' => $request->is_active ?? '0',
        ]);
        if (is_array($request->permissions) and count($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $getPermission = Permission::where('slug', $permission)->first();
                if ($getPermission) {
                    EmployeesPermissions::create(['employees_id' => $row->id, 'permission_id' => $getPermission->id]);
                }
            }
        }
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $row->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        return redirect('admin/employees')->with('message', 'تم الاضافة بنجاح')->with('status', 'success');
    }

    public function edit($id)
    {
        $permissions_arr = [];
        $permissions = Permission::where('status',true)->get();
        foreach ($permissions as $permission) {
            $str = explode(".", $permission->slug);
            $checked = EmployeesPermissions::where(['employees_id' => $id, 'permission_id' => $permission->id])->count();
            $permissions_arr[$str[0]][] = ['name' => $str[1], 'checked' => $checked];
        }
        $data = Employee::where('role_id',1)->findorFail($id);
        return view('admin.employee.edit', compact('data', 'permissions_arr'));
    }

    public function update(Request $request)
    {
        $rule = [
            'name_ar' => 'required|string',
            'email' => 'email|unique:employees,email,' . $request->id,
            'phone' => 'required|unique:employees,phone,' . $request->id,
            'password' => 'nullable|min:6',
            'photo' => 'image|mimes:png,jpg,jpeg|max:2048'
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
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
        if (is_array($request->permissions) and count($request->permissions)) {
            EmployeesPermissions::where(['employees_id' => $request->id])->delete();
            foreach ($request->permissions as $permission) {
                $getPermission = Permission::where('slug', $permission)->first();
                if ($getPermission) {
                    EmployeesPermissions::create(['employees_id' => $request->id, 'permission_id' => $getPermission->id]);
                }
            }
        }
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $data->addMediaFromRequest('photo')->toMediaCollection('profile');
        }

        return redirect('admin/employees')->with('message', 'تم التعديل بنجاح')->with('status', 'success');
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

    public function updateFcm(Request $request)
    {
        try {
            $request->user()->update(['fcm_token' => $request->token]);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }
}
