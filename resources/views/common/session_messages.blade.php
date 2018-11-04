@if(session('success'))
    <div class="row">
        <div class="alert alert-success" role="alert">
            <p>{{session('success')}}</p>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="row">
        <div class="alert alert-danger" role="alert">
            <p>{{session('error')}}</p>
        </div>
    </div>
@endif
