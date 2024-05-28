@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe')
@section('pg-card-title', 'Thông tin xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin xe') @section('act3', 'active')
@section('st4', 'false')
@section('main')


    @if (Session::has('success-them-thongtinxe'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('success-them-thongtinxe') }}",
            });
        </script>
    @elseif(Session::has('cross-them-thongtinxe'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Thông báo",
                position: "center",
                text: "{{ Session::get('cross-them-thongtinxe') }}",
            });
        </script>
    @endif


    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pb-20">
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#table1" role="tab"
                                        aria-selected="true">Thông tin xe máy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#table2" role="tab"
                                        aria-selected="false">Thông tin xe đạp điện</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#form-add" role="tab"
                                        aria-selected="false">Thêm dữ liệu</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="table1" role="tabpanel">
                                    <div class="pt-20 table-responsive">
                                        @include('dashboard.category.vehicle.vehicle-types.motorbike')
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="table2" role="tabpanel">
                                    <div class="pt-20 table-responsive">
                                        @include('dashboard.category.vehicle.vehicle-types.electric-bicycles')
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-add" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Phương tiện</label>
                                            <div class="col-sm-12 col-md-10">
                                                <select class="custom-select col-12" id="vehicle" name="xe">
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
                                                    <input type="text" value="1" name="xe">
                                                </div>
                                            </div>
                                            <div id="form1" style="display: none;">
                                                {{-- <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Mã xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" name="mx" />
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="hangxemay">Hãng xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <select class="custom-select col-12" name="hx" id="hangxemay" required>
                                                            <option selected hidden>Choose...</option>
                                                            @foreach ($hangxemay as $i)
                                                                <option value="{{ $i->mahx }}">{{ $i->tenhang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="dongxemay">Dòng xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <select class="custom-select col-12" name="dx" id="dongxemay" required>
                                                            <option selected hidden>Choose...</option>
                                                            {{-- @foreach ($dongxemay as $i)
                                                                <option value="{{ $i->madx }}">{{ $i->tendongxe }}
                                                                </option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="tx">Tên xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" name="tx" id="tx"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="tgsd">Thời gian đã sử
                                                        dụng</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" name="tgsd" id="tgsd" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="sokmdadi">Số Km đã đi</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" type="number" name="sokmdadi" id="sokmdadi"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="tinhtrangxe">Tình trạng xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input type="text" class="form-control" name="tinhtrangxe" id="tinhtrangxe">
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Biển số xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" name="bsx" maxlength="12">
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="images">Hình ảnh</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="images" name="anh[]" multiple>
                                                            <label class="custom-file-label">Chọn ảnh</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="ghichu">Ghi chú</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <textarea class="form-control" rows="3" name="ghichu" id="ghichu"></textarea>
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
                                                    <input type="text" value="2" name="xe">
                                                </div>
                                            </div>
                                            <div id="form2" style="display: none;">
                                                {{-- <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Mã xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" name="mx" />
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="hangxedapdien">Hãng xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <select class="custom-select col-12" name="hx"
                                                            id="hangxedapdien">
                                                            <option selected hidden>Choose...</option>
                                                            @foreach ($hangxedapdien as $i)
                                                                <option value="{{ $i->mahx }}">{{ $i->tenhang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="dongxedapdien">Dòng xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <select class="custom-select col-12" name="dx"
                                                            id="dongxedapdien">
                                                            <option selected hidden>Choose...</option>
                                                            @foreach ($dongxedapdien as $i)
                                                                <option value="{{ $i->madx }}">{{ $i->tendongxe }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="tx">Tên xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" name="tx" id="tx"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="tgsd">Thời gian đã sử
                                                        dụng</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" name="tgsd" id="tgsd"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="sokmdadi">Số Km đã đi</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" type="number" name="sokmdadi" id="sokmdadi"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="tinhtrangxe">Tình trạng xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" name="tinhtrangxe" id="tinhtrangxe">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="images">Hình ảnh</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="images" name="anh[]" multiple>
                                                            <label class="custom-file-label">Chọn ảnh</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label" for="ghichu">Ghi chú</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <textarea class="form-control" rows="3" name="ghichu" id="ghichu"></textarea>
                                                    </div>
                                                </div>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
                                                </div>
                                            </div>
                                        </form>
                                        {{-- Het --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
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
        });
    </script>

    {{-- loại bỏ các bản ghi trùng lặp từ một mảng dongxemay --}}
    <script>
        var uniqueRecords = [];
        var seen = new Set();
        dongxemay.forEach(function(record) {
            if (!seen.has(record.madx)) {
                uniqueRecords.push(record);
                seen.add(record.madx);
            }
        });
    </script>
    {{-- het --}}

    <script>
        document.getElementById('hangxemay').addEventListener('change', function() {
            var selectedHangXe = this.value;
            var dongXeSelect = document.getElementById('dongxemay');
            dongXeSelect.innerHTML = '';
            @foreach ($dongxemay as $i)
                if ("{{ $i->mahx }}" === selectedHangXe) {
                    var option = document.createElement('option');
                    option.value = "{{ $i->madx }}";
                    option.textContent = "{{ $i->tendongxe }}";
                    dongXeSelect.appendChild(option);
                }
            @endforeach
        });
    </script>

    <script>
        document.getElementById('hangxedapdien').addEventListener('change', function() {
            var selectedHangXe = this.value;
            var dongXeSelect = document.getElementById('dongxedapdien');
            dongXeSelect.innerHTML = '';


            @foreach ($dongxedapdien as $i)
                if ("{{ $i->mahx }}" === selectedHangXe) {
                    var option = document.createElement('option');
                    option.value = "{{ $i->madx }}";
                    option.textContent = "{{ $i->tendongxe }}";
                    dongXeSelect.appendChild(option);
                }
            @endforeach
        });
    </script>

@endsection
