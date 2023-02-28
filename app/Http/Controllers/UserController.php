<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function userProfile()
    {
        return view('userProfileUpdate');
    }
    
    public function userProfileUpdate(request $request){

        $request->validate([

            'username' => 'required',
            'email'=> 'required|email',
        ]);
        if((User::where('name', '=', $request->username)->exists()) OR (User::where('email', '=', $request->email)->exists())){

            return back()->with("error", " username or password is already exist");
        }
       
        /** @var \App\Models\User $user */
        $user =Auth::user();
        $user->name = $request['username'];
        $user->email = $request['email'];
        $user->save();
        return back()->with('status','Profile Updated');
    }
    public function users(){
        $users=user::select('id','name','email')->get();        
        return view('users',compact('users'));
    }

    public function editUserPage(User $user){
        
        return view('admin.editUser',compact('user'));
    }
    public function editUser(Request $request,User $user){

        $request->validate([

            'name' => 'required',
            'email'=> 'required|email',
        ]);
        // if((User::where('name', '=', $request->username)->exists()) OR (User::where('email', '=', $request->email)->exists())){

        //     return back()->with("error", " username or password is already exist");
        // }       
        /** @var \App\Models\User $user */
            $user->update($request->all());
        // $user->name = $request['username'];
        // $user->email = $request['email'];
        // $user->save();
        return back()->with('status','Profile Updated');
    }

}
