<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\Attendance;
use App\Models\Admin\Employee;
use App\Models\Admin\Work_Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(){
         $shedule = Work_Schedule::with('employee','room','shift')->get();
         $atts = Attendance::with('work')->get();
         $emp = Employee::find(Auth::user()->id);
        return view('client.modules.Schedule',[
            'schedules' => $shedule,
            'atts' => $atts,
            'emp' => $emp
        ]);
    }

   
}
