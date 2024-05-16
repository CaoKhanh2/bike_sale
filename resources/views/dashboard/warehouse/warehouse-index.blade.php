@extends('dashboard.layout.content')
@section('title_ds', 'Quản lý kho hàng')
@section('pg-card-title', 'Chi tiết tin mua')
@section('pg-hd-2', 'Giao dịch')
@section('pg-hd-3', 'Quản lý bán hàng')
@section('st4', 'true')
@section('pg-hd-4', 'Danh mục xe máy') @section('act4', 'active')


@section('main')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            {{-- Page Header --}}
            @include('dashboard.layout.page-header')
            {{-- End Page Header --}}

            <!-- Export Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-10">
                    <h4 class="text-blue h4"></h4>
                </div>
            </div>
            <!-- Export Datatable End -->
        </div>

    </div>
</div>
@endsection