<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\MenuTrait;

class EmployeesController extends Controller
{
 
    use MenuTrait;

    public $sidebar;

    public function __construct()
    {
        $this->sidebar = $this->getSidebar();
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employees = \App\Employees::simplePaginate(10);

        return view('employees.index', [
            'menu' => $this->sidebar['menu'],
            'employees' => $employees
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies = \App\Companies::get();

        return view('employees.create', [
            'menu' => $this->sidebar['menu'],
            'companies' => $companies
        ]);

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
            'name_first' => 'required',
            'name_last' => 'required',
            'email' => 'required|email',
            'telephone' => 'required|numeric|digits_between:9,11',
            'company_id' => 'required|numeric'
        ]);

        try {

            $employees = new \App\Employees([
                'name_first' => $request->get('name_first'),
                'name_last' => $request->get('name_last'),
                'company_id' => $request->get('company_id'),
                'email' => $request->get('email'),
                'telephone' => $request->get('telephone')
            ]);

            $employees->save();

            return redirect('/employees')->with('success', "Employee saved!");

        } catch(Exception $e) {

            return back()->withInput();

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
        $employee = \App\Employees::find($id);
        return view('employees.edit', [
            'menu' => $this->sidebar['menu'],
            'employee' => $employee
        ]);
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
            'name_first' => 'required',
            'name_last' => 'required',
            'email' => 'required|email',
            'telephone' => 'required|numeric|digits_between:9,11'
        ]);

        $employee = \App\Employees::find($id);
        $employee->name_first = $request->get('name_first');
        $employee->name_last = $request->get('name_last');
        $employee->email = $request->get('email');
        $employee->telephone = $request->get('telephone');
        $employee->save();

        return redirect('/employees')->with('success', "Employee updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
 
            $companies = \App\Employees::find($id);
    
            $companies->delete();

            return redirect('/employees')->with('success', "Employee deleted!");

        } catch(Exception $e) {

            return back()->withInput();

        }

    }
}
