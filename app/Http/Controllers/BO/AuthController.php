<?php

namespace App\Http\Controllers\BO;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function login()
    {
        try {
            return view("bo.auth.login");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }

    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            "email" => "required|exists:admins,email|email",
            "password" => "required"
        ]);

        try {
            $credential         = $request->only("email", "password");

            if (RateLimiter::tooManyAttempts($request->email, 5)) {
                $seconds = RateLimiter::availableIn($request->email);
                $second  = $seconds <= 60 ? $seconds.' second' : ceil($seconds/60).' minut';  
                return Utils::BackFail('to much attemt, please wait after '.$second);
            }

            $is_authenticated   = Auth::guard("admin")->attempt($credential, $request->remember);
            
            if (!$is_authenticated){
                RateLimiter::hit($request->email, 1800);
                return Utils::BackFail("Credential not match");
            }
            $request->session()->regenerate();
            RateLimiter::clear($request->email);
            return redirect()->intended("/back-office/dashboard");

        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard("admin")->logout();
            session()->invalidate();
            $request->session()->regenerateToken();
            
            return Utils::RedirectSuccess(route("bo.login.index"), "Looged Out");
        } catch (\Throwable $e) {
            return Utils::BackFail($e->getMessage());
        }
    }

}
