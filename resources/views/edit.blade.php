@extends('layouts.app')

@section('content')

    <div class="col-md-9 col-sm-9 p-0 float-left">
        <div class="container bg-white mt-1 p-4">
            <form method="post" action="{{ route('companies.update',[ $company->id]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="1">

                <h3 class="text-center">Edit Company</h3>
                <div class="form-group">
                    <label for="name">Company Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ $company->description }}</textarea>

                </div>

                <input type="hidden" name="user_id" value="1">

                <button class="btn btn-primary">Update</button>
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
                    <a href="/companies/{{ $company->id }}">
                        View Company <span class="sr-only"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/companies">
                        All Companies
                    </a>
            </ol>
        </div>
    </nav>



@endsection