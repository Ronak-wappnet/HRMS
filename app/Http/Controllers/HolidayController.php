<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class HolidayController extends Controller
{
    public function index(): View
    {
        return view('holiday.Holiday');
    }

    public function indexAction()
    {
        if (request()->ajax()) {
            $data = Holiday::all();

            return datatables()->of($data)
                ->addColumn("action", '<form action="" method="get">
            @csrf
            @method("DELETE")                
                <a  href="#" title="Delete" >
                <i class="fa fa-trash" style="font-size:20px;color:red "></i>
            </a>               
            @method("Edit")
                <a  href="#" title="Edit"  >
                <i class="fa fa-edit" style="font-size:20px;color:green "></i>
            </a>   
            </form>')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }
    
    /**
     * createHoliday() will retun createHoliday view
     */
    public function createHoliday(): View
    {
        return view('holiday.addHoliday');
    }

    /**
     * createHolidayAction take Request as argument
     * 
     * return RedirectResponse
     */
    public function createHolidayAction(Request $request): RedirectResponse
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
