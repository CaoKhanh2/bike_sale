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
                    <form action="{{ route('dathang-Guest') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>Thông tin người mua</h6>
                                        <hr>
                                        <div class="row checkout-form">
                                            <div class="col-md-6">
                                                <label for="">Họ và tên</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->hovaten }}" name="hovaten"
                                                    placeholder="Nhập họ tên">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Giới tính</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->gioitinh }}" name="gioitinh"
                                                    placeholder="Nhập giới tính">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->email }}" name="email"
                                                    placeholder="Nhập Email">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="">Số điện thoại</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->sodienthoai }}" name="sdt"
                                                    placeholder="Nhập số điện thoại">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="">Địa chỉ</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::guard('guest')->user()->diachi }}" name="diachi"
                                                    placeholder="Nhập địa chỉ">
                                            </div>
            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>Chi tiết đơn hàng</h6>
                                        <hr>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <th>Tên xe</th>
                                                <th>Giá</th>
                                                <th>Tình trạng</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($giohang_items as $item)
                                                    <tr>
                                                        <td>{{ $item->tenxe }}</td>
                                                        <td>{{ number_format($item->giaban, 0, ',', '.') . ' đ' }}</td>
                                                        <td>{{ $item->trangthai }}</td>
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
                                        <button type="submit" name="cod" class="btn btn-info w-100 mb-3">Đặt hàng</button>
                                        <button type="submit" name="payUrl" class="btn btn-danger w-100 mb-3">Momo</button>
                                        <button type="submit" name="redirect" class="btn btn-primary w-100">Vnpay</button>
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

