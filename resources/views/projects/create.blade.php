@extends('layouts.app')

@section('content')

    <div class="col-md-9 col-sm-9 p-0 float-left">
        <div class="container bg-white mt-1 p-4">
            <form method="POST" action="{{ route('projects.store') }}">
                @csrf

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">



                <h3 class="text-center">Create Project</h3>
                <div class="form-group">
                    <label for="name">Project Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Company Name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Company Description"></textarea>

                </div>
                <div class="form-group">
                    <label for="name">Project Duration (Days)</label>
                    <input type="number" class="form-control" name="days" id="days" value="1">
                </div>

                <div class="form-group">
                    <label for="name">Project Duration (Hours)</label>
                    <input type="number" class="form-control" name="hours" id="hours" value="0">
                </div>

                <div class="form-group">
                    <label for="company_id">Select Company</label>
                    <select class="form-control" id="company_id" name="company_id">
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
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