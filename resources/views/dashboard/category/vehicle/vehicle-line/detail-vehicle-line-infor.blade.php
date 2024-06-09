@extends('dashboard.layout.content')

@section('title_ds', 'Thông tin dòng xe')
@section('pg-card-title', 'Thông tin dòng xe')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Danh mục xe')
@section('st4', 'true')
@section('pg-hd-4', 'Thông tin dòng xe') @section('act4', 'active')

@section('main')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left my-3">
                        <h4 class="text-blue h4">Thông tin</h4>
                    </div>
                </div>
                <form action="{{ route('thuchien-capnhatdongxe',['id'=>$dongxe->madx]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="madx">Mã dòng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="madx" id="madx" value="{{ $dongxe->madx }}" readonly/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="loaixe">Loại xe</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" id="loaixe" name="loaixe">
                                <option value="Xe máy" {{ $dongxe->loaixe == 'Xe máy' ? 'selected' : '' }}>Xe máy</option>
                                <option value="Xe đạp điện" {{ $dongxe->loaixe == 'Xe đạp điện' ? 'selected' : '' }}>Xe đạp điện</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="hangxe">Hãng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" id="hangxe" name="hangxe">
                                <option value="{{ $dongxe->mahx }}" selected hidden>{{ $dongxe->tenhang }}</option>
                                @foreach ($hangxe as $i)
                                    <option value="{{ $i->mahx }}">{{ $i->tenhang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="tendongxe">Tên dòng xe</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="tendongxe" id="tendongxe" value="{{ $dongxe->tendongxe }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label" for="mota">Mô tả</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" rows="3" name="mota" id="mota">{{ $dongxe->mota }}</textarea>
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

@endsection
