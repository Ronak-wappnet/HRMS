<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Termwind\Components\Raw;
use App\Models\Holiday;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Support\Facades\Response;
use Psr\Http\Message\ResponseInterface;
use Yajra\DataTables\Contracts\DataTables;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
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
     * profile() return profile view 
     */
    public function profile() : View
    {
        return view('user.profile');
    }

    /**
     * profileAction() takes Request as argument
     * 
     * return RedirectResponse
     */
    public function profileAction(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);
        
        if ((User::where('name', '=', $request->username)->exists()) and (User::where('email', '=', $request->email)->exists())) {
            return back()->with("error", " username or password is already exist");
        }

        // updating User-Profile
        $this->userRepository->edit($request);
       
        return back()->with('status', 'Profile Updated');
    }

    /**
     * changePassword() return changePassword page
     */
    public function changePassword(): View
    {
        return view('user.changePassword');
    }

    /**
     * changePasswordAction() takes Request as argument
     * 
     * return RedirectRespose 
     */
    public function changePasswordAction(Request $request):RedirectResponse
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        // changing user password
        $this->userRepository->changePassword($request);
       
        return back()->with("status", "Password changed successfully");
    } 
   
}