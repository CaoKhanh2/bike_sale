@extends('layout.content')
@section('title', 'Thông tin xe')

@section('pg-hd-2', 'Xe máy')
@section('pg-hd-3', 'fassdf') @section('act3', 'true') @section('act3', 'text-dark')

@section('main')
    <div class="container">
        <div class="row justify-content-md-center mt-4 mb-4">
            @include('layout.header-breadcrum')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.image_product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.info_product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.product_description')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.social_share')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sub-page.sale-page.report_group')
        </div>

        <div class="row justify-content-md-center mt-5 mb-5">
            @include('sub-page.sale-page.related_product')
        </div>
    </div>
    <script src="{{ asset('home_src\js\show-product.js') }}"></script>
@endsection
