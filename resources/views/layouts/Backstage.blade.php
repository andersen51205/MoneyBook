@extends('layouts.app')

@section('content')
<div class="container-md">
    <div class="row justify-content-center">
        <div class="col-11 col-md-11 bg-white rounded-4 mt-3 px-3 pb-1">
            @yield('main')
        </div>
    </div>
</div>
@endsection

@section('script')
    @yield('js')
@endsection