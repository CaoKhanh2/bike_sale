@extends('dashboard.layout.content')

@section('title_ds', 'Danh sách xe đăng ký bán')
@section('pg-hd-2', 'Danh sách xe đăng ký bán')

@section('main')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}

                <!-- Export Datatable start -->
                <div class="card-box mb-30">
                    <div class="pd-10">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="tab" href="#choxacnhan" role="tab"
                                    aria-selected="true">Chờ xác nhận</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#dangxuly" role="tab"
                                    aria-selected="false">Đang xử lý</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#contact2" role="tab"
                                    aria-selected="false">Đã mua</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="choxacnhan" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover multiple-select-row align-middle">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Ngày bán</th>
                                                <th>Người tạo</th>
                                                <th>Mô tả</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($xedangkythumua_uncheck as $i)
                                                <tr>
                                                    <td class="table-plus">{{ $i->madkthumua }}</td>
                                                    <td>{{ $i->hovaten }}</td>
                                                    <td>{{ Auth::user()->manv }}</td>
                                                    <td>
                                                        @php
                                                            $formattedDate = date('d/m/Y', strtotime($i->ngaydk));
                                                            echo $formattedDate;
                                                        @endphp
                                                    </td>
                                                    <td>{{ $i->mota }}</td>
                                                    <td>{{ number_format($i->giaban, 0, ',') . ' đ' }}</td>
                                                    <td class="d-flex justify-content-center">
                                                        @php
                                                            $rs = strval($i->trangthaipheduyet);
                                                            $kq = strcmp($rs, 'Duyệt');
                                                            if ($kq == '0') {
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
                                                        <a type="button" class="btn btn-primary"
                                                            href="{{ route('duyetdon',['id'=> $i->madkthumua]) }}">
                                                            <i class="bi bi-pencil-fill"></i> Duyệt
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="dangxuly" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover multiple-select-row align-middle">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Tên người duyệt</th>
                                                <th>Ngày bán</th>
                                                <th>Mô tả</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($xedangkythumua_check as $i)
                                                <tr>
                                                    <td class="table-plus">{{ $i->madkthumua }}</td>
                                                    <td>{{ $i->hovaten }}</td>
                                                    <td>{{Auth::user()->manv}}</td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($i->ngaydk)) }}
                                                    </td>
                                                    <td>{{ $i->mota }}</td>
                                                    <td>{{ number_format($i->giaban, 0, ',') . ' đ' }}</td>
                                                    <td class="d-flex justify-content-center">
                                                        @php
                                                            $rs = strval($i->trangthaipheduyet);
                                                            $kq = strcmp($rs, 'Duyệt');
                                                            if ($kq == '0') {
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

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
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
