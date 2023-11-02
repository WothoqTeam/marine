<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
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
            return $token;
        }else{
            $user=User::create([
                'name'=>$gUser->getName(),
                'email'=>$gUser->getEmail(),
                'password'=>bcrypt($gUser->getEmail()),
                'google_id'=>$gUser->getId(),
            ]);
            $user_role = Role::where('slug','user')->first();
            $user->roles()->attach($user_role);
            $token = auth('api')->attempt(['email' => $user->email, 'password' => $user->email]);
            $userData=[
                'id'=>$user->id,
                'name'=>$user->name,
                'token'=>$token,
            ];
            return $token;
        }
    }

    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        $tUser = Socialite::driver('twitter')->user();
        // Use $user to create or log in the user
        $check=User::where('twitter_id',$tUser->getId())->orWhere('email',$tUser->getEmail())->first();
        if ($check){
            $jwt = app(JWT::class);
            $token = $jwt->fromUser($check);
            $userData=[
                'id'=>$check->id,
                'name'=>$check->name,
                'token'=>$token,
            ];
            return $token;
        }else{
            $user=User::create([
                'name'=>$tUser->getName(),
                'email'=>$tUser->getEmail(),
                'password'=>bcrypt($tUser->getEmail()),
                'twitter_id'=>$tUser->getId(),
            ]);
            $jwt = app(JWT::class);
            $token = $jwt->fromUser($user);
            $user_role = Role::where('slug','user')->first();
            $user->roles()->attach($user_role);
            $userData=[
                'id'=>$user->id,
                'name'=>$user->name,
                'token'=>$token,
            ];
            return $token;
        }
    }
}
