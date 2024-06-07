@extends('dashboard.layout.content')

@php
    $maphieuxuat = request()->query('maphieuxuat');
@endphp

@section('title_ds', 'Kho hàng')
@section('pg-card-title', 'Quản lý kho hàng')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Kho hàng')
@section('pg-hd-4', 'Chi tiết phiếu xuất') @section('st4', 'true')
@section('pg-hd-5', $maphieuxuat) @section('act5', 'active') @section('st5', 'true')


@section('main')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-blue h4">Phiếu nhập kho</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-warning">Quay lại</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive pb-20">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">STT</th>
                                    <th rowspan="2" class="align-middle">Mã chi tiết phiếu xuất</th>
                                    <th colspan="5">Thông tin phiếu xuất</th>
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
                                @foreach ($thongtinphieuxuat as $i)
                                    @php
                                        $item = $i->soluong * $i->dongia;
                                        $tongtien += $item;
                                    @endphp
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $i->machitietphieuxuat }}</td>
                                        <td>{{ $i->maxe }}</td>
                                        <td>{{ $i->tenxe }}</td>
                                        <td>
                                            @if ($i->trangthai == "Đang xử lý")
                                                <form action="{{ route('capnhatchitietphieuxuat') }}" method="POST"
                                                id="form-{{ $i->machitietphieuxuat }}">
                                                @csrf
                                                <input type="text" value="{{ $i->machitietphieuxuat }}"
                                                    name="mactphieuxuat" hidden>
                                                <input type="number" name="soluong" class="form-control text-center"
                                                    value="{{ $i->soluong }}" id="soluong-{{ $i->machitietphieuxuat }}"
                                                    onblur="autoSubmit('form-{{ $i->machitietphieuxuat }}')" min=1>
                                                </form>
                                            @elseif($i->trangthai == "Đã xuất kho")
                                                {{ $i->soluong }}
                                            @endif
                                            @if ($errors->has('soluong'))
                                                <small class="help-block">
                                                    <p class="text-danger">
                                                        {{ $errors->first('soluong-' . $i->machitietphieuxuat) }}</p>
                                                </small>
                                            @endif
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

                                @foreach ($thongtinphieuxuat as $i)
                                    @if ($i->trangthai == 'Đang xử lý' && $loop->first)
                                        {{-- <a href="{{ route('thuchien-xuathang') }}" class="btn btn-success"><i
                                                class="fa-solid fa-file-export fs-3"></i> Xuất kho</a> --}}
                                        <form action="{{ route('thuchien-xuatkho') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="maphieuxuat" id="data1" value="{{ $i->maphieuxuat }}">
                                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-file-export fs-3"></i>
                                                Xuất kho</button>
                                        </form>
                                    @elseif($i->trangthai == 'Đã xuất kho' && $loop->first)
                                        <form action="{{ route('xuatfile-pdf-phieuxuatkho') }}" method="POST">
                                            <input type="text" name="maphieuxuat" value="{{ $i->maphieuxuat }}" hidden>
                                            @csrf
                                            <button class="btn btn-secondary" type="submit">Xuất file pdf</button>
                                        </form>
                                    @endif
                                @endforeach
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
