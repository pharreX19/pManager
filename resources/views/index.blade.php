@extends('layouts.app')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Companies <a href="/companies/create" class="float-right text-white">ADD</a></div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <ul class="list-group list-group-flush">
                                @if(count($companies)==0)
                                    <li class="list-group-item"> No Companies Registered On your Name</li>
                                @endif
                                @foreach($companies as $company)

                                    <li class="list-group-item"><a href="companies/{{ $company->id }}">{{ $company->name }}</a>
                                        <small>{{ $company->description }}</small>
                                        <i class="far fa-trash-alt float-right">remove</i></li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
