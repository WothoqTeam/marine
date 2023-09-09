<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\JWT;

class SocialController extends BaseApiController
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $gUser = Socialite::driver('google')->user();
        // Use $user to create or log in the user
        $check=User::where('google_id',$gUser->getId())->orWhere('email',$gUser->getEmail())->first();
        if ($check){
            $jwt = app(JWT::class);
            $token = $jwt->fromUser($check);
            $userData=[
                'id'=>$check->id,
                'name'=>$check->name,
                'token'=>$token,
            ];
            return $this->generateResponse(true,'Success',$userData);
        }else{
            $user=User::create([
                'name'=>$gUser->getName(),
                'email'=>$gUser->getEmail(),
                'password'=>bcrypt($gUser->getEmail()),
                'google_id'=>$gUser->getId(),
            ]);
            $token = auth('api')->attempt(['email' => $user->email, 'password' => $user->email]);
            $userData=[
                'id'=>$user->id,
                'name'=>$user->name,
                'token'=>$token,
            ];
            return $this->generateResponse(true,'Success',$userData);
        }
    }

    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();
        dd($user);
        // Use $user to create or log in the user

        return redirect('/home'); // Redirect to the home page
    }
}
