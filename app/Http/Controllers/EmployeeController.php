<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
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
            $employees = Employee::latest()->paginate(10);   
                        
            return view('employees.index',compact('employees'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
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
        $data = Company::get();

        return view('employees.create',['datas' => $data]);
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
            'first_name' => 'required',
            'last_name' => 'required',
        ]);      
   
        Employee::create($request->all());

        return redirect()->route('employees.index')
                        ->with('success','Employee created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $company = Company::where('id',$employee->company)->first();

        return view('employees.show',compact('employee','company'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $datas      = Company::get();

        return view('employees.edit',compact('employee','datas'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
  
        $employee->update($request->all());
  
        return redirect()->route('employees.index')
                        ->with('success','Employee updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
  
        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }
}