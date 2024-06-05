@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe đăng bán')
@section('pg-card-title', 'Thông tin xe đăng bán')
@section('pg-hd-2', 'Giao dịch')
@section('pg-hd-3', 'Quản lý tiến trình')
@section('st4', 'true') @section('pg-hd-4', 'Đăng bán xe') @section('act4', 'active')


@section('main')
    @if (Session::has('cross-capnhat-xedangban'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('cross-capnhat-xedangban') }}",
            });
        </script>
    @endif
    @if (Session::has('success-capnhat-xedangban'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-capnhat-xedangban') }}",
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
                    <h4 class="text-blue h4">Thông tin đăng bán xe</h4>
                </div>
                <div class="pb-20">
                    <form method="POST" action="{{ route('thuchien-capnhat-thongtin-xedangban') }}" class="form mt-2">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="maxedangban">Mã xe đăng bán</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="maxedangban" id="maxedangban"
                                    value="{{ $xedangban->maxedangban }}" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="thongtinxe">Thông tin xe</label>
                            <div class="col-sm-12 col-md-10">
                                <a href="{{ route('ctthongtinxe', ['maxe' => $xedangban->maxe]) }}" class="btn btn-outline-dark col-12">Sửa thông tin xe</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="manv">Nhân viên thực hiện đăng
                                bán</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="manv" id="manv" value="{{ $xedangban->hovaten }}"
                                    readonly />
                                @error('manv')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="namsx">Năm sản xuất</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="namsx" id="namsx" value="{{ $xedangban->namsx }}" required/>
                                @error('namsx')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="giaban">Giá bán</label>
                            <div class="col-sm-12 col-md-10">
                                @if (Auth()->user()->phanquyen != 'Nhân viên')
                                    <div class="input-group">
                                        <input class="form-control" name="giaban" id="giaban"
                                            value="{{ number_format($xedangban->giaban, 0, '.', ',') }}"
                                            oninput="formatCurrency(this)" required/>
                                        <span class="input-group-text">VND</span>
                                    </div>
                                @else
                                    <div class="input-group">
                                        <input class="form-control" name="giaban" id="giaban"
                                            value="{{ number_format($xedangban->giaban, 0, '.', ',') }}"
                                            oninput="formatCurrency(this)" readonly />
                                        <span class="input-group-text">VND</span>
                                    </div>
                                @endif
                            </div>
                            @error('giaban')
                                <small class="help-block">
                                    <p class="text-danger">{{ $message }}</p>
                                </small>
                            @enderror
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="ngayban">Ngày đăng</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="ngayban" id="ngayban"
                            value="{{ date('d/m/Y', strtotime($xedangban->ngayban)) }}" required/>
                        @error('ngayban')
                            <small class="help-block">
                                <p class="text-danger">{{ $message }}</p>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="mota">Mô tả</label>
                    <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" name="mota" id="mota">{{ $xedangban->mota }}</textarea>
                        @error('mota')
                            <small class="help-block">
                                <p class="text-danger">{{ $message }}</p>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label" for="trangthai">Trạng thái</label>
                    <div class="col-sm-12 col-md-10">
                        @if (Auth()->user()->phanquyen != 'Nhân viên')
                            <select name="trangthai" id="trangthai" class="form-control">
                                <option value="{{ $xedangban->trangthai }}" selected hidden>{{ $xedangban->trangthai }}
                                </option>
                                <option> Đã bán xe </option>
                                <option> Đang xử lý </option>
                                <option> Còn xe </option>
                            </select>
                        @else
                            <select name="trangthai" id="trangthai" class="form-control" disabled>
                                <option value="{{ $xedangban->trangthai }}" selected hidden>{{ $xedangban->trangthai }}
                                </option>
                            </select>
                        @endif
                        @error('trangthai')
                            <small class="help-block">
                                <p class="text-danger">{{ $message }}</p>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Cập nhật</button>
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
