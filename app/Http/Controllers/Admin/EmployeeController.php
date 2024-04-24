<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\StoreRequest;
use App\Http\Requests\Admin\Employee\UpdateRequest;
use App\Models\Admin\Account;
use App\Models\Admin\Department;
use App\Models\Admin\Employee;
use App\Models\Admin\Position;
use App\Models\Admin\Salary;
use App\Models\Admin\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emps = Employee::with('position', 'salary')->where('status',1)->orderBy('created_at', 'DESC')->get();
        return view('admin.modules.Employee.index',[
            'emps'=>$emps
        ]);
    }

    public function getempbypos(string $id){
        $emp['data'] = Employee::with('position')->where('position_id', $id)->get();
        return response()->json($emp);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $level = Level::all();
        $level_sup_ids = Level::whereIn('name', ["Admin", "Super Admin"])->pluck('id')->toArray();
        $accs = Account::whereIn('level_id', $level_sup_ids)->get();
    
        $dep = Department::all();
        $salary = Salary::all();
        return view('admin.modules.Employee.create',[
            'accs' => $accs,
            'deps' => $dep,
            'sals' => $salary,
            'levels' => $level
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $emp = new Employee();
        $acc = new Account();
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
        if($request->filled('position_id') ){
            $emp->position_id = $request->position_id;
        }
        if($request->filled('salary_level') ){
            $emp->salary_level = $request->salary_level;
        }
        if($request->filled('level') ){
            $acc->level_id = $request->level;
        }


        $file->move(public_path('uploads/'), $filename);
        $emp->save();
        $acc->email = $emp->email;
        $acc->password = bcrypt($request->password);
        $acc->save();

        return redirect()->route('admin.employee.index')->with('success','Add Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $emp = Employee::find($id);
        return view('admin.modules.Employee.show',[
            'emp'=>$emp
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //$level = Level::all();
        $level_sup_ids = Level::whereIn('name', ["Admin", "Super Admin"])->pluck('id')->toArray();
        $accs = Account::whereIn('level_id', $level_sup_ids)->get();
        $emp = Employee::find($id);
        $dep = Department::all();
        $salary = Salary::all();
        return view('admin.modules.Employee.edit',[
            'accs' => $accs,
            'deps' => $dep,
            'sals' => $salary,
            // 'levels' => $level,
            'emp' => $emp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $emp = Employee::find($id);
        
        $emp->name = $request->name;
        $emp->identity_number = $request->identity_number;
        $emp->birthday = $request->birthday;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->gender = $request->gender;

        $file = $request->image;
        if(!empty($file)){
            $request->validate([
                //'image'=>'required|mimes: jpg, png, bmp, jpeg'  
            ], [
                'image.required'=>'Please choose image',
                'image.mimes'=>'Image must be jpg,png,bmp,jpeg'
            ]);
            $old_image_path=public_path('uploads/'.$emp->image);
            if(file_exists($old_image_path)) {
                unlink($old_image_path);
            }

            $fileName = time() . '-' . $file->getClientOriginalName();
            $emp->image= $fileName;
            $file->move(public_path('uploads/'),$fileName);
        }

        if($request->filled('supervisor') ){
            $emp->supervisor_id = $request->supervisor;
        }
        if($request->filled('position_id') ){
            $emp->position_id = $request->position_id;
        }
        if($request->filled('salary_level') ){
            $emp->salary_level = $request->salary_level;
        }
       

        $emp->save();
        
        return redirect()->route('admin.employee.index')->with('success','Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emp = Employee::find($id);
        $emp -> status = 2;
        $emp->save();
        $acc = Account::find($id);
        $acc ->status =2;
        $acc-> save();
        return redirect()->route('admin.employee.index')->with('success','Delete Successfully!');
    }
}
