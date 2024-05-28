@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe đăng bán')
@section('pg-card-title', 'Thông tin xe đăng bán')
@section('pg-hd-2', 'Giao dịch')
@section('pg-hd-3', 'Quản lý tiến trình')
@section('st4', 'true') @section('pg-hd-4', 'Đăng bán xe') @section('act4', 'active')


@section('main')

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
                    <form method="POST" action="{{ route('them-xedangban-thongtinxe') }}" class="form mt-2">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="maxedangban">Mã xe đăng bán</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="maxedangban" id="maxedangban" value="{{ $maxedangban }}"
                                    required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="thongtinxe">Thông tin xe</label>
                            <div class="col-sm-12 col-md-10">
                                <select name="maxe" class="form-control thongtinxe" id="thongtinxe" required>
                                    <option value="" selected hidden>Chọn xe</option>
                                    @foreach ($thongtinxe as $i)
                                        <option value="{{ $i->maxe }}">{{ $i->tenxe }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="ngayban">Ngày đăng bán</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="ngayban" id="ngayban"
                                    value="{{ date('d/m/Y', strtotime($ngayban)) }}" />
                                @error('ngayban')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="giaban">Giá bán</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="giaban" id="giaban" value=""
                                    oninput="formatCurrency(this)" />
                                @error('giaban')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="mota">Mô tả</label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" name="mota" id="mota"></textarea>
                                @error('mota')
                                    <small class="help-block">
                                        <p class="text-danger">{{ $message }}</p>
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
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
        });
    </script>

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
