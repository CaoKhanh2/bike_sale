@extends('guest-acc.layout.content')
@section('title', 'Giỏ hàng')

@section('pg-hd-2', 'Giỏ hàng') @section('act2', 'text-dark')

@include('guest-acc.layout.header')

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
                        @php $magh = "";@endphp
                        <p class="text-center mt-3" style="font-size: 30px"> Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
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


    






