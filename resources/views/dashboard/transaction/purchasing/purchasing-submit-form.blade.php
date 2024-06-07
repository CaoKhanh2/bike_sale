@extends('dashboard.layout.content')
@section('title_ds', 'Thông tin mua')
@section('pg-card-title', 'Xác nhận mua xe')
@section('pg-hd-2', 'Giao dịch')
@section('pg-hd-3', 'Quản lý bán hàng')
@section('st4', 'true')
@section('pg-hd-4', 'Danh mục xe máy') @section('act4', 'active')



@section('main')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}

            <div class="pd-20 card-box px-3 mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Thông tin đơn bán xe</h4>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Phương tiện</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" id="vehicle" name="xe" disabled>
                            <option selected hidden>Choose...</option>
                            <option value="1">Xe máy</option>
                            <option value="2">Xe đạp điện</option>
                        </select>
                    </div>
                </div>
                {{-- Thong tin xe may --}}
                <form action="{{ route('themxe-xethumua-accepted', ['id' => $id]) }}" class="form mt-2" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row" hidden>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" value="1" name="xe">
                        </div>
                    </div>
                    <div id="form1" style="display: none;">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Hãng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" value="{{ $hangxe['tenhang'] }}" />
                                <input class="form-control" name="hx" value="{{ $hangxe['mahx'] }}" hidden />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tên xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tx" value="{{ $tt['Ten xe'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Thời gian đã sử
                                dụng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tgsd" value="{{ $tt['tgsd'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Số Km đã đi</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="sokmdadi" value="{{ $tt['kmdadi'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Giá bán</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="giaban" oninput="formatCurrency(this)"
                                    oninput="limitLength(this,11)" />
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                        </div>
                    </div>

                </form>
                {{-- Het --}}
                {{-- Thong tin xe dap dien --}}
                <form action="{{ route('themxe-xethumua-accepted', ['id' => $id]) }}" class="form mt-2" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row" hidden>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" value="2" name="xe">
                        </div>
                    </div>
                    <div id="form2" style="display: none;">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tên xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tx" value="{{ $tt['Ten xe'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Thời gian đã sử
                                dụng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tgsd" value="{{ $tt['tgsd'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Số Km đã đi</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="sokmdadi" value="{{ $tt['kmdadi'] }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Giá bán</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="giaban" oninput="formatCurrency(this)"
                                    oninput="limitLength(this,11)" />
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var lx = "{{ $tt['Loai xe'] }}"
            if (lx === 'Xe may') {
                $('#vehicle').val('1');
            } else {
                $('#vehicle').val('2');
            }

            $('#vehicle').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue == 1) {
                    $('#form1').show();
                    $('#form2').hide();
                } else if (selectedValue == 2) {
                    $('#form1').hide();
                    $('#form2').show();
                } else {
                    $('#form1').hide();
                    $('#form2').hide();
                }
            });
            $('#vehicle').trigger('change');
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
    <script>
        function limitLength(element, maxLength) {
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength);
            }
        }
    </script>
@endsection
