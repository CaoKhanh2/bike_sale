@extends('dashboard.layout.content')

@section('title_ds', 'Quản lý khuyến mãi')
@section('pg-hd-2', 'Quản lý khuyến mãi')

@section('main')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}

                <!-- Export Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pb-20">
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link  text-blue" data-toggle="tab" href="#table1" role="tab"
                                        aria-selected="false">Khuyến mãi đang áp dụng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#table2" role="tab"
                                        aria-selected="false">Quản lý khuyến mãi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#form-add" role="tab"
                                        aria-selected="true">Thêm khuyến mãi</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade" id="table1" role="tabpanel">
                                    <div class="pt-20">
                                        <table class="table hover align-middle">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Mã khuyến mãi</th>
                                                    <th>Tên khuyến mãi</th>
                                                    <th>Tỉ lệ giảm giá</th>
                                                    <th>Ngày bắt đầu</th>
                                                    <th>Ngày kết thúc</th>
                                                    <th>Thời gian còn lại</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($km_active as $i)
                                                    <tr>
                                                        <td class="table-plus">{{ $i->makhuyenmai }}</td>
                                                        <td>{{ $i->tenkhuyenmai }}</td>
                                                        <td>{{ $i->tilegiamgia . '%' }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($i->thoigianbatdau)) }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($i->thoigianketthuc))}}
                                                        @if ($i->thoigianconlai === 'Hết hạn')   
                                                        <td><div class="badge badge-pill badge-danger">{{$i->thoigianconlai}}</div></td>
                                                        <td><a type="button" class="btn btn-danger"
                                                            href="{{ route('xoakhuyemai', ['id' => $i->makhuyenmai]) }}">
                                                            <i class="bi bi-trash"></i> Xóa
                                                        </a></td>
                                                        @else                   
                                                        <td>{{ 'Còn lại ' .$i->thoigianconlai  . ' Ngày'  }}</td>
                                                        <td></td>
                                                        @endif
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="table2" role="tabpanel">
                                    <div class="pt-20">
                                        <table class="table hover align-middle">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Mã khuyến mãi</th>
                                                    <th>Tên khuyến mãi</th>
                                                    <th>Tỉ lệ giảm giá</th>
                                                    <th>Ngày bắt đầu</th>
                                                    <th>Ngày kết thúc</th>
                                                    <th>Hiệu lực</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach ($km as $i)
                                                    <tr>
                                                        <td class="table-plus">{{ $i->makhuyenmai }}</td>
                                                        <td>{{ $i->tenkhuyenmai }}</td>
                                                        <td>{{ $i->tilegiamgia . '%' }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($i->thoigianbatdau)) }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($i->thoigianketthuc)) }}</td>
                                                        <td>
                                                           <div class="badge badge-pill badge-danger"> {{ $i->hieuluc}} </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="form-add" role="tabpanel">
                                    <div class="pd-20">
                                        @include('dashboard.category.saling-events.import-saling-events')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Export Datatable End -->
            </div>
        </div>
    </div>
@endsection
