@extends('dashboard.layout.content')

@section('title_ds', 'Quản lý thông tin thanh toán')
@section('pg-hd-2', 'Quản lý thanh toán đơn hàng') @section('act2', 'active')


@section('main')
    @if (Session::has('success-thanhtoan-hoadon'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-thanhtoan-hoadon') }}",
            });
        </script>
    @endif
    @if (Session::has('success-huy-donhang'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-huy-donhang') }}",
            });
        </script>
    @endif 
    @if (Session::has('success-huy-hoadon'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-huy-hoadon') }}",
            });
        </script>
    @endif
    {{-- @php
        Session::forget('check');
    @endphp --}}
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
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="tab" href="#table1" role="tab"
                                    aria-selected="true">Chưa Thanh toán</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#table2" role="tab"
                                    aria-selected="false">Đã Thanh toán</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#table3" role="tab"
                                    aria-selected="false">Bị hủy</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            {{-- Đơn hàng đang chờ xử lý --}}
                            <div class="tab-pane fade show active" id="table1" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header ">
                                                <h4 class="text"> Quản lý thanh toán
                                                    <a href="{{ route('thuchien-lap-hoadon') }}"
                                                        class="btn btn-warning float-right">Lập hóa đơn</a>
                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table multiple-select-row table-striped nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Tên khách hàng</th>
                                                            <th>Ngày tạo đơn</th>
                                                            <th>Tổng giá trị</th>
                                                            <th>Trạng thái</th>
                                                            <th>Hành động</tkh>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($donhang_chuathanhtoan as $i)
                                                            <tr>
                                                                <td>{{ $i->madh }}</td>
                                                                <td>{{ $i->hovaten }}</td>
                                                                <td>{{ date('d/m/y H:m:i', strtotime($i->ngaytaodon)) }}
                                                                </td>
                                                                <td>{{ number_format($i->tongtien, 0, '.', ',') . ' đ' }}</td>
                                                                <td>{{ $i->trangthai }}</td>
                                                                <td>
                                                                    <a href="{{ route('chitiet-thongtin-thanhtoan1', ['madonhang' => $i->madh, 'mand' => $i->mand]) }}"
                                                                        class="btn btn-primary mx-1"><i
                                                                            class="bi bi-eye"></i>
                                                                        Xem</a>
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
                            {{-- Đơn hàng đã hoàn thành --}}
                            <div class="tab-pane fade show" id="table2" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header ">
                                                <h4 class="text">Quản lý thanh toán

                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table multiple-select-row table-striped nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Mã hóa đơn</th>
                                                            <th>Tên khách hàng</th>
                                                            <th>Ngày tạo đơn</th>
                                                            <th>Tổng giá trị</th>
                                                            <th>Trạng thái</th>
                                                            <th>Hành động</tkh>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($donhang_dathanhtoan as $i)
                                                            <tr>
                                                                <td>{{ $i->madh }}</td>
                                                                <td>{{ $i->mahoadon }}</td>
                                                                <td>{{ $i->hovaten }}</td>
                                                                <td>{{ date('d/m/y H:m:i', strtotime($i->ngaytaodon)) }}
                                                                </td>
                                                                <td>{{ number_format($i->tongtien, 0, '.', ',') . ' đ' }}
                                                                </td>
                                                                <td>{{ $i->trangthai }}</td>
                                                                <td>
                                                                    <a href="{{ route('chitiet-thongtin-thanhtoan1', ['madonhang' => $i->madh, 'mand' => $i->mand]) }}"
                                                                        class="btn btn-primary mx-1"><i
                                                                            class="bi bi-eye"></i>
                                                                        Xem</a>
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
                            {{-- Đơn hàng đã hủy --}}
                            <div class="tab-pane fade show" id="table3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header ">
                                                <h4 class="text">Quản lý thanh toán

                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table multiple-select-row table-striped nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Tên khách hàng</th>
                                                            <th>Ngày tạo đơn</th>
                                                            <th>Tổng giá trị</th>
                                                            <th>Trạng thái</th>
                                                            <th>Hành động</tkh>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($donhang_dahuy as $i)
                                                            <tr>
                                                                <td>{{ $i->madh }}</td>
                                                                <td>{{ $i->hovaten }}</td>
                                                                <td>{{ date('d/m/y H:m:i', strtotime($i->ngaytaodon)) }}
                                                                </td>
                                                                <td>{{ number_format($i->tongtien, 0, '.', ',') . ' đ' }}
                                                                </td>
                                                                <td>{{ $i->trangthai }}</td>
                                                                <td>
                                                                    <a href="{{ route('chitiet-thongtin-thanhtoan1', ['madonhang' => $i->madh, 'mand' => $i->mand]) }}"
                                                                        class="btn btn-primary mx-1"><i
                                                                            class="bi bi-eye"></i>
                                                                        Xem</a>
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
            </div>
        </div>
    </div>
@endsection
