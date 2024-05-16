<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request,string $guard){
        Auth::guard($guard)->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->back();
    }
}
