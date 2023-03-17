<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;


class HolidayController extends Controller
{
    /**
     * index() will list all holidays
     *
     * @return Holiday datatable with 2 buttons edit and delete
     */

    public function index(): View
    {
        return view('holiday.Holiday');
    }

    public function indexAction()
    {
        if (request()->ajax()) {
            $data = Holiday::select('id', 'title', 'day', 'start_date', 'optional')->get();

            return datatables()->of($data)
                ->addColumn("action", '<form id="confirm_delete" action="{{ Route("holiday-delete",$id) }}" method="POST">
            @csrf
            @method("Edit")
                <a  href="{{ Route("holiday-edit",$id ) }}" title="Edit" >
                <i class="fa fa-edit" style="font-size:20px;color:green "></i>
            </a>
            @method("DELETE")                
                <button  href="#" class="delete" title="delete" data-id={{ $id }} type="submit">
                <i class="fa fa-trash" style="font-size:20px;color:red "></i>
            </button>              
               
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

        //converting string to date and adding finding day from start_day

        $date = date_create($data['start_date']);
        $day = date_format($date, "l");

        $holiday = new Holiday;
        if (array_key_exists('optional', $data)) {

            $holiday->title = $data['title'];
            $holiday->start_date = $data['start_date'];
            $holiday->end_date = $data['end_date'];
            $holiday->optional = 'yes';
            $holiday->day = $day;
            $holiday->save();
        } else {

            $holiday->title = $data['title'];
            $holiday->start_date = $data['start_date'];
            $holiday->end_date = $data['end_date'];
            $holiday->day = $day;
            $holiday->save();
        }

        Alert::success('Holiday Added', 'Holiday added Successfully');
        return redirect()->route('holiday-index');
    }

    public function edit($id): View
    {
        // finding employee by id
        $holiday = Holiday::find($id);
        return view('holiday.editHoliday', compact('holiday'));
    }

    public function editAction(Request $request, Holiday $holiday): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'year' => 'required',
        ]);


        // editing Employee
        $holiday->update($request->all());

        Alert::success('Holiday Edited', 'Holiday Edited Successfully');
        return redirect()->route('holiday-index');
    }

    // public function delete(Request $request)
    // {      

    //     Holiday::find($request->id)->delete();
    //     return redirect()->route('admin.users')
    //         ->with('success', 'Holiday deleted successfully');
    // }

    public function delete($id)
    {
        dd($id);
        $holiday = Holiday::find($id);
        $holiday->delete();
        return back();

    }
}
