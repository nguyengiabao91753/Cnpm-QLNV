<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Attendance;
use App\Models\Admin\Emp_Salary;
use App\Models\Admin\Employee;
use App\Models\Admin\Work_Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function calc()
    {
        $previousMonth = Carbon::now()->subMonth();
        $check = Emp_Salary::whereYear('created_at', $previousMonth->year)->whereMonth('created_at', $previousMonth->month +1)->first();
        if ($check != null) {
            return redirect()->route('admin./')->with('error', "Already Calculated!");
        }

        $emps = Employee::with('salary')->get();
        foreach ($emps as $emp) {

            $works = Work_Schedule::where('emp_id', $emp->id)->whereYear('date', $previousMonth->year)
                ->whereMonth('date', $previousMonth->month)->pluck('id');
            if(count($works)<25) continue;
            $attendances = Attendance::whereIn('work_id', $works)->get();
            $salary = $emp->salary->base * $emp->salary->factor + $emp->salary->base * $emp->salary->allowance_factor / 100;
            $sa_day = $salary / 30;
            $abs = 0;
            $late = 0;
            $leave_early = 0;
            $overtime = 0;
            foreach ($attendances as $att) {
                if ($att->leave_approved == 0 && $att->present == 0) {
                    $abs += 1;
                } else {
                    if (strpos($att->description, 'Late')) {
                        $late += 1;
                    }
                    if (strpos($att->description, 'early')) {
                        $leave_early += 1;
                    }
                    if (strpos($att->description, 'Overtime')) {
                        $overtime += 1;
                    }
                }
            }

            $total = $salary - (($sa_day * $abs) + ($sa_day / 2 * $late) + ($sa_day / 2 * $leave_early)) + ($sa_day * 0.2 * $overtime);
            $empsa = new Emp_Salary();
            $empsa->emp_id = $emp->id;
            $empsa->total = $total;
            $empsa->base = $emp->salary->base;
            $empsa->factor = $emp->salary->factor;
            $empsa->allowance_factor = $emp->salary->allowance_factor;
            $empsa->save();
        }

        return redirect()->route('admin./')->with('success', "Successfully!");
    }

    public function showsal()
    {

        $month = $_GET['sal_month'];
        $year = $_GET['sal_year'];

        $emp = Employee::find(Auth::guard('client')->id());


        $works = Work_Schedule::where('emp_id', $emp->id)->whereYear('date', $year)
            ->whereMonth('date', $month-1)->pluck('id');
        $attendances = Attendance::whereIn('work_id', $works)->get();

        $empsa = Emp_Salary::with('employee')->where('emp_id',  $emp->id)->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)->first();

        $salary = $empsa->base *  $empsa->factor +  $empsa->base * ($empsa->allowance_factor / 100);
        //$sa_day = $salary / 30;
        $abs = 0;
        $late = 0;
        $leave_early = 0;
        $overtime = 0;
        foreach ($attendances as $att) {
            if ($att->leave_approved == 0 && $att->present == 0) {
                $abs += 1;
            } else {
                if (strpos($att->description, 'Late') !== false) {
                    $late += 1;
                }
                if (strpos($att->description, 'early')) {
                    $leave_early += 1;
                }
                if (strpos($att->description, 'Overtime')) {
                    $overtime += 1;
                }
            }
        }

        $response = [
            'base' => $empsa->base,
            'factor' => $empsa->factor,
            'allowance_factor' => $empsa->allowance_factor,
            'abs' => $abs,
            'late' => $late,
            'leave_early' => $leave_early,
            'overtime' => $overtime,
            'total' => $empsa->total,
            'salary' => $salary
        ];

        return response()->json($response);

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
