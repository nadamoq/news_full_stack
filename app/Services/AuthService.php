<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public static function login(array $data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']],
            $data['remember_me'])) {
            session()->regenerate();
             $user=  auth()->user();
            $redirect= $user->is_admin ? 'news.index': 'user-view.index';
              
        
            return [
                'ok'=>true,
                'redirect'=>$redirect,
                'message'=>'logged in'
            ];
        } else {
            return ['ok'=>false,
             'message'=>'wrong email or password'
        ];
        }
    }
    public static function register(array $data){
        $data['password']=Hash::make($data['password']);
        $created=User::create($data);
        return $created;
    }
    public static function UpdatePassword(array $data){
      $user= auth()->user();
      $updated =$user->update(['password'=>Hash::make($data['new_password'])]);
      return $updated;
    }
}
