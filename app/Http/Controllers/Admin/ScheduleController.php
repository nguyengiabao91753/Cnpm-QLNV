<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use App\Models\Admin\Room;
use App\Models\Admin\Shift;
use App\Models\Admin\Work_Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        $shedule = Work_Schedule::with('employee','room','shift')->get();
        return view('admin.modules.Schedule.index',[
            'schedules' => $shedule
        ]);
    }
    public function create(){
        $deps = Department::all();
        $shifts = Shift::all();
        return view("admin.modules.Schedule.create",[
            'deps' => $deps,
            'shifts' => $shifts
        ]);
    }

    public function store( Request $request){
        $scheule = new Work_Schedule();
        $scheule->emp_id = $request->emp_id;
        $scheule->shift_id = $request->shift_id;
        $scheule->room_id = $request->room_id;
        $scheule->date = $request->date;
        $scheule->save();
        return redirect()->route('admin.schedule.index')->with('success',"Add Successfully!");
    }

    public function edit(string $id){
        $deps = Department::all();
        $shifts = Shift::all();
        $sche = Work_Schedule::find($id);
        $rooms = Room::where('department_id',$sche->room->department_id)->get();
        return view("admin.modules.Schedule.edit",[
            'deps' => $deps,
            'shifts' => $shifts,
            'schedule' => $sche,
            'rooms' => $rooms
        ]);
    }

    public function update(Request $request,string $id){
        $sche = Work_Schedule::find($id);
        $sche->room_id = $request->room_id;
        $sche->shift_id = $request ->shift_id;
        $sche->date = $request->date;

        $sche->save();

        return redirect()->route('admin.schedule.index')->with('success',"Update Successfully!");

    }

    public function destroy(string $id){
        $sche = Work_Schedule::find($id);
        $sche->delete();
        return redirect()->route('admin.schedule.index')->with('success',"Delete Successfully!");
    }



    
}