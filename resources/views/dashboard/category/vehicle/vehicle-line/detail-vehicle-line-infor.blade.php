@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin dòng xe')
@section('pg-card-title', 'Thông tin dòng xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4','true')
@section('pg-hd-4', 'Thông tin dòng xe') @section('act4','active')

@section('main')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        {{-- Page Header --}}
            @include('dashboard.layout.page-header')
        {{-- End Page Header--}}

        <div class="pd-20 card-box mb-30">
            <div class="clearfix">
                <div class="pull-left my-3">
                    <h4 class="text-blue h4">Thông tin</h4>
                </div>
            </div>
            <form action="">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mã dòng xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tên dòng xe</label>
                    <div class="col-sm-12 col-md-10">
                        <input
                            class="form-control"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Mô tả</label>
                    <div class="col-sm-12 col-md-10">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </form>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3">Sửa</button>
            </div>
        </div>

    </div>
</div>

@endsection

