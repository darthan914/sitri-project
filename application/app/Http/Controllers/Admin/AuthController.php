<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Auth\ResetPasswordRequest;
use App\Http\Requests\Admin\Auth\SendForgotPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Sitri\Actions\Auth\CheckTokenForgotPasswordAction;
use App\Sitri\Actions\Auth\ResetPasswordAction;
use App\Sitri\Actions\Auth\SendForgotPasswordAction;
use App\Sitri\Actions\Auth\VerifyEmailAction;
use App\Sitri\Actions\LoginAction;
use App\Sitri\Actions\RegisterAction;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request, LoginAction $action)
    {
        $request->validated();

        try {
            $action->execute($request->email, $request->password, $request->remember_me);
        } catch (Exception $e) {
            return redirect()->route('admin.login')->with('failed', $e->getMessage());
        }

        return redirect()->route('admin.home');
    }

    public function registerForm()
    {
        return view('admin.auth.register');
    }

    public function register(RegisterRequest $request, RegisterAction $action)
    {
        $request->validated();

        $action->execute($request->all());

        return redirect()->route('admin.login')
                         ->with('success', 'Register success, please check your email to verified')
            ;
    }

    public function verify(Request $request, VerifyEmailAction $action)
    {
        try {
            $action->execute($request->token);
        } catch (Exception $e) {
            return redirect()->route('admin.login')
                         ->with('failed', $e->getMessage())
            ;
        }

        return redirect()->route('admin.login')
                         ->with('success', 'Your email has been verified and active, try to login')
            ;
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgotPassword');
    }

    public function sendForgotPassword(SendForgotPasswordRequest $request, SendForgotPasswordAction $action)
    {
        $request->validated();

        try {
            $action->execute($request->email);
        } catch (Exception $e) {
            return redirect()->route('admin.login')
                         ->with('failed', $e->getMessage())
            ;
        }

        return redirect()->route('admin.login')
                         ->with('success', 'Your request password has been sent, check your email')
            ;
    }

    public function formResetPassword(Request $request, CheckTokenForgotPasswordAction $action)
    {
        try {
            $action->execute($request->token);
        } catch (Exception $e) {
            return redirect()->route('admin.login')
                         ->with('failed', $e->getMessage())
            ;
        }

        return view('admin.auth.resetPassword', compact('token'));
    }

    public function resetPassword(ResetPasswordRequest $request, ResetPasswordAction $action)
    {
        $request->validated();

        try {
            $action->execute($request->token, $request->password);
        } catch (Exception $e) {
            return redirect()->route('admin.login')
                         ->with('failed', $e->getMessage())
            ;
        }

        return redirect()->route('admin.login')->with('success', 'Password has been reset');
    }
}
