<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id','desc')->paginate(10);
        return view('companies',['companies' => $companies]);
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
            'name' => 'required',
            'email' => 'required'
        ]);

        $name = trim($request->name);
        $email = strtolower(trim($request->email));
        $website = strtolower(trim($request->website));
        $image_name = null;
        if($request->hasFile('logo')){
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100'
            ]);
            $destination_path = 'public/images/logos';
            $image = $request->file('logo');
            $image_name = $image->getClientOriginalName();
            $request->file('logo')->storeAs($destination_path,$image_name);
        }

        $company = Company::create([
            'name' => $name,
            'email' => $email,
            'logo' => $image_name,
            'website' => $website,
        ]);
        if($company)
            return redirect()->back()->with(['msg' => 'New Company Successfully Added.']);
        else
            return redirect()->back()->with(['error' => 'Error']);
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
       return json_encode(Company::find($id));
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
            'name' => 'required',
            'email' => 'required',
        ]);
        if($request->hasFile('logo')){
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100'
            ]);
            $destination_path = 'public/images/logos';
            $image = $request->file('logo');
            $image_name = $image->getClientOriginalName();
            $request->file('logo')->storeAs($destination_path,$image_name);
        }

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        if(isset($image_name))
            $company->logo = $image_name;
        $company->save();
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
       return Company::find($id)->delete();
    }
}
