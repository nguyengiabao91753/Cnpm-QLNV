<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use App\Models\Admin\Emp_Salary;
use App\Models\Admin\Employee;
use App\Models\Admin\Position;
use App\Models\Admin\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = Carbon::now();

       
        $dateToCompare = $currentDate->copy()->day(5);

        $countemp = Employee::count();
        $countdep = Department::count();
        $countroom = Room::count();
        $countpos = Position::count();
        $empsa_date = Emp_Salary::where("created_at", $dateToCompare)->first();
        return view('admin.modules.Statistical',[
            'countemp' => $countemp,
            'countdep' => $countdep,
            'countroom' => $countroom,
            'countpos'=> $countpos,
            'empsa_date' => $empsa_date
        ]);
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
