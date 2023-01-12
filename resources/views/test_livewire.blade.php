@extends('layouts.master')
@section('css')
    @livewireStyles
@stop
@section('title')
    empty
@stop
{{--@endsection--}}
@section('page-header')
<!-- breadcrumb -->
@stop
@section('PageTitle')
    empty
@stop
<!-- breadcrumb -->
{{--@endsection--}}
@section('content')
<!-- row -->



<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
{{--                <livewire:show-posts></livewire:show-posts>--}}
                <p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></p>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @livewireScripts
@endsection
