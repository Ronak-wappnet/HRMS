<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \Yajra\Datatables\Datatables;

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
                
        return view('users');
    }
    // public function editUserPage(User $user){
        
    //     return view('admin.editUser',compact('user'));
    // }


    // public function editUser(Request $request,User $user){

    //     $request->validate([

    //         'name' => 'required',
    //         'email'=> 'required|email',
    //     ]);
    //     // if((User::where('name', '=', $request->username)->exists()) OR (User::where('email', '=', $request->email)->exists())){

    //     //     return back()->with("error", " username or password is already exist");
    //     // }       
    //     /** @var \App\Models\User $user */
    //         $user->update($request->all());
    //     // $user->name = $request['username'];
    //     // $user->email = $request['email'];
    //     // $user->save();
    //     return back()->with('status','Profile Updated');
    // }


    // public function userSoftDelete(user $user)
    // {        
    //     $user->delete();
    //     return back()->with('status','User Deleted');
    // }

    public function userSoftDelete($id)
    {        
        $user=User::find($id);
        $user->delete();
        return back()->with('status','User Deleted');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", '<form action="" method="get">
                @csrf
                @method("DELETE")
                    <a  href="{{route("userSoftDelete",$id)}}" title="Delete" >
                    <i class="fa fa-trash" style="font-size:20px;color:red "></i>
                </a>               
                @method("Edit")
                    <a  href="{{Route("editUserPage",$id)}}" title="Edit"  >
                    <i class="fa fa-edit" style="font-size:20px;color:green "></i>
                </a>   
                </form>')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('testing');
    }

    public function editUserPage($id){
        
        $user=User::find($id);
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
