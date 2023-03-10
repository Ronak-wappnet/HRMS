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

class UserController extends Controller
{
    //
    public function profile(): View
    {
        return view('user.profile');
    }

    public function profileAction(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);
        
        if ((User::where('name', '=', $request->username)->exists()) and (User::where('email', '=', $request->email)->exists())) {
            return back()->with("error", " username or password is already exist");
        }
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->name = $request['username'];
        $user->email = $request['email'];
        $user->save();
        return back()->with('status', 'Profile Updated');
    }

    public function changePassword(): View
    {
        return view('user.changePassword');
    }

    public function changePasswordAction(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        User::Where('id', '=', auth()->user()->id)->update(
            [
                'password' => Hash::make($request->new_password)
            ]
        );
        return back()->with("status", "Password changed successfully");
    }

    //user holiday page
    public function createHoliday(): View
    {
        return view('admin.addHoliday');
    }

    //create holiday form action
    public function createHolidayAction(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'year' => 'required',
        ]);
        $data = $request->all();
        $holiday = new Holiday;
        if (array_key_exists('optional', $data)) {

            $holiday->title = $data['title'];
            $holiday->start_date = $data['start_date'];
            $holiday->end_date = $data['end_date'];
            $holiday->optional = 0;
            $holiday->save();

        } else {

            $holiday->title = $data['title'];
            $holiday->start_date = $data['start_date'];
            $holiday->end_date = $data['end_date'];
            $holiday->save();
        }
        return back()->with('success', 'Holiday added');
    }
    //list holiday code
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $holiday = Holiday ::all();            
    //         return Datatables::of($holiday)->addIndexColumn()
    //             ->addColumn("action", '<form action="" method="get">
    //             @csrf
    //             @method("DELETE")                
    //                 <a  href="#" title="Delete" >
    //                 <i class="fa fa-trash" style="font-size:20px;color:red "></i>
    //             </a>               
    //             @method("Edit")
    //                 <a  href="#" title="Edit"  >
    //                 <i class="fa fa-edit" style="font-size:20px;color:green "></i>
    //             </a>   
    //             </form>')
    //             ->rawColumns(['action'])
    //             ->addIndexColumn()
    //             ->make(true);
    //     }
    //     return view('user.holiday');
    // }
}