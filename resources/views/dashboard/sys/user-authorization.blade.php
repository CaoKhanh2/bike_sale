@extends('dashboard.layout.content')

@section('title_ds', 'Phân quyền người dùng')
{{-- @section('pg-hd-1', '') --}}
@section('pg-hd-2', 'Phân quyền người dùng')

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
                        <table class="table hover data-table-export">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nhân viên</th>
                                    <th>Chức vụ</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" checked class="switch-btn" data-size="small"
                                            data-color="#198754" data-secondary-color="#dc3545" />
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
