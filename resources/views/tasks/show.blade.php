@extends('layouts.app')

@section('content')

    <div class="col-md-9 col-sm-9 p-0 float-left">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                <h1 class="display-4">{{ $task->name }}</h1>
                <p class="lead">{{ $task->duration }}</p>
                <p><span class="badge badge-warning">Created By : {{ $task->user->name }}</span></p>

            </div>
        </div>


        <div class="container bg-white mt-5 pt-3">
            <form action="/comments" method="POST">
                @csrf
                <h5 class="mt-3">Comment Section</h5>
                <div class="form-group">
                    <textarea type="email" name="body" class="form-control" id="exampleInputEmail1" rows="3" placeholder="Post a Comment"></textarea>
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="commentable_type" value="App\Task">
                <input type="hidden" name="commentable_id" value="{{ $task->id }}">

                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>

            <div class="comment mt-5">
            @foreach($task->comments as $comment)
                <div class="card mt-1">
                    <div class="card-body">
                        <strong class="badge badge-secondary">{{ Auth::User()->name }} </strong>
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
                    <a href="/projects">
                        All Projects<span class="sr-only"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ URL::previous() }}">
                         All Tasks<span class="sr-only"></span>
                    </a>
                </li>

                <li><hr></li>


                <li class="nav-item">
                    <a href="#" onclick="var result = confirm('Are you sure?');
                        if(result){ event.preventDefault(); document.getElementById('delete-form').submit()}">
                        Delete Task
                    </a>

                    <form action="{{ route('tasks.destroy',[$task->id]) }}" id="delete-form" method="POST" style="display: none">
                        @method('DELETE')
                        @csrf
                    </form>
                </li>
            </ol>
        </div>
    </nav>

@endsection

