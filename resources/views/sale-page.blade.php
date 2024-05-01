@extends('layout.content')
@section('title', '')

@section('main')
    <div class="container">
        <div class="row justify-content-md-center mt-4 mb-4">
            @include('layout.header_breadcrum')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale-page.image-product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale-page.info-product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale-page.product-description')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale-page.social-share')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale-page.report-group')
        </div>

        <div class="row justify-content-md-center mt-5 mb-5">
            @include('sale-page.related-product')
        </div>
    </div>
    <script src="{{ asset('home_src\js\show-product.js') }}"></script>
@endsection
