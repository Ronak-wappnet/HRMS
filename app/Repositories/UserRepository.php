<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use App\Models\Password_Reset_Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{

    /**
     * register() takes Request (data array) as argument
     * 
     * assing Employee role to user
     *  
     * @return void
     */
    public function register($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('Employee');
    }

    /**
     * forgotPassword() takes request as argument
     * 
     * @return  data array 
     */
    public function forgotPassword($request)
    {
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
        return $data;
    }

    /**
     * resetPassword() takes request as argument
     * 
     * will update the password using email
     * 
     * @return void
     */
    public function resetPassword($request)
    {        
            User::where('email', $request->email)->update([

                'password' => Hash::make($request->password)
            ]);           
    }    

    /**
     * edit() takes request as argument
     * 
     * edit the user 
     * 
     * @return void
     */
    public function edit($request)
    {
         /** @var \App\Models\User $user */
         $user = Auth::user();
         $user->name = $request['username'];
         $user->email = $request['email'];
         $user->save();
    }
    
    /**
     * changePassword takes request as argument 
     * 
     * update password using id
     * 
     * @return void
     */
    public function changePassword($request)
    {
        User::Where('id', '=', auth()->user()->id)->update(
            [
                'password' => Hash::make($request->new_password)
            ]
        );
    }

}
