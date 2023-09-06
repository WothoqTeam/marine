<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\Auth\UserLoginRequest;
use App\Models\Role;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use Str;
class AuthApiController extends BaseApiController
{
    use MoraTrait;
    public function __construct() {
        $this->middleware('api', ['except' => ['login', 'register','checkVerification','checkPhone']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request){
        $code=123456;
        if (!empty($request->phone)){
            Verification::create(['key'=>$request->phone,'code'=>$code]);
            if (getenv('APP_ENV')!='local' and getenv('APP_ENV')!='test'){
                $code=rand(100000,999999);
                $lang=strtolower(request()->header('Language', 'ar'));
                $sms= $this->sendSms($code,$request->phone,$lang);
                if (!$sms){
                    return $this->generateResponse(false,'Invalid Phone Number',[],422);
                }
            }
            return $this->generateResponse(true,'Success',[]);
        }elseif(!empty($request->email)){
            Verification::create(['key'=>$request->email,'code'=>$code]);
            if (getenv('APP_ENV')!='local' and getenv('APP_ENV')!='test') {
                //send mail with code
                Mail::send('emails.otp', ['code' => $code], function ($message) use ($request) {
                    $message->to($request->input('email'))
                        ->subject('Your OTP');
                });
            }
            return $this->generateResponse(true,'Success',[]);
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreUser $request) {
        $request->request->add(['password'=>'password']);
        $data=$request->only('name','email','phone','country_id','city_id','gender','password','fcm_token');
        $user = User::create(array_merge(
            $data,
            ['password' => bcrypt('password')]
        ));
        $user_role = Role::where('slug','user')->first();
        $user->roles()->attach($user_role);
        if (!empty($request->phone)){
            $token = auth('api')->attempt(['phone' => $request->phone, 'password' => 'password']);
        }elseif(!empty($request->email)){
            $token = auth('api')->attempt(['email' => $request->email, 'password' => 'password']);
        }
        $user->token=$token;
        $data=[
            'title_en'=>'New user Added',
            'title_ar'=>'تم اضافة مستخدم جديد',
            'body_en'=>'A new User '.$request->name.' has been added',
            'body_ar'=>'تم اضافة مستخدم جديد '.$request->name,
        ];
        $this->sendManagersNotifications([1],$data);
        $response = ['success' => true, 'message' => 'User successfully registered', 'data' => $user];
        return response()->json($response, 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('api')->logout();
        $response = ['success' => true, 'message' => 'User successfully signed out', 'data' => []];
        return response()->json($response);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        $response = ['success' => true, 'message' => 'Success', 'data' => auth('api')->user()];
        return response()->json($response);
    }

    public function updateUserProfile(Request $request) {
        $user = auth('api')->user();

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'phone' =>'required|string|max:100|unique:users,phone,'.$user->id,
            'country_id' => 'nullable|int|exists:countries,id',
            'city_id' => 'nullable|int|exists:cities,id',
            'gender' => 'nullable|int',
        ]);
        if ($validator->fails()) {
            return $this->generateResponse(false,'Invalid credentials',$validator->errors(),422);
        }
        // Update the user's name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->country_id = $request->input('country_id');
        $user->city_id = $request->input('city_id');
        $user->gender = $request->input('gender');

        // Update the user's password if provided
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the changes to the user model
        $user->save();
        return $this->generateResponse(true,'Profile updated successfully',[]);
    }

    public function checkPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|unique:users',
            'email' => 'nullable|email|unique:users',
        ]);
        if ($validator->fails()) {
            return $this->generateResponse(false,'Invalid credentials',$validator->errors(),422);
        }
        $code=123456;
        if (!empty($request->phone)){
            Verification::create(['key'=>$request->phone,'code'=>$code]);
            //send otp here
            if (getenv('APP_ENV')!='local' and getenv('APP_ENV')!='test'){
                $code=rand(100000,999999);
                $lang=strtolower(request()->header('Language', 'ar'));
                $sms= $this->sendSms($code,$request->phone,$lang);
                if (!$sms){
                    return $this->generateResponse(false,'Invalid Phone Number',[],422);
                }
            }

            return $this->generateResponse(true,'Success',[]);
        }elseif (!empty($request->email)){
            Verification::create(['key'=>$request->email,'code'=>$code]);
            if (getenv('APP_ENV')!='local' and getenv('APP_ENV')!='test') {
                //send mail otp here
                Mail::send('emails.otp', ['code' => $code], function ($message) use ($request) {
                    $message->to($request->input('email'))
                        ->subject('Your OTP');
                });
            }
            return $this->generateResponse(true,'Success',[]);
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }

    }

    public function checkVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->generateResponse(false,'Invalid credentials',$validator->errors(),422);
        }
        if (!empty($request->phone)){
            $check=Verification::where('key',$request->phone)->where('code',$request->code)->where('verify',0)->latest()->first();
            $user=User::Where('phone' , $request->input('phone'))->first();
            $key='phone';
            $value=$request->phone;
        }elseif(!empty($request->email)){
            $check=Verification::where('key',$request->email)->where('code',$request->code)->where('verify',0)->latest()->first();
            $user=User::Where('email' , $request->input('email'))->first();
            $key='email';
            $value=$request->email;
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
        if ($check){
            $check->verify=1;
            $check->save();
            if ($user){
                if (! $token = auth('api')->attempt([$key => $value, 'password' => 'password'])) {
                    return $this->generateResponse(false,'Invalid Unauthorized',[],401);
                }
                $user=auth('api')->user();
                if($user->hasRole('user')){
                    if ($request->fcm_token){
                        User::where('id',$user->id)->update(['fcm_token'=>$request->fcm_token]);
                    }
                    unset($user->roles);
                    $user->token=$token;
                    return $this->generateResponse(true,'Success',$user->toarray());
                }else{
                    return $this->generateResponse(false,'this role cant be login',[],401);
                }
            }else{
                return $this->generateResponse(true,'Success',[]);
            }
        }else{
            return $this->generateResponse(false,'invalid code',[],422);
        }
    }

    public function getUserPoints(){
        $user = auth('api')->user();
        $points=UsersPoints::where('user_id',$user->id)->sum('points');
        $points=$points > 0 ? $points : 0;
        return $this->generateResponse(true,'Profile updated successfully',['points'=>$points]);
    }

    public function updateUserLanguage(Request $request){
        $validator = Validator::make($request->all(), ['language' => 'required|in:ar,en']);
        if ($validator->fails()) {
            return $this->generateResponse(false,'Invalid credentials',$validator->errors(),422);
        }
        $user = auth('api')->user();
        User::where('id',$user->id)->update(['language'=>$request->language]);
        return $this->generateResponse(true,'Language updated successfully');
    }
}
