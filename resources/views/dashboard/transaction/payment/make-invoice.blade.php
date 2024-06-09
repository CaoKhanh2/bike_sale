@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin hóa đơn')
@section('pg-card-title', 'Thông tin hóa đơn')
@section('pg-hd-2', 'Giao dịch')
@section('pg-hd-3', 'Quản lý thanh toán')
@section('st4', 'true') @section('pg-hd-4', 'Lập hóa đơn') @section('act4', 'active')


@section('main')

    @if (Session::has('success-create-customer-inInvoice'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-create-customer-inInvoice') }}",
            });
        </script>
    @endif
    @if (Session::has('success-huy-donhang'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-huy-donhang') }}",
            });
        </script>
    @endif

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}
            <div class="pd-20 card-box mb-3">
                <div class="pd-10">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <h4 class="text-blue h4">Lập hóa đơn</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('thongtin-thanhtoan') }}" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Quay lại</a>
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <form class="form mt-2"
                        action="{{ route('thuchien-xacnhan-hoadon', ['id' => Session::get('mahoadon')]) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="mahoadon">Mã hóa đơn</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="mahoadon" id="mahoadon"
                                    value="{{ Session::get('mahoadon') }}" readonly />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="thongtinxe">Thông tin xe</label>
                            <div class="col-sm-12 col-md-6">
                                <select name="maxe" class="form-control thongtinxe" id="thongtinxe">
                                    <option value="" selected hidden>Chọn xe</option>
                                    @foreach ($thongtinxe as $i)
                                        <option value="{{ $i->maxe }}">{{ $i->tenxe }}</option>
                                    @endforeach
                                </select>
                                @error('maxe')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <button type="submit" formaction="{{ route('thuchien-themxe-hoadon') }}" formmethod="POST"
                                    class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i> Thêm
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-md-2 col-form-label" for=""></label>
                            <div class="col-sm-12 col-md-10">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã xe</th>
                                            <th>Tên xe</th>
                                            <th>Số lượng</th>
                                            <th>Giá bán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($cthoadon))
                                            @php $count = 1; @endphp
                                            @foreach ($cthoadon as $i)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $i->maxe }}</td>
                                                    <td>{{ $i->tenxe }}</td>
                                                    <td>{{ $i->soluong }}</td>
                                                    <td>{{ number_format($i->dongia, 0, '.', ',') . ' đ' }}</td>
                                                    <td>
                                                        <a href="{{ route('thuchien-xoaxe-hoadon',['id'=>$i->macthoadon]) }}" class="btn btn-danger">Xóa</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="nguoidung">Thông tin khách hàng</label>
                            <div class="col-sm-12 col-md-6">
                                <select name="nguoidung" class="form-control nguoidung" id="nguoidung">
                                    <option value="">Tìm kiếm</option>
                                    @foreach ($nguoidung as $i)
                                        <option value="{{ $i->mand }}">{{ $i->hovaten }}</option>
                                    @endforeach
                                </select>
                                @error('nguoidung')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <button type="submit" formaction="{{ route('thuchien-them-nguoidung') }}"
                                    formmethod="POST" class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i> Thêm
                                </button>
                                <button type="submit" formaction="{{ route('taomoi-nguoidung-hoadon') }}" formmethod="GET" class="btn btn-primary">
                                    <i class="bi bi-person-plus"></i> Tạo mới
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-2 col-form-label"></div>
                            <div class="col-sm-12 col-md-10">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border" id="label-mand">Mã người dùng</span>
                                            <input class="form-control text-center" name="mand"
                                                value="{{ isset($thongtin_nguoidung) ? $thongtin_nguoidung->mand : '' }}"
                                                aria-describedby="label-mand" readonly />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border" id="label-hovaten">Họ và tên</span>
                                            <input class="form-control text-center"
                                                value="{{ isset($thongtin_nguoidung) ? $thongtin_nguoidung->hovaten : '' }}"
                                                aria-describedby="label-hovaten" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border" id="label-cccd">Số Căn cước công
                                                dân</span>
                                            <input class="form-control text-center"
                                                value="{{ isset($thongtin_nguoidung) ? $thongtin_nguoidung->cccd : '' }}"
                                                aria-describedby="label-cccd" readonly />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text border" id="label-email">Email</span>
                                            <input class="form-control text-center" aria-describedat="label-email"
                                                value="{{ isset($thongtin_nguoidung) ? $thongtin_nguoidung->email : '' }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border" id="label-sodienthoai">Số điện
                                                thoại</span>
                                            <input class="form-control text-center" aria-describedat="label-sodienthoai"
                                                value="{{ isset($thongtin_nguoidung) ? $thongtin_nguoidung->sodienthoai : '' }}"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text border" id="label-diachi">Địa chỉ</span>
                                            <input class="form-control text-center" aria-describedat="label-diachi"
                                                value="{{ isset($thongtin_nguoidung) ? $thongtin_nguoidung->diachi : '' }}"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="khuyenmai">Khuyến mãi</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="khuyenmai" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Số tiền phải trả</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        value="{{ $tongtiencantra->tonggiatrihoadon == null ? 0 : number_format($tongtiencantra->tonggiatrihoadon, 0, '.', ',') }}"
                                        readonly>
                                    <span class="input-group-text">VND</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="tientra">Số tiền trả</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tientra" name="tientra">
                                    <span class="input-group-text">VND</span>
                                </div>
                                @error('tientra')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2 mx-1 my-3"> <i
                                    class="bi bi-check2"></i> Xác nhận</button>
                            <button type="submit"
                                formaction="{{ route('thuchien-huy-hoadon', ['id' => Session::get('mahoadon')]) }}"
                                formmethod="POST" class="btn btn-danger me-md-2 mx-1 my-3">
                                <i class="bi bi-x-lg"></i> Hủy hóa đơn
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.thongtinxe').select2({
                placeholder: "Chọn xe",
                allowClear: true
            });


            $('.nguoidung').select2({
                placeholder: "Tìm khách hàng",
                allowClear: true
            });
        });
    </script>


@endsection
