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
                <div class="container my-3">
                    <div class="card shadow mx-2">
                        <img class="mx-auto my-3" src="{{ asset('Image/Icon/hourglass.png') }}" alt="" width="150" height="150">
                        <p class="text-center my-2"><strong>Mã đơn hàng của bạn: </strong></p>
                        <h3 class="text-center my-2" style="font-size: 30px"> Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</h3>
                        <p class="text-center my-3">Bạn sẽ được nhận được liên hệ từ nhân viên để xác nhận lại đơn hàng! </p>
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


    






