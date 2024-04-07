@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe')
@section('pg-card-title', 'Thông tin xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin xe') @section('act3','active')
@section('st4','false')

@section('main')
    
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                    @include('dashboard.layout.page-header')
                {{-- End Page Header--}}

                <!-- Export Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover data-table-export">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Loại xe</th>
                                    <th>Hãng xe</th>
                                    <th>Danh mục</th>
                                    <th>Tên xe</th>
                                    <th>Giá bán</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Gloria F. Mead</td>
                                    <td>25</td>
                                    <td>Sagittarius</td>
                                    <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                    <td>29-03-2018</td>
                                    <td>$162,700</td>
                                    <td>
                                        <a type="button" class="btn btn-primary" href="{{ url('/dashboard/category/vehicle/detail_vehicle_infor') }}">
                                            <i class="bi bi-pencil-fill"></i> Sửa
                                        </a>
                                        <a type="button" class="btn btn-danger" href="">
                                            <i class="bi bi-trash3"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Export Datatable End -->
            </div>

        </div>
    </div>
    
@endsection
