<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Models\Company;
use App\Models\User;
use Datatables;
use Illuminate\Support\Facades\Hash;
 
class DataTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(User::select('id','name','email'))
            ->addColumn("action",' <a href="javascript:void(0)" id="edit-user" data-toggle="tooltip" onClick="editFunc({{ $id }})" data-original-title="Edit"
    class="edit btn btn-success edit">
    Edit
</a>
<a href="javascript:void(0)" id="delete-user" onClick="deleteFunc({{ $id }})" data-toggle="tooltip"
    data-original-title="Delete" class="delete btn btn-danger">
    Delete
</a>')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('testing.adminAccess');
    }
      
      
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
 
        $companyId = $request->id;
 
        $company   =   User::updateOrCreate(
                    
                    [
                    'name' => $request->name, 
                    'email' => $request->email,
                    'password'=> Hash::make($request->password),
                    ]);    
                         
        return Response()->json($company);
 
    }
      
      
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $company  = User::where($where)->first();
      
        return Response()->json($company);
    }
      
      
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = User::where('id',$request->id)->delete();
      
        return Response()->json($company);
    }
}
?>