@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-9 p-0 float-left">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                <h1 class="display-4">{{ $project->name }}</h1>
                <p class="lead">{{ $project->description }}</p>
                <p><span class="badge badge-primary">Project No: {{ $project->id }}</span></p>
            </div>
        </div>

        <div class="row pl-md-3">
            @if(count($project->tasks)==0)
                <div class="col-md-9 p-4 col-sm-9">
                    <h2> No Tasks Associated with this Project</h2>
                </div>
            @endif
            @foreach($project->tasks as $task)
                @foreach($project->users as $user)
                    @if($task->user_id == $user->id )
                            <div class="col-md-4 p-4 col-sm-12">
                            <small>Created By: {{ $user->name }}</small>
                    @endif
                    @endforeach
                    <h3>{{ $task->name }}</h3>
                    <h7>Task Initiated {{ $task->created_at->diffForHumans() }}</h7>
                    <p> Estimated Completion time : {{ $task->duration }} Hours</p>
                    <p><a class="btn btn-primary" href="/tasks/{{ $task->id }}" role="button">View details &raquo;</a></p>
                </div>
            @endforeach
        </div>

        <div class="container bg-white mt-5 pt-3">
            <form action="/comments" method="POST">
                @csrf
                <h5 class="mt-3">Comment Section</h5>
                <div class="form-group">
                    <textarea type="email" name="body" class="form-control" id="exampleInputEmail1" rows="3" placeholder="Post a Comment"></textarea>
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="commentable_type" value="App\Project">
                <input type="hidden" name="commentable_id" value="{{ $project->id }}">

                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>

            <div class="comment mt-5">
                @foreach($project->comments as $comment)
                    <div class="card mt-1">
                        <div class="card-body">
                            <strong class="badge badge-secondary">{{ $comment->user->name }} </strong>
                             {{ $comment->body }}
                            <small class="float-right">{{ $comment->created_at->diffForHumans() }}</small>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>



    <nav class="col-md-3 col-sm-3 d-md-block bg-light sidebar float-right mt-5">
        <div class="sidebar-sticky">
            <ol class="nav flex-column">
                <li class="nav-item">
                    <p class="nav-link">
                        Actions
                    </p>
                </li>

                <li class="nav-item">
                        Add Members<span class="sr-only"></span>
                </li>
                <li class="nav-item">
                    <form action="/projects/{{ $project->id }}/members" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="email" placeholder="Email" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-secondary" id="button-addon2">
                            </div>
                        </div>
                    </form>
                </li>

                <li>Project Members</li>
                @foreach($project->users as $user)
                    <li class="ml-3"><a href="#">{{ $user->name }}
                @if($loop->index==0)
                        (Owner)
                    @endif
                        </a></li>
                @endforeach

                <li class="nav-item">
                    <a href="/projects">
                        All Projects<span class="sr-only"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" onclick="var result = confirm('Are you sure?');
                        if(result){ event.preventDefault(); document.getElementById('delete-form').submit()}">
                        Delete Project
                    </a>

                    <form action="{{ route('projects.destroy',[$project->id]) }}" id="delete-form" method="POST" style="display: none">
                        @method('DELETE')
                        @csrf
                    </form>
                </li>
                <li><hr></li>
                <li class="nav-item">
                    <a href="/projects/{{$project->id}}/tasks/create">
                        Add Task<span class="sr-only"></span>
                    </a>
                </li>
            </ol>
        </div>
    </nav>

@endsection

