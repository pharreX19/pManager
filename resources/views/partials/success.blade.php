@if(session()->has('success'))
    <div class="alert alert-dismissable alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {!! session()->get('success') !!}
        </strong>
    </div>
@endif