@extends('layout.content')
@section('title', 'Trang chủ')

<link rel="stylesheet" href="{{ asset('home_src\css\main.css') }}">
@section('main')

    {{-- Banner 1 --}}
    <div id="banner-1" class="full-width-image" style="background-image: url('{{ asset('Image/Banner/bn-1.jpg') }}');"></div>
    {{-- End --}}

    <div class="container mt-4">
        {{-- Mục Tìm kiếm --}}
            <div class="row justify-content-md-center">
                <div class="col-xl">
                    @include('home-page.search-box')
                </div>               
            </div>
        {{-- End --}}

        {{-- Danh sách xe bán --}}
        <div class="row justify-content-md-center mt-4">
            <div class="col-xl">
                @include('home-page.list-car')
            </div>
        </div>
        {{-- End --}}

        {{-- Banner-2 --}}
        <div class="row justify-content-md-center mt-4" id="banner-2">
            <div class="col-xl">
                {{-- <div class="full-image" style="background-image: url('{{ asset('Image/Banner/63e1d192789c7.jpg') }}');"> --}}
                <img src="{{ asset('Image/Banner/63e1d192789c7.jpg') }}" alt="" class="img-fluid mx-auto d-block">
            </div>
        </div>
        {{-- End --}}
        
        {{-- Thương hiệu xe --}}
        <div class="row justify-content-md-center mt-4 mb-4">
            <div class="col-xl">
                @include('home-page.car-brand')
            </div> 
        </div>
        {{-- End --}}

        {{-- Tin tức --}}
        <div class="row justify-content-md-center mt-4">
            <div class="col-xl">
                @include('home-page.news')
            </div>
        </div>
        {{-- End --}}
        
    </div>

    

@endsection
