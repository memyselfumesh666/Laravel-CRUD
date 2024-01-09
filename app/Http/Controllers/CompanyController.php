<?php

namespace App\Http\Controllers;

use App\Models\Company;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(Auth::check())
        {
            $companies = Company::latest()->paginate(5);
  
            return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        }
        return redirect("login")->withSuccess('You are not allowed to access');        
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('logo')) 
        {
            $destinationPath    = 'company_logo/';

            $profileImage       = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);

            $input['logo']      = "$profileImage";
        }
  
        Company::create($input);
   
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $input = $request->all();

        if ($image = $request->file('logo')) 
        {
            $destinationPath    = 'company_logo/';

            $profileImage       = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);

            $input['logo']      = "$profileImage";
        }
        else
        {
            unset($input['logo']);
        }

        $company->update($input);
  
        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
  
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');
    }
}