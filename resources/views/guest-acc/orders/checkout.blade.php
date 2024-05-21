@extends('guest-acc.layout.content')

@section('title')
    Checkout
@endsection

@php
    $url = url()->current();
    $arr = explode('/', $url);
    $res = end($arr);
@endphp

@section('guest-content')
    <div class="container mt-3">
        <form action="{{ route('dathang-Guest') }}" method="GET">
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
                                    <input type="text" class="form-control" value="{{ Auth::guard('guest')->user()->hovaten }}" name="hovaten" placeholder="Nhập họ tên">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Giới tính</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('guest')->user()->gioitinh }}" name="gioitinh" placeholder="Nhập giới tính">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('guest')->user()->email }}" name="email" placeholder="Nhập Email">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('guest')->user()->sodienthoai }}" name="sdt" placeholder="Nhập số điện thoại">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Địa chỉ</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('guest')->user()->diachi }}" name="diachi"  placeholder="Nhập địa chỉ">
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
                            <input type="text" value="{{ $res }}" name="magh" hidden>
                            <button type="submit" class="btn btn-primary w-100">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
