@extends('layouts.app')

@section('content')

    <div class="col-md-9 col-sm-9 p-0 float-left">
        <div class="container bg-white mt-1 p-4">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="project_id" value="{{ $project_id }}">



                <h3 class="text-center">Create Task</h3>
                <div class="form-group">
                    <label for="name">Task Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Company Name">
                </div>

                <div class="form-group">
                    <label for="duration">Project Duration (Hours)</label>
                    <input type="number" class="form-control" name="duration" id="duration" value="1" min="1">
                </div>


                <button class="btn btn-primary">Create</button>
            </form>
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
                    <a href="/companies">
                        All Companies
                    </a>
            </ol>
        </div>
    </nav>



@endsection