@extends('layout.content')
@section('title', '')

@section('main')
    <div class="container">
        <div class="row justify-content-md-center mt-4 mb-4">
            @include('layout.header_breadcrum')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale_page.image_product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale_page.info_product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale_page.product_description')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale_page.social_share')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale_page.report_group')
        </div>

        <div class="row justify-content-md-center mt-5 mb-5">
            @include('sale_page.related_product')
        </div>
    </div>
    <script src="{{ asset('home_src\js\show-product.js') }}"></script>
@endsection
