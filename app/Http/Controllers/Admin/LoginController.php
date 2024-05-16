<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin./');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $check = Account::where('email', $request->email)->first(); // Fix typo here 'enail' to 'email'
        if (!$check || !Hash::check($request->password, $check->password)) {
            return redirect()->back()->with('error', 'Invalid user or password');
        }

        if ($check->level_id >= 3) {
            return redirect()->back()->with('error', 'You don\'t have permission to access this');
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            // if(Auth::user()->level_id >= 3){
            //     return redirect()->back()->with('error','You don\'t have any permission this access');
            // }
            return redirect()->route('admin./');
        }

        return redirect()->back()->with('error', 'Invalid user or password');
        //return redirect()->route('profile');
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
