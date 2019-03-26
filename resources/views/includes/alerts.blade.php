@if(Session::has('fail'))
    <div class="alert alert-danger text-center m-15"  data-dismiss="alert" aria-label="Close">
        <a class="close hide-me">&times;</a>
        <span>
            {{ Session::get('fail')}}
        </span>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success text-center m-15" data-dismiss="alert" aria-label="Close">
        <a class="close hide-me">&times;</a>
        <span>
             {{ Session::get('success')}}
        </span>
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning text-center m-15" data-dismiss="alert" aria-label="Close">
        <a class="close hide-me">&times;</a>
        <span>
             {{ Session::get('warning')}}
        </span>
    </div>
@endif


@if(count($errors) > 0 )
    <div class="alert alert-danger text-center fail m-15" data-dismiss="alert" aria-label="Close">
        <a class="close hide-me">&times;</a>
        <br>
        <ul class="error-list">
            @foreach($errors->all() as $error)
                <li> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
