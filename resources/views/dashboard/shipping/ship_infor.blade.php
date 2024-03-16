@extends('dashboard.layout.content')
@section('title_ds','Danh mục vận chuyển')
@section('pg-hd-2','Danh mục vận chuyển')

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
                    <table class="table hover multiple-select-row data-table-export nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Name</th>
                                <th>Age</th>
                                <th>Office</th>
                                <th>Address</th>
                                <th>Start Date</th>
                                <th>Salart</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-plus">Gloria F. Mead</td>
                                <td>25</td>
                                <td>Sagittarius</td>
                                <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                <td>29-03-2018</td>
                                <td>$162,700</td>
                                <td>
                                    {{-- <a href="{{ url('/car_catalog/detail_inforcar') }}" type="button"
                                        class="btn btn-primary">Sửa</a>
                                    <a href="" type="button" class="btn btn-primary">Xóa</a> --}}

                                    <a type="button" class="btn btn-primary" href="{{ url('/car_catalog/detail_inforcar') }}">
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