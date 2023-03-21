<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Repositories\LeaveRepository;
use app\Interfaces\LeaveInterface;
use GrahamCampbell\ResultType\Success;

class LeaveController extends Controller
{
    protected $leaveRepository;

    /**
     * adding constructor of leaverRepository
     */    
    public function __construct(LeaveRepository $leaveRepostoryObject)
    {
        $this->leaveRepository = $leaveRepostoryObject;
    }

    /**
     * adding leave  
     */
    public function addAction(Request $request){
        $request->validate([
            'subject' => 'required',
            'description' => 'required',
            'start_date' => 'required |date',
            'end_date' => 'required|date',
            'reason' => 'required',
            'reliver_work' => 'required',            
        ]);

        $leave_data = $request->all();

        $this->leaveRepository->addLeave($leave_data);

        return back()->with('Success','leave created');        
    }
}
