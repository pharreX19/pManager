<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;
use App\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;

        $projects = Project::with('users')->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all()->where('user_id',Auth::user()->id);

        return view('projects.create',compact('companies'));

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
            'description'=>'required|string|min:10|max:100',
            'days'=>'required|numeric',
            'hours'=>'required|numeric',
            'company_id'=>'required'

        ]);

        $project = Project::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'days'=>$request->input('days'),
            'hours'=>$request->input('hours'),
            'user_id'=>$request->input('user_id'),
            'company_id'=>$request->get('company_id')

        ]);

        if($project){
            $project->users()->attach(Auth::user()->id);
            return redirect('/projects')->with('success','Company created success');
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
        $project = Project::with('tasks','comments','users')->find($id);
        return view('projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'project edit';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if($project){
            $project->tasks()->delete();
            Project::destroy($id);
            return redirect()->route('projects.index')->with('success','Project deleted success!');
        }

        return back()->with('error','Error deleting project');
    }


    public function members($id, Request $request){
        $user = User::all()->where('email',$request->input('email'))->first();
        if($user){
            $user->projects()->sync($id);
            return redirect('/projects');
        }

        return back()->with('error','Error Adding member to the project');


    }
}
