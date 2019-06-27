@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-9 p-0 float-left">
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                <h1 class="display-4">{{ $company->name }}</h1>
                <p class="lead">{{ $company->description }}</p>
            </div>
        </div>

        <div class="row pl-md-3">
            @if(count($company->projects)==0)
                <div class="col-md-9 p-4 col-sm-9">
                    <h2> No Projects Recently Started</h2>
                </div>
            @endif
            @foreach($company->projects as $project)
                <div class="col-md-4 p-4 col-sm-12">
                    <h2>{{ $project->name }}</h2>
                    <p> {{ $project->description }} </p>
                    <p><a class="btn btn-primary" href="/projects/{{ $project->id }}" role="button">View details &raquo;</a></p>
                </div>
            @endforeach
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
                        My Companies<span class="sr-only"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/companies/create">
                        Add Company<span class="sr-only"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href=" {{ $company->id }}/edit">
                        Edit Company<span class="sr-only"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" onclick="var result = confirm('Are you sure?');
                        if(result){ event.preventDefault(); document.getElementById('delete-form').submit()}">
                        Delete
                    </a>

                    <form action="{{ route('companies.destroy',[$company->id]) }}" id="delete-form" method="POST" style="display: none">
                        @method('DELETE')
                        @csrf
                    </form>
                </li>

                <li class="nav-item">
                    <hr></li>

                <li class="nav-item">
                    <a href="/projects/create">
                        Add Project <span class="sr-only"></span>
                    </a>
                </li>

            </ol>
        </div>
    </nav>

@endsection

