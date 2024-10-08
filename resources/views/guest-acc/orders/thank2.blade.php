@extends('guest-acc.layout.content')
@section('title', 'Giỏ hàng')

@section('pg-hd-2', 'Giỏ hàng') @section('act2', 'text-dark')

{{-- @include('guest-acc.layout.header') --}}

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
                <div class="container mt-3  ">
                    <div class="card shadow">
                        <img class="mx-auto" src="{{ asset('Image/Icon/trolley_cart_success_icon_177398.png') }}" alt="" width="150" height="150">
                        <p class="text-center"><strong>Mã đơn hàng của bạn: {{ $madh }} </strong></p>
                        <p class="text-center mt-3" style="font-size: 30px"> Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
                        <p class="text-center my-3">Bạn sẽ được nhận được liên hệ từ nhân viên để xác nhận thông tin và thời gian nhận hàng của bạn! </p>
                        <div class="d-grid gap-2 col-6 mx-auto my-4">
                            <a class="btn btn-primary" href="{{ route('indexWeb') }}" type="button">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- endcontetn --}}

    </div>
    <footer>
        @include('layout.footer')
    </footer>
    
@endsection


    






