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
        if(Auth::guard('client')->check()){
            return redirect()->route('profile');
        }
        return view('auth.clientlogin');
    }


    public function login(Request $request){
    $credentials=[
        'email'=>$request->email,
        'password'=>$request->password,
    ];

    if (Auth::guard('client')->attempt($credentials)){
        return redirect()->route('profile');
    }

    return redirect()->back()->with('error','Invalid user or password');
    //return redirect()->route('profile');
    }

    
}
