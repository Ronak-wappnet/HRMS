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
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    private  $userRepository;
    
    /**
     *  initializing object of userRepository 
     * 
     */
    public function __construct(UserRepository $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    /**
    *  User login function 
    *
    *  Return  loginpage 
    */
    public function login(): View
    {
        if (!Auth::check()) {
            return view('Auth.login')->with('error', 'You are not allowed to access dashboard');
        }
        return view('Auth.login');
    }

    /**
     * User loginAction function takes Request as argument
     * 
     * return Redirect Response
     */
    public function loginAction(Request $request): RedirectResponse | View
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

    /**
     * user registration function 
     * 
     * Return registration page
     */
    public function registration(): View
    {
        return view('Auth.Register');
    }

    /**
     * registrationAction function takes Request as argument
     * 
     * Return RedirectResponse 
     */
    public function registrationAction(Request $request): RedirectResponse
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

    /**
     * user forgotPassword function 
     * 
     * return forgotpasswod page
     */
    public function forgotPassword(): View
    {
        return view('Auth.forgotPassword');
    }

    /**
     * forgotPasswordAction function takes Request as argument 
     * 
     * perform forgotPassword Functinality
     * 
     * return RedirectResponse
     */
    public function forgotPasswordAction(Request $request): RedirectResponse
    {
        $request->validate([

            'email' => 'required|email',

        ]);

        $data = $this->userRepository->forgotPassword($request);

        dispatch(new SendEmailJob($data));

        return back()->with('success', 'Rest link send to your registered mail address!');
    }

    /**
     * resetPasswordForm takes Request and token as argument, default value of token = null
     * 
     * retunr View
     */
    public function resetPasswordForm(Request $request, $token = null): View
    {
        return view('Auth.resetPassword')->with(['token' => $token, 'email' => $request->email]);
    }
    
    /**
     * resetPassword form takes Request as argument
     * 
     * return RedirectResponse  
     */
    public function resetPasswordFormAction(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
            'confirm_passsword' => 'required|same:password'
        ]);

        /**
         * checking token is expire or not 
         */
        $check_token = Password_Reset_Token::where('token', '=', $request->token)->first();

        if (!$check_token) {

            return back()->withInput()->with('fail', 'Invalid token');
        } else {
            /**
             * performing reset password 
             */
            $this->userRepository->resetPassword($request);

            //delet token
            Password_Reset_Token::where('email', $request->email)->delete();

            return redirect()->route('login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }

    /**
     * Dashboard function 
     * 
     * return RedirectResponse 
     */
    public function dashboard(): RedirectResponse | View
    {
        if (Auth::check()) {

            return view('dashboard.dashboard');
        }
        return redirect("login")->with('error', 'You are not allowed to access');
    }

    /**
     * user signout
     */
    public function signOut(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
