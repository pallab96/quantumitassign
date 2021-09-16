<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index(){
        return view('index'
        ,['total_c' => Company::count(),'total_e' => Employee::count()]
        );
    }
}
