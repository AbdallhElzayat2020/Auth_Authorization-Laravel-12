<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\VerifyAccountOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid credentials, please try again.');
        }

        if (!$user->email_verified_at) {
            Mail::to($user->email)->send(new VerifyAccountOtpMail($user->otp, $user->email));
            return redirect()->route('verify-email.form-show', $user->email);
        }

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('profile'))->with('success', 'Login successful, ' . Auth::user()->name);
        }
        return redirect()->back()->with('error', 'Login failed, please try again.');
    }
}
