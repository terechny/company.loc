<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\Employee;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['companies'] = Company::all();

        return view('company_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company_create');
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
            'email' => 'required|email',
            'logo' => 'required',
            'adress' => 'required'
        ]);

        if ($request->hasFile('logo')) {

            $imagePath = Storage::disk('public')->putFile('logo', $request->file('logo'));
        }

        $res = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $imagePath,
            'adress' => $request->adress          
        ]);

        if($res){
            return redirect()->route('company.index')->with('status', 'Profile updated!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                
        $company = Company::findOrFail($id);

        $data['company'] = $company;
        $data['employees'] = $company->employees;

        return view('company_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['company'] = Company::findOrFail($id);
        return view('company_edit', $data);
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
            'email' => 'required|email',
            'adress' => 'required'
        ]);

        $company = Company::findOrFail($id);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->adress = $request->adress;

        if ($request->hasFile('logo')) {

            $company->logo = Storage::disk('public')->putFile('logo', $request->file('logo'));
        }

        if($company->save()){
            return redirect()->route('company.show', ['company' => $id])->with('status', 'Profile updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $company = Company::findOrFail($id);
        $company->employees()->delete();     
        $company->delete();
     
        return redirect()->route('company.index')->with('status', 'Profile updated!');
    }
}
