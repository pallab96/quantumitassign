<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Employee::orderBy('id','desc')->paginate(10);
        return view('employee',['employees' => $companies,'companies' => Company::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'company' => 'required'
        ]);

        $fname = trim($request->firstname);
        $lname = trim($request->lastname);
        $email = strtolower(trim($request->email));
        $phone = trim($request->phone);

        $employee = Employee::create([
            'f_name' => $fname,
            'l_name' => $lname,
            'email' => $email,
            'phone_no' => $phone,
            'company_id' => $request->company
        ]);
        if($employee)
            return redirect()->back()->with(['msg' => 'Employee has Successfully Added.']);
        else
            return redirect()->back()->withErrors(['msg' => 'Somthing else wrong!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return json_encode(Employee::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'company' => 'required'
        ]);
        Employee::where('id',$id)->update([
            'f_name' => $request->firstname,
            'l_name' => $request->lastname,
            'email' => $request->email,
            'phone_no' => $request->phone,
            'company_id' => $request->company
        ]);
        return redirect()->back()->with(['msg' => "Successfully Update."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Employee::find($id)->delete();
    }
}
