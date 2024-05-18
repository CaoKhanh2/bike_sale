@extends('dashboard.layout.content')

@section('title_ds', 'Quản lý bán xe')
@section('pg-hd-2', 'Quản lý bán xe')


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
                                    aria-selected="true">Đang xử lý</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#dangxuly" role="tab"
                                    aria-selected="false">Đã hoàn thành</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#datuchoi" role="tab"
                                    aria-selected="false">Đã hủy</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            {{-- danh sách đang xử lí  --}}
                            <div class="tab-pane fade show active" id="choxacnhan" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover align-middle">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đơn hàng</th>
                                                <th>Mã giỏ hàng</th>
                                                <th>Mã vận chuyển</th>
                                                <th>Mã khuyến mãi</th>
                                                <th>Ngày tạo đơn</th>
                                                <th>Tổng tiền</th>
                                                {{-- <th>Hành động</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donhang as $i)
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
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('ctthongtinmua',['id' => $i->madkthumua]) }}">
                                                        <img src={{ asset('Image\Icon\eye.png') }} width="30px"
                                                            height="30px">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-outline-primary col"
                                                        href="{{ route('duyetdonthumua', ['id' => $i->madkthumua]) }}">
                                                        <i class="bi bi-pencil-fill"></i> Duyệt
                                                    </a>
                                                    <a type="button" class="btn btn-danger col mt-2"
                                                        href="{{ route('huydonthumua', ['id' => $i->madkthumua]) }}">
                                                        <i class="bi bi-pencil-fill"></i> Không duyệt
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
                                    <table class="table hover align-middle">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Tên người duyệt</th>
                                                <th>Ngày bán</th>
                                                <th>Mô tả</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- end --}}
                            {{-- danh sach da tu choi --}}
                            <div class="tab-pane fade" id="datuchoi" role="tabpanel">
                                <div class="pd-20">
                                    <table class="table hover align-middle">
                                        <thead>
                                            <tr>
                                                <th class="table-plus datatable-nosort">Mã đăng ký</th>
                                                <th>Tên người bán</th>
                                                <th>Tên người duyệt</th>
                                                <th>Ngày bán</th>
                                                <th>Mô tả</th>
                                                <th>Giá bán</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- ----end---- --}}
                        </div>
                    </div>
                </div>
                <!-- Export Datatable End -->
            </div>

        </div>
    </div>
@endsection
