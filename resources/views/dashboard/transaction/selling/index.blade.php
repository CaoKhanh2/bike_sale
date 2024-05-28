@extends('dashboard.layout.content')

@section('title_ds', 'Quản lý xe đăng bán')
@section('pg-hd-2', 'Quản lý xe đăng bán') @section('act2', 'active')

@section('main')
    @if (Session::has('success-them-xedangban'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-them-xedangban') }}",
            });
        </script>
    @endif
    @if (Session::has('success-xoa-xedangban'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-xoa-xedangban') }}",
            });
        </script>
    @endif
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
                                    aria-selected="true">Xe đăng bán</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#table2" role="tab"
                                    aria-selected="false">Đơn hàng</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="table1" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header ">
                                                <h4 class="text">Danh sách xe đăng bán
                                                    <a href="{{ route('xedangban2-thongtinxe') }}"
                                                        class="btn btn-warning float-right">Đăng bán xe</a>
                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table multiple-select-row table-striped nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã xe đăng bán</th>
                                                            <th>Ngày đăng bán</th>
                                                            <th>Mã xe</th>
                                                            <th>Tên xe</th>
                                                            <th>Giá bán</th>
                                                            <th>Trạng thái</th>
                                                            <th>Hành động</tkh>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($xedangban as $i)
                                                            <tr>
                                                                <td>{{ $i->maxedangban }}</td>
                                                                <td>{{ date('d/m/Y H:m:s', strtotime($i->ngayban)) }}</td>
                                                                <td>{{ $i->maxe }}</td>
                                                                <td>{{ $i->tenxe }}</td>
                                                                <td>{{ number_format($i->giaban, 0, ',', '.') . ' đ' }}</td>
                                                                <td>{{ $i->trangthai }}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <a href="" class="btn btn-primary mx-1"><i
                                                                                class="bi bi-eye"></i>
                                                                            Xem</a>
                                                                        @if (Auth()->user()->phanquyen == 'Quản lý' || Auth()->user()->phanquyen == 'Quản trị viên')
                                                                            <a href="{{ route('xoa-xedangban-thongtinxe', ['id' => $i->maxedangban]) }}"
                                                                                class="btn btn-danger mx-1"><i
                                                                                    class="bi bi-trash"></i>
                                                                                Xóa</a>
                                                                        @endif
                                                                    </div>
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
                            {{-- Đơn hàng --}}
                            <div class="tab-pane fade show" id="table2" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header ">
                                                <h4 class="text">Danh sách đơn hàng
                                                    <a href="{{ route('lichsu-donhang') }}"
                                                        class="btn btn-warning float-right">Lịch sử đơn hàng</a>
                                                </h4>
                                            </div>
                                            <div class="card-body table-responsive">
                                                <table class="table multiple-select-row table-striped nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Ngày đặt hàng</th>
                                                            <th>Mã giỏ hàng</th>
                                                            <th>Mã vận chuyển</th>
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
                                                                <td>{{ $item->magh }}</td>
                                                                <td></td>
                                                                <td>{{ number_format($item->tongtien, 0, ',', '.') . ' đ' }}
                                                                </td>
                                                                <td>{{ $item->trangthai == 'Đang xử lý' ? 'Đang xử lý' : 'Đã hoàn thành' }}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('xem-ctdonhang', ['id' => $item->madh]) }}"
                                                                        class="btn btn-primary">View</a>
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
