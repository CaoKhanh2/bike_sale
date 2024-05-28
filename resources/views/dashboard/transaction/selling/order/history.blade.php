@extends('dashboard.layout.content')

@section('title_ds', 'Quản lý bán xe')
@section('pg-hd-2', 'Quản lý bán xe')


@section('main')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                <div class="card-box mb-30">
                    <div class="pd-10">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header ">
                                    <h4 class="text">Lịch sử đơn hàng
                                        <a href="{{ route('danhsach-donhang-dangbanxe') }}" class="btn btn-warning float-right">Đơn hàng mới</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Mã giỏ hàng</th>
                                                <th>Mã vận chuyển</th>
                                                <th>Tổng giá tiền</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</tkh>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donhang as $item)
                                                <tr>
                                                    <td>{{ $item->madh }}</td>
                                                    <td>{{ $item->magh }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->ngaytaodon)) }}</td>
                                                    <td>{{ $item->mavanchuyen }}</td>
                                                    <td>{{ $item->tongtien }}</td>
                                                    <td>{{ $item->trangthai == 'Đã hoàn thành' ? 'Đã hoàn thành' : 'Đã hủy' }}</td>
                                                    <td>
                                                        <a href="{{ route('xem-ctdonhang', ['id' => $item->madh]) }}" class="btn btn-primary">View</a>
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
            </div>
        </div>
    </div>
@endsection
