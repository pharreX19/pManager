@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Projects <a href=""><i class="float-right text-white">ADD</i></a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="projects/1">Project One</a></li><i class="far fa-trash-alt"></i>
                            <li class="list-group-item"><a href="projects/2">Project One</a></li></li>
                            <li class="list-group-item"><a href="projects/3">Project One</a></li></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
