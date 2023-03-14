<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\EmployeeRepository;
use Illuminate\Contracts\View\View;
use \Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Interfaces\EmployeeInterface;


class EmployeeController extends Controller
{

    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeInterface)
    {
        $this->employeeRepository = $employeeInterface;
    }

    // listing all the users
    public function index():View
    {
        return view('admin.users');
    }

    // index action on employee 
    public function indexAction(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->employeeRepository->listEmployee();
            
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

    // adding Employee 
    public function add():View
    {
        return view('admin.addEmployee');
    }
     
    // add employee action page
    public function addAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        
        // creating new Employee
        $data = $request->all();         
        $this->employeeRepository->add($data);

        Alert::success('Employee Added', 'Employee added Successfully');          
        return redirect()->route('index');
    }

    // edit employee page
    public function edit($id):View
    {         
        // finding employee by id
        $user = $this->employeeRepository->find($id);
        return view('admin.editEmployee',compact('user'));
    }

    // edit employee action page
    public function editAction(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        // editing Employee
        $this->employeeRepository->edit($request,$user);

        Alert::success('Employee Edited', 'Employee edited Successfully');
        return redirect()->route('index');
    }

    // deleting employee
    public function delete($id)
    {        
        // deleting Employee
        $this->employeeRepository->delete($id);
     
        Alert::success('Employee Deleted', 'Employee added Successfully');
        return back();
    }
}
