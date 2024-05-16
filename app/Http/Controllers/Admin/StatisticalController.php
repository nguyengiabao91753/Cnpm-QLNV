<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Attendance;
use App\Models\Admin\Department;
use App\Models\Admin\Emp_Salary;
use App\Models\Admin\Employee;
use App\Models\Admin\Position;
use App\Models\Admin\Room;
use App\Models\Admin\Work_Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = Carbon::now()->startOfMonth();
        $date = Carbon::create(2024, 4, 25);
        $currentDate = Carbon::today();

        
        $atts = Attendance::whereDate('created_at', $currentDate)->get();
       
        $dateToCompare = $currentDate->copy()->day(16);
        $empsa_date = Emp_Salary::whereDate("created_at", $dateToCompare)->first();
        $deps = Department::all();
        $countemp = Employee::count();
        $countdep = Department::count();
        $countroom = Room::count();
        $countpos = Position::count();
        return view('admin.modules.Statistical',[
            'countemp' => $countemp,
            'countdep' => $countdep,
            'countroom' => $countroom,
            'countpos'=> $countpos,
            'empsa_date' => $empsa_date,
            'atts' => $atts,
            'deps' => $deps
        ]);
    }

    public function getattbydep(){
         $value = $_GET['depId'];
        // $atts['data'] = Attendance::join('work__schedules', 'attendances.work_id', '=', 'work__schedules.id')
        // ->join('employees', 'work__schedules.emp_id', '=', 'employees.id')
        // ->join('positions', 'employees.position_id', '=', 'positions.id')
        // ->join('departments', 'positions.department_id', '=', 'departments.id')
        // ->where('departments.id', $value)
        // ->get();
        // return response()->json($atts);
        // $dep = Department::find($value);
        $pos = Position::where('department_id', $value)->get()->pluck('id');
        $emps = Employee::with('position')->whereIn('position_id', $pos)->get()->pluck('id');
        $works = Work_Schedule::with('room','shift','employee')->whereIn('emp_id', $emps)->get()->pluck('id');
        $atts['data'] = Attendance::with('work')->whereIn('work_id', $works)->get();

    return response()->json($atts);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
