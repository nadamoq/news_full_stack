<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailValidation;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\AuthService;
use App\Services\PasswordService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function register(SignInRequest $request)
    {

        $result = AuthService::register($request->validated());

        if ($result) {
            return response()->json(['message' => 'registerd successfully'], 200);
        } else {
            return response()->json(['message' => 'wrong email or password'], 401);
        }
    }
    public function show_register()
    {
        return response()->view('auth.register');
    }
    public function show_login()
    {

        return response()->view('auth.login');
    }
    public function login(LoginRequest $request)
    {

        $result = AuthService::login($request->validated());
        if ($result['ok']) {           
            return response()->json(['message' => $result['message'],'redirect'=>route($result['redirect'])], 200);
        } else {
            return  response()->json(['message' => $result['message']], 401);
        }
    }


    public function show_resetPassword()
    {
        return response()->view('auth.resetPassword');
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $result = AuthService::UpdatePassword($request->validated());
        return response()->json(['message' => $result ? 'change password ' : 'not changed']);
    }
    public function verificationNotice()
    {
        return response()->view('auth.verification-notice');
    }
    public function sendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'email has sent'], 200);
    }
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        $user = auth()->user();

        $redirect = $user->is_admin
            ? 'news.index'
            : 'user-view.index';
        return redirect()->route($redirect);
    }
    public function forgotPassword()
    {
        return response()->view('auth.forgot-password');
    }
    public function resetPasswordRequest(EmailValidation $request)
    {
        $status = PasswordService::sendResetRequest($request->validated());
        return response()->json(
            ['message' => __($status)],
            $status == Password::RESET_LINK_SENT ?
                200 :
                Response::HTTP_BAD_REQUEST
        );
    }
    public function showResetPassword(string $token, Request $request)
    {
        return response()->view('auth.resetForgotPassword', ['email' => $request->email, 'token' => $token]);
    }
    public function resetForgotPassword(ResetPasswordRequest $request)
    {

        $status = PasswordService::resetForgotPassword($request->validated());
        return response()->json(['message' => __($status)], Password::PASSWORD_RESET == $status ? 200 : Response::HTTP_BAD_REQUEST);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        return response()->view('auth.login');
    }
}
