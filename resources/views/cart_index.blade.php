@extends('layout.content')
@section('title', 'Giỏ hàng')
@section('pg-hd-2', 'Giỏ hàng')
@section('main')
  {{-- breadcrum --}}
  <div class="container">
    <div class="row justify-content-around">
        <div class="col-xl">
            @include('layout.header_breadcrum')
        </div>
    </div>
</div>
{{-- endbreadcrum --}}
{{--content--}}
<div class="row justify-content-center">
    <div class="col-xl">
        @include('cart.cart_content')
    </div>
</div>
{{--endcontetn--}}

@endsection