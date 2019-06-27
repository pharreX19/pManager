<?php

namespace App\Http\Controllers;

use App\Company;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project_id = $id;
        return view('tasks.create',compact('project_id'));
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
            'name'=>'required|min:5|max:100',
            'duration'=>'required|numeric'
        ]);

        $project_id = $request->input('project_id');

        $task= Task::create([
            'name'=>$request->input('name'),
            'duration'=>$request->input('duration'),
            'project_id'=>$request->input('project_id'),
            'user_id'=>$request->input('user_id'),
            'company_id'=>$request->input('company_id')
        ]);

        if($task){
            $task->users()->attach(Auth::user()->id);
            return redirect('projects/'.$project_id)->with('success','task created success!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::with('comments','users')->find($id);
        return view('tasks.show',compact('task'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if($task){
            Task::destroy($id);
            return redirect('/projects')->with('success','Task Deleted Sucsess');
        }
        return back()->with('error','Error Deleting Task');
    }
}
