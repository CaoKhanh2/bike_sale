@extends('layout.content')
@section('title', 'Đăng ký bán xe')
@section('pg-hd-2', 'Đăng ký bán xe')
<link rel="stylesheet" href="{{ asset('home_src\css\main.css') }}">

@section('main')

    {{-- breadcrum --}}
    <div class="container mb-5">
        {{-- <div class="row justify-content-around">
            <div class="col-xl">
                @include('layout.header_breadcrum')
            </div>
        </div> --}}
        {{-- endbreadcrum --}}

        {{-- Content --}}
        <div class="row justify-content-center">
            <div class="col-xl">
                @include('user.posting_item')
            </div>
        </div>

    </div>
    {{-- End Content --}}
    <script src="{{ asset('dashboard_src/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('dashboard_src/vendors/scripts/layout-settings.js') }}"></script>
@endsection
