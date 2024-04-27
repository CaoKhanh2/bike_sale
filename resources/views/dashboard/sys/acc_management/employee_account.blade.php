@extends('dashboard.layout.content')

@section('title_ds', 'Tài khoản nhân viên')
@section('pg-card-title', 'Tài khoản nhân viên')
@section('pg-hd-2', 'Hệ thống')
@section('pg-hd-3', 'Quản lý tài khoản') 
@section('pg-hd-4', 'Tài khoản nhân viên') @section('act4', 'active')
@section('st4', 'true')

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
                    <div class="pb-20">
                        <table class="table hover data-table-export">
                            <thead>
                                <tr>
                                    <th>Mã nhân viên</th>
                                    <th>Tên nhân viên</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taikhoan2 as $i)
                                    <tr>
                                        <td>{{ $i->manv }}</td>
                                        <td>{{ $i->hovaten }}</td>
                                        <td>{{ date('d/m/Y', strtotime($i->ngaysinh)) }}</td>
                                        <td>{{ $i->gioitinh }}</td>
                                        <td>{{ $i->email }}</td>
                                        <td>{{ $i->sodienthoai }}</td>
                                        <td>{{ $i->trangthai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>


@endsection
