@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin xe')
@section('pg-card-title', 'Chi tiết thông tin xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4', 'true')
@section('pg-hd-4', 'Danh mục xe máy') @section('act4', 'active')

@section('main')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Thông tin xe</h4>

                    </div>
                </div>
                <form action="{{ url('/dashboard/category/vehicle/detail_vehicle_infor/$xm->maxemay') }}" method="POST">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Mã xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $xm->maxe }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Dòng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12">
                                <option value="{{ $xm->madx }}" selected hidden>{{ $xm->madx }}</option>
                                @foreach ($dx as $i)
                                    <option value="{{ $i->madx }}">{{ $i->madx }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Hãng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12">
                                <option value="{{ $xm->mahx }}" selected>{{ $xm->mahx }}</option>
                                @foreach ($hx as $i)
                                    <option value="{{ $i->mahx }}">{{ $i->mahx }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tên xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $xm->tenxe }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Biển số xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="bsx" value="{{ $xm->biensoxe }}" maxlength="12">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ghi chú</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" rows="3" name="mt">{{ $xm->ghichu }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ảnh</label>

                        <div class="col-sm-12 col-md-10">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    @foreach (explode(',', $xm->hinhanh) as $path)
                                        <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                                            <img src="{{ asset('storage/' . $path) }}" class="d-block w-100"
                                                alt="Ảnh">
                                        </div>
                                    @endforeach
                                </div>

                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon bg-secondary" aria-hidden="true" style="width:30px;height:30px;"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon bg-secondary" aria-hidden="true" style="width:30px;height:30px;"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>

                        <div class="col-sm-12 col-md-10">
                            <input type="file" class="form-control-file form-control height-auto" id="images"
                                name="images[]" multiple>
                        </div>
                    </div>
                </form>
            </div>

            @if( substr($xm->maxe, 0, 2) == 'XM')
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Thông số kỹ thuật xe</h4>

                    </div>
                </div>
                <form>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Khối lượng</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Dung tích xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Mức tiêu thụ nhiên liệu</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Dung tích bình xăng</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" />
                        </div>
                    </div>
                </form>
            </div>
            @else
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
                            <input class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Dòng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Trọng lượng</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Loại pin sử dụng</label>
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
                            <input type="file" class="form-control-file form-control height-auto" id="images"
                                name="images[]" multiple>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Giá tiền</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="number" />
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
            @endif
        </div>
    </div>

@endsection
