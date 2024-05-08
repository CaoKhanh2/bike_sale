@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin vận chuyển')
@section('pg-card-title', 'Thông tin vận chuyển')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin vận chuyển') @section('act3', 'active')
@section('st4', 'false')

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
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#table" role="tab"
                                        aria-selected="true">Thông tin bảng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#form-add" role="tab"
                                        aria-selected="false">Thêm dữ liệu</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="table" role="tabpanel">
                                    <div class="pt-20">
                                        <table class="table hover multiple-select-row data-table-export nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="table-plus datatable-nosort">Mã vận chuyển</th>
                                                    <th>Khách hàng</th>
                                                    <th>Trạng thái vận chuyển</th>
                                                    <th>Ngày gửi</th>
                                                    <th>Ngày nhận</th>
                                                    <th>Địa chỉ giao hàng</th>
                                                    <th>Ghi chú</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vanchuyen as $i)
                                                    <tr>
                                                        <td class="table-plus">{{ $i->mavanchuyen }}</td>
                                                        <td>{{ $i->hovaten }}</td>
                                                        <td>{{ $i->trangthaivanchuyen }}</td>
                                                        <td>
                                                            @php
                                                                $formattedDate = date('d/m/Y', strtotime($i->ngaygui));
                                                                echo $formattedDate;
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            @php
                                                                $formattedDate = date('d/m/Y', strtotime($i->ngaynhan));
                                                                echo $formattedDate;
                                                            @endphp
                                                        </td>
                                                        <td>{{ $i->diachigiaohang }}</td>
                                                        <td>{{ $i->ghichu }}</td>
                                                        <td>
                                                            {{-- <a href="{{ url('/car_catalog/detail_inforcar') }}" type="button"
                                                        class="btn btn-primary">Sửa</a>
                                                    <a href="" type="button" class="btn btn-primary">Xóa</a> --}}

                                                            <a type="button" class="btn btn-primary"
                                                                href="{{ url('/dashboard/shipping/') }}">
                                                                <i class="bi bi-pencil-fill"></i> Sửa
                                                            </a>
                                                            <a type="button" class="btn btn-danger" href="">
                                                                <i class="bi bi-trash3"></i> Xóa
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-add" role="tabpanel">
                                    <div class="pd-20">
                                        <form action="" class="form mt-2">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Mã hãng xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Tên hãng xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Ảnh logo</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <div class="custom-file ">
                                                        <input type="file" class="custom-file-input" />
                                                        <label class="custom-file-label">Chọn ảnh</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Xuất xứ</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
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
