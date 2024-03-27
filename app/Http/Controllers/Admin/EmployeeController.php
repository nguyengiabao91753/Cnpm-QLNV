<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emps = Employee::where('status',1)->orderBy('created_at', 'DESC')->get();
        return view('admin.modules.Employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.Employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $emp = new Employee();
        $emp->name = $request->name;
        $emp->identity_number = $request->identity_number;
        $emp->birthday = $request->birthday;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->gender = $request->gender;
        $file = $request->image;
        $filename= time(). '-' .$file->getClientOriginalName();

        $emp->image = $filename;

        if($request->filled('supervisor') ){
            $emp->supervisor_id = $request->supervisor;
        }
        if($request->filled('department') ){
            $emp->department_id = $request->department;
        }
        if($request->filled('salary_level') ){
            $emp->salary_level = $request->salary_level;
        }
        if($request->filled('level') ){
            $emp->level_id = $request->level;
        }


        $file->move(public_path('uploads/'), $filename);
        $emp->save();

        return redirect()->route('admin.employee.index')->with('success','Add Successfully!');
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
