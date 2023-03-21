<?php

namespace app\Repositories;

use app\Interfaces\LeaveInterface;
use app\Models\Leave;

class LeaveRepository implements LeaveInterface{
 
    public function addLeave($data)
    {
        Leave::create([
            'subject' => $data['subject'],
            'description' => $data['description'],
            'start_day' => $data['start_date'],
            'start_day_leave_type'=> $data['start_date_leave_type'],
            'end_date' => $data['end_date'],
            'end_day_leave_type' => $data['end_date_leave_type'],
            'reason' => $data['reason'],
            'Reliver_work' => $data['reliver_work'],
        ]);        
        
    }
}