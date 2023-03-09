<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    // listing all the users
    public function index():View
    {
        return view('admin.users');
    }

    //index action on employee 
    public function indexAction(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", '<form action="" method="get">
                @csrf
                @method("DELETE")                
                    <a  href="{{Route("delete",$id)}}" title="Delete" >
                    <i class="fa fa-trash" style="font-size:20px;color:red "></i>
                </a>               
                @method("Edit")
                    <a  href="{{Route("edit",$id)}}" title="Edit"  >
                    <i class="fa fa-edit" style="font-size:20px;color:green "></i>
                </a>   
                </form>')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.users');
    }

    //adding Employee 
    public function add():View
    {
        return view('admin.addEmployee');
    }
     
    //add employee action page
    public function addAction(Request $request)
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

        Alert::success('Employee Added', 'Employee added Successfully');
          
        return redirect()->route('index');
        // return back()->with('success','User Added');
    }

    //edit employee page
    public function edit($id):View
    {         
        $user=User::find($id);
        return view('admin.editEmployee',compact('user'));
    }

    //edit employee action page
    public function editAction(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $user->update($request->all());
        return redirect()->route('index')->with('Success','User Edited Successfully');
    }

    //deleting employee
    public function delete($id)
    {        
        $user=User::find($id);
        $user->delete();
        Alert::success('Employee Deleted', 'Employee added Successfully');
        return back();
    }


}
