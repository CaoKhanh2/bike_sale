@extends('dashboard.layout.content')
@section('title_ds', 'Thông tin mua')
@section('pg-card-title', 'Chi tiết tin mua')
@section('pg-hd-2', 'Giao dịch')
@section('pg-hd-3', 'Quản lý bán hàng')
@section('st4', 'true')
@section('pg-hd-4', 'Danh mục xe máy') @section('act4', 'active')

<style>
    .table-container {
        max-height: 600px;
        overflow: auto;
    }
</style>

@section('main')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}

            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Thông tin đơn bán xe</h4>
                    </div>
                </div>
                <form action="" method="GET" id="ctformthumua">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Mã đơn thu mua</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $dtm->madkthumua }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Người bán</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="{{ $dtm->hovaten }}" disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ngày đăng ký</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control"
                                value="{{ date('d/m/Y', strtotime($dtm->ngaydk)) }}"
                                disabled />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Giá bán</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" name="bsx" value="{{ $dtm->giaban }}" maxlength="12">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Mô tả</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" rows="3" name="mt">{{ $dtm->mota }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ảnh</label>
                        <div class="col-sm-12 col-md-10">
                            <div class="table-container">
                                <table class="table">
                                    <tbody>
                                        @if ($dtm->hinhanh != '')
                                            @foreach (explode(',', $dtm->hinhanh) as $path)
                                                @php $index = array_search($path, explode(',', $dtm->hinhanh)) @endphp
                                                <tr>
                                                    <td>
                                                        <a href="">
                                                            <img src="{{ asset('storage/' . $path) }}" alt="Ảnh"
                                                                height="250" width="250">
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2 mx-3 my-3" 
                        name="duyetdon" formaction="{{ route('duyetdonthumua', ['id' => $dtm->madkthumua]) }}">Duyệt đơn</button>
                        <button type="submit" class="btn btn-danger me-md-2 mx-3 my-3"
                        formaction="{{ route('huydonthumua', ['id' => $dtm->madkthumua]) }}">Không duyệt</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
