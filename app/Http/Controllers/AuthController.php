<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\password_reset_token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Doctrine\Common\Lexer\Token;

class AuthController extends Controller
{
    public $token;
    public function index()
    {
        if (!Auth::check()) {
            return view('login');
        }

        return redirect("dashboard")->withSuccess('You are not allowed to access');
    }
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess(' welcome user ! you are Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('register');
    }

    public function userRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("login")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
    public function forgotPasswordPage()
    {
        return view('forgot_password');
    }

    public function userForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            if (!$user) {
                return back()->with('error', 'email id is not found!');
            }
        }
        $token = Str::random(64);
        $email = $request->email;
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        Mail::send('forgotPassMail', ['token' => $token], function ($message) use ($request) {
            $message->from('rronak0016@gmail.com');
            $message->to($request->email);
            $message->subject('Reset password');
        });
        return back()->with('success', 'Rest link send to your registered mail address!');
    }

    public function resetPasswordForm(Request $request, $token = null)
    {

        return view('passwordReset')->with(['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
            'confirm_passsword' => 'required|same:password'
        ]);

        $check_token = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$check_token) {

            return back()->withInput()->with('fail', 'Invalid token');
        } else {

            User::where('email', $request->email)->update([
                'password' => Hash::make($request->password)
            ]);

            DB::table('password_reset_tokens')->where([
                'email' => $request->email
            ])->delete();

            return redirect()->route('login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }

    public function changePasswordForm()
    {
        return view('changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password'
            ]
        );
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("status", "Password changed successfully!");
    }
}
