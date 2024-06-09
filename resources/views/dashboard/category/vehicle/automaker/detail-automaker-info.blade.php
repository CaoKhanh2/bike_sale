@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin hãng xe')
@section('pg-card-title', 'Thông tin hãng xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4', 'true')
@section('pg-hd-4', 'Thông tin hãng xe') @section('act4', 'active')

@section('main')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left my-3">
                            <h4 class="text-blue h4">Thông tin</h4>
                        </div>
                    </div>
                    <form action="{{ route('thuchien-capnhathangxe', ['id' => $hangxe->mahx]) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="mahx">Mã hãng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="mahx" value="{{ $hangxe->mahx }}"
                                    readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="tenhang">Tên hãng xe</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" value="{{ $hangxe->tenhang }}" name="tenhang" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label" for="xuatxu">Xuất xứ</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" value="{{ $hangxe->xuatxu }}" name="xuatxu" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Ảnh logo</label>
                            <div class="col-sm-12 col-md-10">
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="logo" name="logo">
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3"> <i class="bi bi-upload"></i>
                                Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    </div>

@endsection
