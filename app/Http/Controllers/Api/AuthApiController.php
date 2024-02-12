<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\Auth\CheckPhoneRequest;
use App\Http\Requests\Api\Auth\UpdateLanguageRequest;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;
use App\Http\Requests\Api\Auth\UpdateUserRequest;
use App\Http\Requests\Api\Auth\UserLoginRequest;
use App\Http\Requests\Api\Auth\UserRegisterRequest;
use App\Models\Role;
use App\Models\Specifications;
use App\Models\Verification;
use App\Traits\DeewanSMSTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Validator;
use Str;
class AuthApiController extends BaseApiController
{
    use DeewanSMSTrait;
    public function __construct() {
        $this->middleware('api', ['except' => ['login', 'register','checkVerification','checkPhone']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request){
        if (! $token = auth('api')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return $this->generateResponse(false,'Invalid Unauthorized',[],401);
        }
        $user=auth('api')->user();
        if($user->hasRole($request->role)){
            if ($request->fcm_token){
                User::where('id',$user->id)->update(['fcm_token'=>$request->fcm_token]);
            }
            if($user->hasRole('provider')){
                $user->role='provider';
            }else{
                $user->role='user';
            }
            $user->token=$token;
            return $this->generateResponse(true,'Success',$user);
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterRequest $request) {
        $inputs=$request->only('name','email','phone','password','fcm_token');
        $user = User::create(array_merge(
            $inputs,
            ['password' => bcrypt($request->password)]
        ));
         if($request->hasFile('photo') && $request->file('photo')->isValid()){
             $user->addMediaFromRequest('photo')->toMediaCollection('profile');
         }
        $userData=User::find($user->id);
        if($request->role == 'provider'){
            $user_role = Role::where('slug','provider')->first();
            $userData->role='provider';
        }else{
            $user_role = Role::where('slug','user')->first();
            $userData->role='user';
        }
        $user->roles()->attach($user_role);
        $userData->token = auth('api')->attempt(['phone' => $request->phone, 'password' => $request->password]);
        return $this->generateResponse(true,'Success',$userData);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth('api')->logout();
        return $this->generateResponse(true,'User successfully signed out');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        if (auth('api')->user()){
            return $this->generateResponse(true,'Success',auth('api')->user());
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
    }

    public function updateProfile(UpdateUserRequest $request) {
        //update
        $user = auth('api')->user();
        if($user) {
            // Update the user's name and email
            $user->name = $request->input('name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->dob = $request->input('dob');
            $user->gender = $request->input('gender');
            $user->nationality = $request->input('nationality');
//            $user->phone = $request->input('phone');

            // Update the user's password if provided
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            // Save the changes to the user model
            $user->save();
            return $this->generateResponse(true, 'Profile updated successfully', $user);
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        $user = User::where('phone',$request->phone)->first();
        if($user) {
            $user->password = Hash::make($request->input('password'));

            // Save the changes to the user model
            $user->save();
            return $this->generateResponse(true, 'Profile updated successfully', []);
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
    }

    public function checkPhone(Request $request)
    {
        if ($request->exist){
            $validator = Validator::make($request->all(), [
                'phone' => 'required|exists:users'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'phone' => 'required|unique:users'
            ]);
        }

        if ($validator->fails()) {
            return $this->generateResponse(false,'Invalid credentials',$validator->errors(),422);
        }
        $code=1234;
        Verification::create(['key'=>$request->phone,'code'=>$code]);
        //send otp here
        if (getenv('APP_ENV')!='local' and getenv('APP_ENV')!='test'){
            $code=rand(1000,9999);
            $lang=strtolower(request()->header('Language', 'ar'));
            //send Sms Here
            $sms= $this->sendSms($code,$request->phone,$lang);
            if (!$sms){
                return $this->generateResponse(false,'Invalid Phone Number',[],422);
            }
        }
        return $this->generateResponse(true,'Success',[]);

    }

    public function checkVerification(Request $request)
    {
        $check=Verification::where('key',$request->phone)->where('code',$request->code)->where('verify',0)->latest()->first();
        if ($check){
            $check->verify=1;
            $check->save();
            return $this->generateResponse(true,'Success',[]);
        }else{
            return $this->generateResponse(false,'invalid code',[],422);
        }
    }

    public function updateLanguage(UpdateLanguageRequest $request){
        $user = auth('api')->user();
        if($user){
            User::where('id',$user->id)->update(['language'=>$request->language]);
            return $this->generateResponse(true,'Language Updated Successfully');
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
    }

    public function updateUserImage(Request $request){
        $user = auth('api')->user();
        if($user){
            $user=User::find($user->id);
             if($request->hasFile('image') && $request->file('image')->isValid()){
                 Media::where('model_type',User::class)->where('model_id',$user->id)->where('collection_name','profile')->delete();
                 $user->addMediaFromRequest('image')->toMediaCollection('profile');
             }
            $user=User::find($user->id);
            return $this->generateResponse(true,'Image Updated Successfully',$user);
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
    }

    public function updateStatus(Request $request){
        $user = auth('api')->user();
        if($user){
            User::where('id',$user->id)->update(['is_active'=>$request->status]);
            return $this->generateResponse(true,'Status Updated Successfully');
        }else{
            return $this->generateResponse(false,'invalid data',[],422);
        }
    }

}
