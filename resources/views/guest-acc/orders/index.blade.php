@extends('guest-acc.layout.content')

@section('title_ds', 'Quản lý bán xe')
@section('pg-hd-2', 'Quản lý bán xe')

@section('title')
    Đơn hàng của tôi
@endsection
{{-- @include('guest-acc.layout.header') --}}
@section('guest-content')
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Đơn hàng của tôi</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Tổng giá tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donhang as $item)
                                    <tr>
                                        <td>{{ $item->madh }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->ngaytaodon)) }}</td>
                                        <td>{{ number_format($item->tongtien, 0, ',', '.') . ' đ' }}</td>
                                        <td>@if($item->trangthai == 'Đã hủy')
                                            <div class="badge badge-pill bg-warning">
                                                Đã hủy
                                            </div>
                                            @elseif($item->trangthai == 'Đang chờ xử lý')
                                            <div class="badge badge-pill bg-warning">
                                                Đang chờ xử lý
                                            </div>
                                            @else
                                            <div class="badge badge-pill bg-success">
                                                Đã hoàn thành
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('khach-ctdonhang', ['madonhang' => $item->madh]) }}"
                                                class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <a href="/"><button class="btn btn-outline-primary"><i class="bi bi-house"></i> Quay lại trang chủ</button></a>
            </div>
        </div>
    </div>
@endsection
