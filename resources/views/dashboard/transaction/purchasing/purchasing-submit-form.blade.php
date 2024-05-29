@extends('dashboard.layout.content')
@section('title_ds', 'Thông tin mua')
@section('pg-card-title', 'Xác nhận mua xe')
@section('pg-hd-2', 'Giao dịch')
@section('pg-hd-3', 'Quản lý bán hàng')
@section('st4', 'true')
@section('pg-hd-4', 'Danh mục xe máy') @section('act4', 'active')



@section('main')
    @php
        $lx = $tt['Loai xe'];
        echo $lx;
    @endphp

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
                <form action="{{ route('themthongtinxe') }}" class="form mt-2" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row" hidden>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" value="{{ $tt['Loai xe']}}" name="xe">
                        </div>
                    </div>
                    <div id="form1" style="display: none;">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Hãng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control"  value="{{ $hangxe['tenhang']}}"/>
                                <input class="form-control" name="hx" value="{{ $hangxe['mahx']}}" hidden/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Dòng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control"  value="{{ $dongxe['tendongxe']}}"/>
                                <input class="form-control" name="dx" value="{{ $dongxe['madx']}}" hidden/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tên xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tx" value="{{ $tt['Ten xe']}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Thời gian đã sử
                                dụng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tgsd" value="{{ $tt['tgsd']}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Số Km đã đi</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="sokmdadi" value="{{ $tt['kmdadi']}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tình trạng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tinhtrangxe" min="2000"
                                    max="2024">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Hình ảnh</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="images" name="anh[]" multiple>
                                    <label class="custom-file-label">Chọn ảnh</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit"
                                class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                        </div>
                    </div>

                </form>
                {{-- Het --}}
                {{-- Thong tin xe dap dien --}}
                <form action="{{ route('themthongtinxe') }}" class="form mt-2" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row" hidden>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" value="{{ $tt['Loai xe']}}" name="xe">
                        </div>
                    </div>
                    <div id="form2" style="display: none;">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Hãng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control"  value="{{ $hangxe['tenhang']}}"/>
                                <input class="form-control" name="hx" value="{{ $hangxe['mahx']}}" hidden/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Dòng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control"  value="{{ $dongxe['tendongxe']}}"/>
                                <input class="form-control" name="hx" value="{{ $dongxe['madx']}}" hidden/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tên xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tx" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Thời gian đã sử
                                dụng</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tgsd" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Số Km đã đi</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="number" name="sokmdadi" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Tình trạng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" name="tinhtrangxe" min="2000"
                                    max="2024">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Hình ảnh</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="images" name="anh[]" multiple>
                                    <label class="custom-file-label">Chọn ảnh</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit"
                                class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var lx = "{{ $tt['Loai xe'] }}"
            if(lx === 'Xe may')
            {
                $('#vehicle').val('1');
            }
            else
            {
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
    @endsection
