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
                                    aria-selected="false">Đang liên hệ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#datuchoi" role="tab"
                                    aria-selected="false">Đã từ chối</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#damua" role="tab"
                                    aria-selected="false">Đã nhận mua</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            {{-- danh sách chờ  --}}
                            <div class="tab-pane fade show active" id="choxacnhan" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover multiple-select-row">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Ngày đăng bán</th>
                                                <th>Mô tả</th>
                                                <th>Giá bán</th>
                                                <th>Chi tiết</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($xedangkythumua_waiting as $i)
                                                <tr>
                                                    <td class="table-plus">{{ $i->madkthumua }}</td>
                                                    <td>{{ $i->hovaten }}</td>
                                                    <td>
                                                        @php
                                                            $formattedDate = date('d/m/Y', strtotime($i->ngaydk));
                                                            echo $formattedDate;
                                                        @endphp
                                                    </td>
                                                    <td>{{ $i->mota }}</td>
                                                    <td>{{ number_format($i->giaban, 0, ',') . ' đ' }}</td>
                                                    <td>
                                                        <a href="{{ route('ctthongtinmua',['id' => $i->madkthumua]) }}">
                                                            <img src={{ asset('Image\Icon\eye.png') }} width="30px"
                                                                height="30px">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a type="button" class="btn btn-outline-primary col"
                                                            href="{{ route('duyetdonthumua', ['id' => $i->madkthumua]) }}">
                                                            <i class="bi bi-pencil-fill"></i> Chấp nhận
                                                        </a>
                                                        <a type="button" class="btn btn-danger col mt-2"
                                                            href="{{ route('huydonthumua', ['id' => $i->madkthumua]) }}">
                                                            <i class="bi bi-trash"></i> Không chấp nhận
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- end --}}
                            {{-- danh sach dang xu ly --}}
                            <div class="tab-pane fade" id="dangxuly" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover multiple-select-row">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Tên người duyệt</th>
                                                <th>Ngày bán</th>
                                                <th>Ngày duyệt</th>
                                                <th>Giá bán</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($xedangkythumua_procces as $i)
                                                <tr>
                                                    <td class="table-plus">{{ $i->madkthumua }}</td>
                                                    <td>{{ $i->tennd }}</td>
                                                    <td>{{ $i->tennv}}</td>
                                                    <td>
                                                        @php
                                                            $formattedDate = date('d/m/Y', strtotime($i->ngaydk));
                                                            echo $formattedDate;
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        @php
                                                            $formattedDate = date('d/m/Y', strtotime($i->ngayduyet));
                                                            echo $formattedDate;
                                                        @endphp
                                                    </td>
                                                    <td>{{ number_format($i->giaban, 0, ',') . ' đ' }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-outline-primary col"
                                                        href="{{ route('themxe-xethumua', ['id' => $i->madkthumua]) }}">
                                                        <i class="bi bi-pencil-fill"></i> Lập phiếu
                                                    </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- end --}}
                            {{-- danh sach da tu choi --}}
                            <div class="tab-pane fade" id="datuchoi" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover multiple-select-row">
                                        <thead>
                                            <tr>
                                                <th>Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Tên người duyệt</th>
                                                <th>Ngày bán</th>
                                                <th>Ngày duyệt</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($xedangkythumua_uncheck as $i)
                                                <tr>
                                                    <td class="table-plus">{{ $i->madkthumua }}</td>
                                                    <td>{{ $i->tennd }}</td>
                                                    <td>{{ $i->tennv}}</td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($i->ngaydk)) }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $formattedDate = date('d/m/Y', strtotime($i->ngayduyet));
                                                            echo $formattedDate;
                                                        @endphp
                                                    </td>
                                                    <td>{{ number_format($i->giaban, 0, ',') . ' đ' }}</td>
                                                    <td class="text-center">
                                                        @php
                                                            echo '<img src="' .
                                                                asset('Image/Icon/remove.png') .
                                                                '" alt="" srcset="" width="25" height="25">';
                                                        @endphp
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- ----end---- --}}
                            {{-- danh sach da mua --}}
                            <div class="tab-pane fade" id="damua" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover multiple-select-row">
                                        <thead>
                                            <tr>
                                                <th>Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Tên người duyệt</th>
                                                <th>Ngày bán</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($xedangkythumua_check as $i)
                                                <tr>
                                                    <td>{{ $i->madkthumua }}</td>
                                                    <td>{{ $i->tennd }}</td>
                                                    <td>{{ $i->tennv}}</td>
                                                    <td>
                                                        {{ date('d/m/Y', strtotime($i->ngaydk)) }}
                                                    </td>
                                                    <td>{{ number_format($i->giaban, 0, ',') . ' đ' }}</td>
                                                    <td class="text-center">
                                                        @php
                                                            echo '<img src="' .
                                                                asset('Image/Icon/check.png') .
                                                                '" alt="" srcset="" width="25" height="25">';
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
