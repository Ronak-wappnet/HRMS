<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;
use App\Mail\ForgotPasswordMail;
use App\Models\Password_Reset_Token;


class AuthController extends Controller
{
    // user login
    public function login(): View
    {
        if (!Auth::check()) {
            return view('Auth.login')->with('error', 'You are not allowed to access dashboard');
        }
        return view('Auth.login');
    }

    //user loginAction 
    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return view('dashboard.dashboard')->with('Success', 'You are signed in ');
        }
        return back()->with('error', 'Invalid UserId or password');
    }

    // user registration
    public function registration(): View
    {
        return view('Auth.Register');
    }

    // user registration Acti0n
    public function registrationAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // assigning role to user         
        $user->assignRole('Employee');
        return redirect("login")->with('success', 'You have signed-up');
    }

    //for forgot password
    public function forgotPassword(): View
    {
        return view('Auth.forgotPassword');
    }

    //forgot passwordAction or Forgot password Form
    public function forgotPasswordAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'email id is not found!');
        }
        $token = Str::random(64);
        $email = $request->email;
        $record = Password_Reset_Token::where('email', $email)->delete();
        $insert_data = Password_Reset_Token::create([
            'email' => $email,
            'token' => $token,
        ]);

        $data['email'] = $email;
        $data['token'] = $token;
        Mail::to($email)->send(new ForgotPasswordMail($data));
        // dispatch(new SendEmailJob($data));

        return back()->with('success', 'Rest link send to your registered mail address!');
    }

    // for Reset passwordForm
    public function resetPasswordForm(Request $request, $token = null): View
    {
        return view('Auth.resetPassword')->with(['token' => $token, 'email' => $request->email]);
    }

    // for Reset PasswordFormAction
    public function resetPasswordFormAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
            'confirm_passsword' => 'required|same:password'
        ]);

        // checking token is expire or not 
        $check_token = Password_Reset_Token::where('token','=', $request->token)->first();
        if (!$check_token) {
            return back()->withInput()->with('fail', 'Invalid token');
        } else {
            
            // performing reset password 
            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);
            Password_Reset_Token::where('email', $request->email)->delete();
            return redirect()->route('login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }

    //user dashboard
    public function dashboard()
    {     
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect("login")->with('error', 'You are not allowed to access');
    }

    // for user signout
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

}
