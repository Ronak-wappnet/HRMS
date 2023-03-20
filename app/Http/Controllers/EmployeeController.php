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
use Illuminate\Http\RedirectResponse;
use Nette\Utils\Json;
use Yajra\DataTables\Contracts\DataTable;

class EmployeeController extends Controller
{
    private $employeeRepository;
    
    /**
     *  initializing object of userRepository 
     * 
     */
    public function __construct(EmployeeRepository $employeeInterface)
    {
        $this->employeeRepository = $employeeInterface;
    }

    /**
     * index() will list all the employees or users 
     * 
     * return view
     */
    public function index():View
    {
        return view('admin.users');
    }

    /**
     * indexAction() takes Request as argument
     * 
     * Return to users View
     */ 
    public function indexAction(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->employeeRepository->listEmployee();
            
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", '<form action="" method="get">
                @csrf
                @method("DELETE")                
                <button  href="#" class="delete" title="delete" data-url="{{ Route("delete", $id ) }}" data-id={{ $id }} type="submit">
                <i class="fa fa-trash" style="font-size:20px;color:red "></i>
                </button> 
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

    /**
     * add() add the employee
     * 
     * Return addEmployee View
     */
    public function add():View
    {
        return view('admin.addEmployee');
    }
     
    /** 
     * addAction() takes Request as argument
     * 
     * Return RedirectResponse
     */
    public function addAction(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        /**
         * creating new Employee
         */
        $data = $request->all();         
        $this->employeeRepository->add($data);

        Alert::success('Employee Added', 'Employee added Successfully');          
        return redirect()->route('index');
    }

    /**
     * edit() takes id as argument for edit 
     * 
     * return compact view with Employee data
     */
    public function edit($id):View
    {         
        // finding employee by id
        $user = $this->employeeRepository->find($id);
        return view('admin.editEmployee',compact('user'));
    }

    /**
     * editAction() takes Request and User as argument
     * 
     * return RedirectReasponse and redirect to index route
     */
    public function editAction(Request $request, User $user) : RedirectResponse
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

    /**
     * delete() will take employee id as argument 
     * 
     * return back to list employeepage
     */
    public function delete($id) : RedirectResponse
    {        
        // deleting Employee
        $this->employeeRepository->delete($id);
     
       
        return back();
    }
}
