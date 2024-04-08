@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe')
@section('pg-card-title', 'Thông tin xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin xe') @section('act3', 'active')
@section('st4', 'false')
@section('main')
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
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#table" role="tab"
                                        aria-selected="true">Thông tin bảng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#form-add" role="tab"
                                        aria-selected="false">Thêm dữ liệu</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="table" role="tabpanel">
                                    <div class="pt-20">
                                        <table class="table hover data-table-export">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Loại xe</th>
                                                    <th>Hãng xe</th>
                                                    <th>Danh mục</th>
                                                    <th>Tên xe</th>
                                                    <th>Giá bán</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Gloria F. Mead</td>
                                                    <td>25</td>
                                                    <td>Sagittarius</td>
                                                    <td>2829 Trainer Avenue Peoria, IL 61602</td>
                                                    <td>29-03-2018</td>
                                                    <td>$162,700</td>
                                                    <td>
                                                        <a type="button" class="btn btn-primary"
                                                            href="{{ url('/dashboard/category/vehicle/detail_vehicle_infor') }}">
                                                            <i class="bi bi-pencil-fill"></i> Sửa
                                                        </a>
                                                        <a type="button" class="btn btn-danger" href="">
                                                            <i class="bi bi-trash3"></i> Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-add" role="tabpanel">
                                    <div class="pd-20">
                                        <form action="" class="form mt-2">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Phương tiện</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="custom-select col-12" id="vehicle">
                                                        <option selected="">Choose...</option>
                                                        <option value="1">Xe máy</option>
                                                        <option value="2">Xe đạp điện</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                        <form action="">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Mã xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Hãng xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="custom-select col-12">
                                                        <option selected="">Choose...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Dòng xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <select class="custom-select col-12">
                                                        <option selected="">Choose...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-2 col-form-label">Tên xe</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input class="form-control" />
                                                </div>
                                            </div>

                                            <div id="form1" style="display: none;">
                                                <div class="my-4 border border-top border-4 border-primary"></div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Dung tích xe</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Số Km đã đi</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" type="number" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Năm đăng ký</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" type="number" name="year" min="2000"
                                                            max="2024">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Hình ảnh</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <div class="custom-file ">
                                                            <input type="file" class="custom-file-input" />
                                                            <label class="custom-file-label">Chọn ảnh</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Giá bán</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" type="number" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="form2" style="display: none;">
                                                <div class="my-4 border border-top border-4 border-primary"></div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Trọng lượng</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" type="number"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Loại pin</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Phạm vi sử dụng</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Hình ảnh</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <div class="custom-file ">
                                                            <input type="file" class="custom-file-input" />
                                                            <label class="custom-file-label">Chọn ảnh</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-12 col-md-2 col-form-label">Giá bán</label>
                                                    <div class="col-sm-12 col-md-10">
                                                        <input class="form-control" type="number" />
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Thêm</button>
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

@endsection
