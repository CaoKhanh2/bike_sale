@extends('guest-acc.layout.content')

@section('title', 'Giỏ hàng')
@section('pg-hd-2', 'Giỏ hàng') @section('act2', 'text-dark')

@section('guest-content')

    <div class="container my-5">
        
        {{-- breadcrum --}}
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
    <footer>
        @include('layout.footer')
    </footer>
    
@endsection


    




