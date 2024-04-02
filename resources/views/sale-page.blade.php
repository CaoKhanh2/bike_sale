@extends('layout.content')
@section('title','')

@section('main')
    <div class="container">
        <div class="row justify-content-md-center mt-4 mb-4">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Library</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
              </nav>
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
            @include('sale-page.image-product')
        </div>

        <div class="row justify-content-md-center mt-4 mb-4">
          
        </div>
    </div>
    <script src="{{ asset('home_src\js\show-product.js') }}"></script>
@endsection