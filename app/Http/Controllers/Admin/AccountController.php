<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account;
use App\Models\Admin\Employee;
use App\Models\Admin\Level;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        $accs = Account::with('level')->where('status',1)->orderBy('created_at','DESC')->get();
        $accdelete = Account::with('level')->where('status',0)->orderBy('created_at','DESC')->get();
        $emps = Employee::where('status',1);
        return view("admin.modules.Employee.account",[
            'accs' => $accs,
            'emps'=>$emps,
            'accdeletes' => $accdelete
        ]);
        
    }
    public function edit(string $id){
        $levels = Level::all();
        $acc = Account::find($id);

        return view('admin.modules.Employee.accountedit',[
            'levels' => $levels,
            'acc' => $acc
        ]);
    }

    public function update(Request $request, int $id)
    {
        $acc = Account::find($id);
        if($request->filled('level') ){
            $acc->level_id = $request->level;
        }
        $acc->email = $request->email;
        $acc->password = bcrypt($request->password);
        $acc->status = $request->status;
        $acc->save();

        return redirect() -> route('admin.account.index')->with('success','Update Successfully!');
    }

    public function restore(int $id){
        $acc = Account::find($id);
        $acc->status =1;
        $acc ->save();
        return redirect()->route('admin.account.index')->with('success',"Unlock Successfully!");
    }

    public function destroy(string $id)
    {
        $acc = Account::find($id);
        $acc->status =0;
        $acc ->save();
        return redirect()->route('admin.account.index')->with('success',"Lock Successfully!");
    }
}
