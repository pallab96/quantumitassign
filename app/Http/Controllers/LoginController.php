<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return view('login');
        }
        return redirect()->route('home');
    }
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){
                return redirect()->route('home');
        }
        else{
            return redirect()->back()->with(['error' => 'Invalid Email or Password']);
        }
    }

    public function logout(Request $req){
        Auth::logout();
        return redirect()->route('login');

    }
}
