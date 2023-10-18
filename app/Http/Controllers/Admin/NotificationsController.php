<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\SendPushNotification;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $data = Notifications::where('user_id',Auth::guard('admin')->user()->id)->where('type',Employee::class)->orderBy('id', 'DESC');

            return DataTables::of($data)
                ->addColumn('checkbox', function($row){
                    $checkbox = '<div class="form-check form-check-sm p-3 form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="'.$row->id.'" />
                                </div>';
                    return $checkbox;
                })
                ->addColumn('title', function($row){
                    if (App::getLocale()=='en'){
                        $title=$row->title_en;
                    }else{
                        $title=$row->title_ar;
                    }
                    $title = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$title.'</a>';
                    return $title;
                })
                ->addColumn('body', function($row){
                    if (App::getLocale()=='en'){
                        $body=$row->body_en;
                    }else{
                        $body=$row->body_ar;
                    }
                    $body = '<div class="d-flex flex-column"><a href="javascript:;" class="text-gray-800 text-hover-primary mb-1">'.$body.'</a>';
                    return $body;
                })
                ->rawColumns(['title','body','checkbox'])
                ->make(true);
        }
        Notifications::where('user_id',Auth::guard('admin')->user()->id)->where('type',Employee::class)->update(['read'=>1]);
        return view('admin.notifications.index');
    }
    public function create()
    {
        $data['users']=User::where('is_active',1)->get();
        return view('admin.notifications.create',compact('data'));
    }

    public function store(Request $request)
    {
        $rule = [
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'body_en' => 'required|string',
            'body_ar' => 'required|string',
        ];

        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            return redirect()->back()->with('message', $validate->messages()->first())->with('status', 'error')->withInput($request->all());
        }
        Notifications::create([
            'user_id' => $request->user_id!=0?$request->user_id:null,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'body_en' => $request->body_en,
            'body_ar' => $request->body_ar,
            'type'=>User::class
        ]);
        if ($request->user_id){
            $user=User::find($request->user_id);
            Notification::send(null,new SendPushNotification($request['title_'.$user->language],$request['body_'.$user->language],[$user->fcm_token]));
        }else{
            $arUsers = User::where('language','en')->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            Notification::send(null,new SendPushNotification($request['title_ar'],$request['body_ar'],$arUsers));

            $enUsers = User::where('language','ar')->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            Notification::send(null,new SendPushNotification($request['title_en'],$request['body_en'],$enUsers));
        }

        return redirect()->back()->with('message', trans('labels.labels.added_successfully'))->with('status', 'success');
    }
}
