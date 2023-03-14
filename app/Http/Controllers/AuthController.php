<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use App\Models\Password_Reset_Token;
use App\Jobs\SendEmailJob;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\UserRepository;


class AuthController extends Controller
{
    private  $userRepository;

    // initializing object of userRepository
    public function __construct(UserRepository $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    // user login
    public function login(): View
    {
        if (!Auth::check()) {
            return view('Auth.login')->with('error', 'You are not allowed to access dashboard');
        }
        return view('Auth.login');
    }

    // user loginAction 
    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Alert::success('Congrats', 'Login Successfull');
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

        $this->userRepository->register($data);
        Alert::Success('Congrats', 'You\'ve Successfully Registered');
        return redirect("login")->with('success', 'You have signed-up');
    }

    // for forgot password
    public function forgotPassword(): View
    {
        return view('Auth.forgotPassword');
    }

    // Forgot password Form
    public function forgotPasswordAction(Request $request)
    {
        $request->validate([

            'email' => 'required|email',

        ]);

        $data = $this->userRepository->forgotPassword($request);

        dispatch(new SendEmailJob($data));

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
        $check_token = Password_Reset_Token::where('token', '=', $request->token)->first();

        if (!$check_token) {

            return back()->withInput()->with('fail', 'Invalid token');
        } else {
            // performing reset password 
            $this->userRepository->resetPassword($request);

            //delet token
            Password_Reset_Token::where('email', $request->email)->delete();

            return redirect()->route('login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }

    // user dashboard
    public function dashboard()
    {
        if (Auth::check()) {

            return view('dashboard.dashboard');
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
