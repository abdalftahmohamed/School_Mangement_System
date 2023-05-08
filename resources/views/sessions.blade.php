




@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show " role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


@if (session()->has('update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('update') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif



@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


@if (session()->has('graduated'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('graduated') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (!empty($successMessage))
    <div class="alert alert-success" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ $successMessage }}
    </div>
@endif

@if (\Session::has('messageerror'))
    <div class="alert alert-danger">
        <li>{!! \Session::get('message') !!}</li>
    </div>
@endif

@if (Session::has('error_Graduated'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{Session::get('error_Graduated')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{--@if ($catchError)--}}
{{--    <div class="alert alert-danger" id="success-danger">--}}
{{--        <button type="button" class="close" data-dismiss="alert">x</button>--}}
{{--        {{ $catchError }}--}}
{{--    </div>--}}
{{--@endif--}}
