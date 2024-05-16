<?php

namespace App\Http\Controllers;

use App\Mail\SendUserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestMailController extends Controller
{
    public function index(){
        return view('sendmail.testmail');
    }

    public function sendmail(Request $request){
        Mail::to($request->email)->send(new SendUserAccount($request->name, $request->email, $request->password));
        return redirect()->back();
    }
}
