@extends('layouts.app')

@section('content')
    <div class="row py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Projects <a href="/projects/create" class="float-right text-white">ADD</a></div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif


                            <ul class="list-group">
                                @if(count($projects)==0)
                                <li class="list-group-item">No Projects Registered on this Company</li>
                                @endif
                                @foreach($projects as $project)
                                    @foreach($project->users as $user)
                                        @if($user->pivot->user_id == Auth::user()->id)
                                            <li class="list-group-item"><a href="/projects/{{ $project->id }}">{{ $project->name }}</a>
                                                <small class="ml-3"> {{ $project->description }}</small>
                                                <strong class="float-right">{{ $project->users[0]->name }}</strong>
                                            </li><i class="far fa-trash-alt"></i>

                                            @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
