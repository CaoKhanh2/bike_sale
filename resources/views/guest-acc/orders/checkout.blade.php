@extends('guest-acc.layout.content')

@php
    $url = url()->current();
    $arr = explode('/', $url);
    $res = end($arr);
@endphp

@section('title', 'Giỏ hàng')

@section('pg-hd-2', 'Thủ tục thanh toán') @section('act2', 'text-dark')

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
                <div class="container mt-3">
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>Thông tin người mua</h6>
                                        <hr>
                                        <div class="row checkout-form">
                                            <div class="col-md-6">
                                                <label for="hovaten">Họ và tên</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->hovaten }}" name="hovaten"
                                                    id="hovaten" placeholder="Nhập họ tên" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="gioitinh">Giới tính</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->gioitinh }}" name="gioitinh"
                                                    id="gioitinh" placeholder="Nhập giới tính">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->email }}" name="email"
                                                    id="email" placeholder="Nhập Email">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="sdt">Số điện thoại</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->sodienthoai }}" name="sdt"
                                                    id="sdt" placeholder="Nhập số điện thoại" required>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label for="diachi">Địa chỉ</label>
                                                <textarea class="form-control" name="diachi" id="diachi" cols="30" rows="4" required>{{ Auth::guard('guest')->user()->diachi }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>Chi tiết đơn hàng</h6>
                                        <hr>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-middle">Tên xe</th>
                                                    <th class="text-center align-middle">Giá gốc</th>
                                                    <th class="text-center align-middle">Khuyến mãi</th>
                                                    <th class="text-center align-middle">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($giohang_items as $item)
                                                    <tr>
                                                        <td>{{ $item->tenxe }}</td>
                                                        <td class="text-end">
                                                            {{number_format($item->giagoc, 0, ',', '.') . ' VND' }}
                                                        </td>
                                                        <td class="text-center">{{ number_format($item->tilegiamgia, 0, ',', '.').' %'}}</td>
                                                        <td class="text-end">
                                                            {{ number_format($item->giaban, 0, ',', '.') . ' VND' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <hr>
                                        @foreach ($giohang_items as $item)
                                            @if ($loop->first)
                                                <h4 class="px-2">Tổng tiền: <span
                                                        class="float-end">{{ number_format($item->tonggiatien, 0, ',', '.') . ' đ' }}</span>
                                                </h4>
                                            @endif
                                        @endforeach
                                        <input type="text" value="{{ $res }}" name="magh" hidden>
                                        <button type="submit" formaction="{{ route('dathang-Guest') }}" formmethod="POST" class="btn btn-info w-100 mb-3">Đặt
                                            hàng</button>
                                        {{-- <button type="submit" name="payUrl" class="btn btn-danger w-100 mb-3">Momo</button> --}}
                                        <button type="submit" formaction="{{ route('dathang-vnpay-Guest') }}" formmethod="POST"
                                            class="btn btn-primary w-100 d-flex justify-content-center align-items-center p-2">
                                            <img src="{{ asset('/Image/Icon/icon-vnpay.svg') }}" alt="VNPay Icon"
                                                class="btn-icon" width="80" height="40">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- endcontetn --}}

    </div>
    <footer>
        @include('layout.footer')
    </footer>

@endsection
