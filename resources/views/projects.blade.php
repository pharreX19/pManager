@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card bg-light mb-12">
                <div class="card-header">Header</div>
                <div class="card-body">
                    <h5 class="card-title">Light card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-white mb-12">
                <div class="card-body">
                    <h5 class="card-title">Actions</h5>
                    <ul class="list-group">
                        <li class="list-item">Add Projects</li>
                        <li class="list-item">Add Projects</li>
                        <li class="list-item">Add Projects</li>
                    </ul>
                    <p class="card-text">Add Projects</p>
                    <p class="card-text">Delete Projects</p>
                    <p class="card-text">Add Members</p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection