<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Attendance;
use App\Models\Admin\Work_Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index() {
        $atts = Attendance::with('work')->where('present',1)->orderBy('created_at','DESC')->get();
        $absatts = Attendance::with('work')->where('present',0)->orderBy('created_at','DESC')->get();
        return view('admin.modules.Attendance.index',[
            'atts' => $atts,
            'absatts' => $absatts
        ]);
    }
    public function request(){
        $atts = Attendance::with('work')->where('leave_request',1)->where('leave_approved',null)->orderBy('created_at','DESC')->get();
        return view('admin.modules.Attendance.request',[
            'atts' => $atts
        ]);
    }

    public function getatt(string $data){
        $works = Work_Schedule::with('employee','room','shift')->where('date', $data)->pluck('id')->toArray();
        $atts = Attendance::with('work')->where('work_id',$works)->get();
        $work['data'] = Work_Schedule::with('employee','room','shift')->where('date', $data)->get();
        return response()->json($work);
    }

    public function show(string $id){
        $att = Attendance::find($id);
        return view('admin.modules.Attendance.showrequest',[
            'att'=>$att
        ]);
    }

    public function allow(Request $request, string $id){
        $att = Attendance::find($id);
        $att->leave_approved = 1;
        //$att->status = "Approve day-off";
        $att->save();
        return redirect()->route('admin.attendance.request')->with('success','Allow Successfully!');
    }
    public function destroy(Request $request, string $id){
        $att = Attendance::find($id);
        $att->leave_approved = 0;
        //$att->status = "Leave days are not approved";
        $att->save();
        return redirect()->route('admin.attendance.request')->with('success','Allow Successfully!');
    }

    

    public function clock_in(Request $request, string $work_id){
        $att = new Attendance();
        $att->work_id =  $work_id;
        $att->present = 1;
        $timenow =  Carbon::now()->toTimeString();
        $att->clock_in = $timenow;
        $att->clock_out = NULL;

        $work = Work_Schedule::find($work_id);
        $startTime = Carbon::createFromFormat('H:i:s', $work->shift->start);

        if (Carbon::parse($att->clock_in)->gt($startTime)) {
            // Nếu $att->clock_in trễ hơn $start
            $status = "Late " . Carbon::parse($att->clock_in)->diff($startTime)->format('%H h %i m');
        } elseif (Carbon::parse($att->clock_in)->lt($startTime)) {
            // Nếu $att->clock_in sớm hơn $start
            $status = "Early " . $startTime->diff(Carbon::parse($att->clock_in))->format('%H h %i m');
            
        } else {
            
            $status = "On Time";
           
        }

        $att->description = $status;
        $att->status = 1;

        $att->save();
        return redirect()->back();
    }

    public function clock_out(Request $request, string $id){
        $att  = Attendance::where('work_id', $id)->first();
        $timenow =  Carbon::now()->toTimeString();
        $att->clock_out =  $timenow;

        $work = Work_Schedule::find($id);
        $endTime = Carbon::createFromFormat('H:i:s', $work->shift->end);

        
        if (Carbon::parse($att->clock_out)->gt($endTime)) {
            // Nếu $att->clock_out trễ hơn $end
            $status = "Overtime " . Carbon::parse($att->clock_out)->diff($endTime)->format('%H h %i m');
           
            
        } elseif (Carbon::parse($att->clock_out)->lt($endTime)) {
            // Nếu $att->clock_out sớm hơn $end
            $status = "Leave early " . $endTime->diff(Carbon::parse($att->clock_out))->format('%H h %i m');
           
        } else {
            
            $status = "Leave on Time";
            
        }

        $att->description = $att->status."-".$status;

        $att->save();
        return redirect()->back();
    } 

    public function dayoff(Request $request, string $id){
        $att = new Attendance();
        $att->work_id = $id;
        $att->present = 0;
        $att->leave_request = 1;
        $att->description = $request->description;
        $att->status = 0;
        $att->save();
        return redirect()->back();
    }
}