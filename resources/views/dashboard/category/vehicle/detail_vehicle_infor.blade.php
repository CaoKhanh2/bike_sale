@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe')
@section('pg-card-title', 'Chi tiết thông tin xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Thông tin xe') @section('act3','active')
@section('st4','false')

@section('main')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        {{-- Page Header --}}
            @include('dashboard.layout.page-header')
        {{-- End Page Header--}}

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Thông tin xe</h4>
                    
                </div>
            </div>
            <form action="">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mã xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Loại xe</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Hãng xe</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tên xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
            </form>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Chi tiết thông tin xe</h4>
                    
                </div>
            </div>
            <form>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mã xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Dòng xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Dung tích xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Số km đã đi</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Dung tích xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Năm đăng ký</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Ảnh</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="file" class="form-control-file form-control height-auto" id="images" name="images[]" multiple>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Giá tiền</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                            type="number"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tình trạng</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Chi tiết thông tin xe</h4>
                    
                </div>
            </div>
            <form>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mã xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Dòng xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Trọng lượng</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Loại pin sử dụng</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Phạm vi sử dụng</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Hình ảnh</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="file" class="form-control-file form-control height-auto" id="images" name="images[]" multiple>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Giá tiền</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                            type="number"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tình trạng</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

