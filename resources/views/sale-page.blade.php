@extends('layout.content')
@section('title', 'Thông tin xe')

@section('pg-hd-2', 'Xe máy')

@foreach ($ct_thongtin_xemay as $i)
    @section('pg-hd-3', $i->tenxe) @section('act3', 'true') @section('act3', 'text-dark') @section('st3','true') 
@endforeach

@foreach ($ct_thongtin_xedapdien as $i)
    @section('pg-hd-3', $i->tenxe) @section('act3', 'true') @section('act3', 'text-dark') @section('st3','true') 
@endforeach

@section('main')
    <div class="container">
        <div class="row justify-content-md-center mt-4 mb-4">
            @include('layout.header-breadcrum')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.image-product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.info-product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.product-description')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.social-share')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.report-group')
        </div>

        <div class="row justify-content-md-center mt-5 mb-5">
            @include('sub-page.sale-page.related-product')
        </div> 
    </div>
    <script src="{{ asset('home_src\js\show-product.js') }}"></script>
@endsection
