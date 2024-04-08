@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin dòng xe')
@section('pg-card-title', 'Thông tin dòng xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4','true')
@section('pg-hd-4', 'Thông tin dòng xe') @section('act4','active')

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
                                    <div class="pd-20">
                                        <table class="table hover data-table-export">
                                            <thead>
                                                <tr>
                                                    <th>Mã dòng xe</th>
                                                    <th>Tên dòng xe</th>
                                                    <th>Mô tả</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dongxe as $i)
                                                    <tr>
                                                        <td>{{ $i->madx }}</td>
                                                        <td>{{ $i->tendongxe }}</td>
                                                        <td>{{ $i->mota }}</td>
                                                        <td>
                                                            <a type="button" class="btn btn-primary"
                                                                href="{{ url('/dashboard/category/vehicle/detail_type_vehicle_infor') }}">
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
                                                <label class="col-sm-12 col-md-2 col-form-label">Mã dòng xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Tên dòng xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Mô tả</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <textarea class="form-control" rows="3"></textarea>
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
