@extends('guest-acc.layout.content')

@section('title_ds', 'Quản lý bán xe')
@section('pg-hd-2', 'Quản lý bán xe')

@section('title')
    Đơn hàng của tôi
@endsection 
{{-- @include('guest-acc.layout.header') --}}
@section('guest-content')
    <div class="container py-5">
        <div class="row">
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
                                    <td>{{ $item->madh}}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->ngaytaodon)) }}</td>
                                    <td>{{ number_format($item->tongtien, 0, ',', '.') . ' đ' }}</td>
                                    <td>{{ $item->trangthai == 'Đã hủy' ? 'Đã hủy' : 'Đã hoàn thành' }}</td>
                                    <td>
                                        <a href="{{ route('khach-ctdonhang', ['madonhang' => $item->madh]) }}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>   
                            @endforeach
                            </tbody>
                        </table>     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 
