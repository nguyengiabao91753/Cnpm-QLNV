<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account;
use App\Models\Admin\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('auth.clientlogin');
    }


    public function login(Request $request){
    // $credentials = $request->only('email', 'password');

    // // Lấy thông tin nhân viên từ bảng "employees" dựa trên email
    // $employee = Employee::where('email', $credentials['email'])->first();

    // // Nếu không tìm thấy thông tin nhân viên, xác thực thất bại
    // if (!$employee) {
    //     return redirect()->back()->with('error', 'Invalid credentials');
    // }

    // // Lấy mật khẩu từ bảng "accounts" dựa trên id nhân viên
    // //$account = DB::table('accounts')->where('employee_id', $employee->id)->first();
    // $account = Account::find($employee->id);
    // // Nếu không tìm thấy thông tin tài khoản hoặc mật khẩu không khớp, xác thực thất bại
    // if (!$account ||$credentials['password'] !== $account->password) {
    //     return redirect()->back()->with('error', 'Invalid credentials');
    // }

    // // Nếu thông tin xác thực hợp lệ, đăng nhập thành công
    // Auth::loginUsingId($employee->id);
    $credentials=[
        'email'=>$request->email,
        'password'=>$request->password,
    ];

    if (Auth::guard('web')->attempt($credentials)){
        return redirect()->route('profile');
    }

    return redirect()->back();
    //return redirect()->route('profile');
}
}
