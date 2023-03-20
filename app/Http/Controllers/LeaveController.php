<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * adding leave 
     */
    public function addAction(Request $request){
        dd($request->all());
    }
}
