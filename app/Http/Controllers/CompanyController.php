<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;

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
        $user = Auth::user()->id;
        $companies = Company::all()->where('user_id',$user);
        return view('index', compact('companies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
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
            'name'=>'required|string|min:8|max:20|unique:companies',
            'description'=>'required|string|min:10|max:100'
        ]);

        $company = Company::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'user_id'=>$request->input('user_id')
        ]);

        if($company){
            return redirect('/companies')->with('success','Company created success');
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
        $company = Company::with('projects')->find($id);
        return view('show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::with('projects')->find($id);
        return view('edit',compact('company'));
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
        $company = Company::find($id);
        if($company){
            $updatedCompany = $company->update([
                'name'=> $request->input('name'),
                'description'=>$request->input('description')
            ]);

            if($updatedCompany){
                return redirect()->route('companies.show',[$id])->with('success','update success!');
            }
        }

        return back()->withInput()->with('error','Some errors need to be fixed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company =  Company::find($id);
        if($company){
            $company->projects()->delete();
            Company::destroy($id);
            return redirect()->route('companies.index')->with('success','delete success!');
        }
        return back()->withInput()->with('error','error deleting data');
    }
}
