@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe đăng bán')
@section('pg-card-title', 'Thông tin xe đăng bán')
@section('pg-hd-2', 'Giao dịch')
@section('pg-hd-3', 'Quản lý thanh toán')
@section('st4', 'true') @section('pg-hd-4', 'Đơn hàng') @section('act4', 'active')


@section('main')
    @if (Session::has('infor-kiemtra-donhang'))
        <script>
            Swal.fire({
                icon: "info",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('infor-kiemtra-donhang') }}",
            });
        </script>
    @endif
    @if (Session::has('success-kiemtra-donhang'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-kiemtra-donhang') }}",
            });
        </script>
    @endif
    @if (Session::has('cross-kiemtra-donhang'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('cross-kiemtra-donhang') }}",
            });
        </script>
    @endif
    @if (Session::has('success-huy-donhang'))
        <script>
            Swal.fire({
                icon: "error",
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
                <div class="pd-20">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-blue h4">Thông tin đơn hàng</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('thongtin-thanhtoan') }}" class="btn btn-warning">Quay lại</a>
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <form method="POST"
                        action="{{ route('thuchien-kiemtra-donhang', ['madonhang' => $chitiet_donhang_chuathanhtoan->madh, 'mand' => $chitiet_donhang_chuathanhtoan->mand]) }}"
                        class="form mt-2">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="madh">Mã đơn hàng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="madh" id="madh"
                                    value="{{ $chitiet_donhang_chuathanhtoan->madh }}" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Thông tin xe</label>
                            <div class="col-sm-12 col-md-10">
                                @foreach ($thongtinxe_donhang as $i)
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text border" id="label-tenxe">Tên xe</span>
                                                <input class="form-control text-center" name="tenxe"
                                                    value="{{ $i->tenxe }}"
                                                    aria-describedby="label-tenxe" readonly />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text border" id="label-dongia">Giá bán</span>
                                                    <input class="form-control text-center" name="dongia"
                                                        value="{{ number_format($i->dongia, 0, '.', ',') . ' đ' }}"
                                                        aria-describedby="label-dongia" readonly />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Thông tin khách
                                hàng</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border" id="label-mand">Mã người dùng</span>
                                            <input class="form-control text-center" name="mand"
                                                value="{{ $chitiet_donhang_chuathanhtoan->mand }}"
                                                aria-describedby="label-mand" readonly />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border" id="label-hovaten">Họ và tên</span>
                                            <input class="form-control text-center"
                                                value="{{ $chitiet_donhang_chuathanhtoan->hovaten }}" aria-describedby="label-hovaten" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border" id="label-cccd">Số Căn cước công dân</span>
                                            <input class="form-control text-center"
                                                value="{{ $chitiet_donhang_chuathanhtoan->cccd }}" aria-describedby="label-cccd" readonly />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text border" id="label-email">Email</span>
                                            <input class="form-control text-center" aria-describedat="label-email"
                                                value="{{ $chitiet_donhang_chuathanhtoan->email }}" readonly />
                                            {{-- <textarea class="form-control" aria-label="With textarea" disabled>{{ $chitiet_donhang_chuathanhtoan->diachi }}</textarea> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text border" id="label-sodienthoai">Số điện thoại</span>
                                            <input class="form-control text-center" aria-describedat="label-sodienthoai"
                                                value="{{ $chitiet_donhang_chuathanhtoan->sodienthoai }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text border" id="label-diachi">Địa chỉ</span>
                                            <input class="form-control text-center" aria-describedat="label-diachi"
                                                value="{{ $chitiet_donhang_chuathanhtoan->diachi }}" readonly />
                                            {{-- <textarea class="form-control" aria-label="With textarea" disabled>{{ $chitiet_donhang_chuathanhtoan->diachi }}</textarea> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="ngaytaodon">Ngày tạo đơn</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="ngaytaodon" id="ngaytaodon"
                                    value="{{ date('d/m/y H:m:i', strtotime($chitiet_donhang_chuathanhtoan->ngaytaodon)) }}"
                                    required readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="tongtien">Số tiền cần phải trả</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="input-group">
                                    <input class="form-control" name="tongtien" id="tongtien"
                                        value="{{ number_format($chitiet_donhang_chuathanhtoan->tongtien, 0, '.', ',') . ' đ' }}"
                                        required readonly />
                                    <span class="input-group-text">VND</span>
                                </div>
                            </div>
                            @error('tongtien')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="tientra">Số tiền đã trả</label>
                            <div class="col-sm-12 col-md-10">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Số tiền đã trả</th>
                                            <th>Ngày trả</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($chitiet_donhang_chuathanhtoan->ghichu))
                                            @php
                                                $sum = 0;
                                            @endphp
                                            @foreach ($ghichuArray as $item => $key)
                                                @php
                                                    $sum = $key['tienthu'] + $sum;
                                                @endphp
                                                <tr>
                                                    <td>{{ $item + 1 }}</td>
                                                    <td>{{ number_format($key['tienthu'], 0, '.', ',') . ' đ' }}</td>
                                                    <td>{{ date('d/m/y H:m:i', strtotime($key['ngaythu'])) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td><strong>Tổng tiền đã trả</strong></td>
                                                <td><strong>{{ number_format($sum, 0, '.', ',') . ' đ' }}</strong></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="tientra">Số tiền trả</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="input-group">
                                    @if ($trangthai->trangthai == 'Đã hoàn thành')
                                        <input class="form-control" name="tientra" id="tientra" value=""
                                            oninput="formatCurrency(this)" disabled />
                                        <span class="input-group-text">VND</span>
                                    @elseif ($trangthai->trangthai == 'Đang chờ xử lý')
                                        <input class="form-control" name="tientra" id="tientra" value=""
                                            oninput="formatCurrency(this)" />
                                        <span class="input-group-text">VND</span>
                                    @else
                                        <input class="form-control" name="tientra" id="tientra" value=""
                                        oninput="formatCurrency(this)" disabled />
                                        <span class="input-group-text">VND</span>
                                    @endif
                                </div>
                                @error('tientra')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="trangthai">Trạng thái</label>
                            <div class="col-sm-12 col-md-10">
                                <select name="trangthai" id="trangthai" class="form-control" disabled>
                                    <option value="">{{ $chitiet_donhang_chuathanhtoan->trangthai }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            @if ($chitiet_donhang_chuathanhtoan->trangthai == 'Đang chờ xử lý')
                                <button type="submit" class="btn btn-primary me-md-2 mx-1 my-3"><i
                                        class="bi bi-check2-all fs-2"></i> Xác nhận</button>
                                <button type="submit"
                                    formaction="{{ route('thuchien-huy-donhang', ['madonhang' => $chitiet_donhang_chuathanhtoan->madh]) }}"
                                    id="submit-huy-don" class="btn btn-danger me-md-2 mx-1 my-3"> <i
                                        class="bi bi-x-lg"></i> Hủy
                                    đơn</button>
                            @elseif($chitiet_donhang_chuathanhtoan->trangthai == 'Đã hoàn thành')
                                <button formaction="{{ route('xuatfile-pdf-hoadon-dash') }}" type="submit"
                                    class="btn btn-secondary me-md-2 mx-3 my-3"> <i class="bi bi-filetype-pdf"></i> In hóa
                                    đơn</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatCurrency(input) {
            // Remove any non-numeric characters except for the decimal point
            let value = input.value.replace(/[^0-9.]/g, '');

            // Split the value into whole and decimal parts if there's a decimal point
            let parts = value.split('.');
            let wholePart = parts[0];
            let decimalPart = parts.length > 1 ? '.' + parts[1].substring(0, 2) : '';

            // Add commas to the whole part
            wholePart = wholePart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Combine the whole and decimal parts and set the input value
            input.value = wholePart + decimalPart;
        }
    </script>


@endsection
