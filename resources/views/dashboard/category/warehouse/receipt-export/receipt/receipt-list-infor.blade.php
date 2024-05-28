@extends('dashboard.layout.content')

@php
    $maphieunhap = request()->query('maphieunhap');
@endphp

@section('title_ds', 'Kho hàng')
@section('pg-card-title', 'Quản lý kho hàng')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Kho hàng')
@section('pg-hd-4', 'Chi tiết phiếu nhập') @section('st4', 'true')
@section('pg-hd-5', $maphieunhap) @section('act5', 'active') @section('st5', 'true')


@section('main')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="table-responsive pb-20">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">STT</th>
                                    <th rowspan="2" class="align-middle">Mã chi tiết phiếu nhập</th>
                                    <th colspan="5">Thông tin phiếu nhập</th>
                                    <th colspan="2">Thông tin kho</th>
                                    <th rowspan="2" class="align-middle">Trạng thái</th>
                                </tr>
                                <tr>
                                    <th>Mã xe</th>
                                    <th>Tên xe</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>

                                    <th>Tên kho</th>
                                    <th>Ngày nhập</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                    $tongtien = 0;
                                @endphp
                                @foreach ($thongtinphieunhap as $i)
                                    @php
                                        $item = $i->soluong * $i->dongia;
                                        $tongtien += $item;
                                    @endphp
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $i->machitietphieunhap }}</td>
                                        <td>{{ $i->maxe }}</td>
                                        <td>{{ $i->tenxe }}</td>
                                        <td>
                                            {{ $i->soluong }}
                                        </td>
                                        <td>{{ number_format($i->dongia, 0, ',', '.') }}</td>
                                        <td>
                                            {{ number_format($i->soluong * $i->dongia, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $i->tenkhohang }}</td>
                                        <td>{{ date('d/m/Y', strtotime($i->ngaynhapkho)) }}</td>
                                        <td>{{ $i->trangthai }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6"><strong>Tổng tiền</strong></td>
                                    <td colspan="1"><strong>{{ number_format($tongtien, 0, ',', '.') }}</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <form action="{{ route('xuatfile-pdf-phieunhapkho') }}" method="post">
                                    @csrf
                                    <input type="text" name="maphieunhap" value="{{ $maphieunhap }}" hidden>
                                    <button class="btn btn-secondary" type="submit"><i
                                            class="fa-solid fa-file-export fs-3"></i>
                                        Xuất file pdf</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function autoSubmit(formId) {
            document.getElementById(formId).submit();
        }
    </script>

@endsection
