<?php

namespace App\Services;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordService {
    public static function sendResetRequest(array $data) {
          $status= Password::sendResetLink(['email'=>$data['email']]);
          return $status;
    }
    public static function resetForgotPassword(array $data){
        $status=Password::reset($data,function ($user,$password) {
            $user->forceFill(['password'=>Hash::make($password)]);
            $user->save();
            event(new PasswordReset($user));
        });
        return $status;
    }
}
