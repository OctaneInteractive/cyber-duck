<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies = \App\Companies::simplePaginate(10);

        return view('companies.index', [
            'companies' => $companies
        ]);

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
            'email' => 'required|email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        try {

            $logoName = time() . '.' . $request->logo->extension();  
   
            $request->logo->move(public_path('logos'), $logoName);

            $companies = new \App\Companies([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'logo' => $logoName
            ]);

            $companies->save();

            return redirect('/companies')->with('success', "Company saved!");

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
        $company = \App\Companies::find($id);
        return view('companies.edit', [
            'company' => $company
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
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $company = \App\Companies::find($id);
        $company->name = $request->get('name');
        $company->email = $request->get('email');
        $company->save();

        return redirect('/companies')->with('success', "Company updated!");

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
 
            $companies = \App\Companies::find($id);
    
            unlink('logos/' . $companies->logo);

            $companies->delete();

            return redirect('/companies')->with('success', "Company deleted!");

        } catch(Exception $e) {

            return back()->withInput();

        }

    }
}
