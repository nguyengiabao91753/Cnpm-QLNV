<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use App\Models\Admin\Emp_Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getemp(){
        $emp = Employee::find(Auth::guard('client')->id());
        $sal_months = Emp_Salary::selectRaw('DISTINCT MONTH(created_at) AS month')
        ->where('emp_id',Auth::guard('client')->id() )
        ->orderBy('month', 'desc')
        ->get();
        $years = Emp_Salary::selectRaw('DISTINCT YEAR(created_at) AS year')
        ->where('emp_id', Auth::guard('client')->id())
        ->orderBy('year', 'desc') // Sắp xếp theo năm từ cao đến thấp
        ->get();
        return view('client.modules.Profile',[
            'emp'=>$emp,
            'sal_months' => $sal_months,
            'sal_years' => $years

        ]);
    }
}
