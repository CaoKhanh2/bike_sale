@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin khách hàng')
@section('pg-card-title', 'Thông tin khách hàng')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin khách hàng') @section('act3', 'active')
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
                        <table class="table hover multiple-select-row data-table-export nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">Mã khách hàng</th>
                                    <th>Họ và tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Tình trạng</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($khachhang as $i)
                                    <tr>
                                        <td class="table-plus">{{ $i->makh }}</td>
                                        <td>{{ $i->hovaten }}</td>
                                        <td>
                                            @php
                                                $formattedDate = date('d/m/Y', strtotime($i->ngaysinh));
                                                echo $formattedDate;
                                            @endphp
                                        </td>
                                        <td>{{ $i->gioitinh }}</td>
                                        <td>{{ $i->sodienthoai }}</td>
                                        <td>{{ $i->email }}</td>
                                        <td>
                                            @php
                                                $rs = strval($i->tinhtrang);
                                                if ($rs == '1') {
                                                    echo '<img src="' .
                                                        asset('Image/Icon/check.png') .
                                                        '" alt="" srcset="" width="25" height=215">';
                                                } else {
                                                    echo '<img src="' .
                                                        asset('Image/Icon/remove.png') .
                                                        '" alt="" srcset="" width="25" height="25">';
                                                }

                                            @endphp
                                        </td>
                                        <td>
                                            {{-- <a href="{{ url('/car_catalog/detail_inforcar') }}" type="button"
                                                class="btn btn-primary">Sửa</a>
                                            <a href="" type="button" class="btn btn-primary">Xóa</a> --}}

                                            <a type="button" class="btn btn-primary"
                                                href="{{ url('/customer/detail_customer_info') }}">
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
                <!-- Export Datatable End -->
            </div>

        </div>
    </div>
@endsection
