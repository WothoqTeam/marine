<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class RatingsController extends Controller
{
    public function index(Request $request)
    {
        $emp=Auth::guard('admin')->user();
        if ($request->ajax()) {
            $data = Ratings::query();
            $data = $data->where(['model_type'=>Employee::class,'model_id'=>$emp->id])->orderBy('id', 'DESC');

            return Datatables::of($data)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('name', function ($row) {
                    $name = $row->addBy->name;
                    $name = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">' . $name . '</a>';
                    return $name;
                })
                ->addColumn('stars', function ($row) {

                    $stars = $row->stars;

                    return $stars;
                })
                ->addColumn('comments', function ($row) {

                    $comments = $row->comments;

                    return $comments;
                })
                ->rawColumns(['name', 'stars', 'comments', 'checkbox'])
                ->make(true);
        }
        return view('admin.ratings.index');
    }
}
