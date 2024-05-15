@extends('layout.content')
@section('title', 'Giỏ hàng')
@section('pg-hd-2', 'Giỏ hàng')
@section('main')
    {{-- breadcrum --}}
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-xl">
                @include('layout.header-breadcrum')
            </div>
        </div>

        {{-- endbreadcrum --}}
        {{-- content --}}
        <div class="row justify-content-center">
            <div class="col-xl">
                @include('guest-acc.cart.cart-content')
            </div>
        </div>
        {{-- endcontetn --}}
    </div>
@endsection
