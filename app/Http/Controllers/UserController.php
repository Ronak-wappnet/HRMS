<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function profile() :View
    {
        return view('user.profile');
    }

    public function profileAction(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email'=> 'required|email',
        ]);
        if((User::where('name', '=', $request->username)->exists()) and (User::where('email', '=', $request->email)->exists())){
            return back()->with("error", " username or password is already exist");
        }       
        /** @var \App\Models\User $user */
        $user =Auth::user();
        $user->name = $request['username'];
        $user->email = $request['email'];
        $user->save();
        return back()->with('status','Profile Updated');
    }

    public function changePassword() :View
    {
        return view('user.changePassword');
    }

    public function changePasswordAction (Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        if(!Hash::check($request->old_password,auth()->user()->password))
        {
            return back()->with("error", "Old Password Doesn't match!");       
        }
       
        User::Where('id','=',auth()->user()->id)->update(
            [ 
                'password' => Hash::make($request->new_password)
            ]
        );
        return back()->with("status","Password changed successfully");
    }
}
