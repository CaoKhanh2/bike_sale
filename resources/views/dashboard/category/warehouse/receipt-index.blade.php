@extends('dashboard.layout.content')

@section('title_ds', 'Xuất kho')
@section('pg-card-title', 'Phiếu xuất kho')
@section('pg-hd-2', 'Danh mục')
@section('pg-hd-3', 'Kho hàng')
@section('st4', 'true') @section('pg-hd-4', 'Nhập kho') @section('act4', 'active')

@section('main')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- Page Header --}}
                @include('dashboard.layout.page-header')
                {{-- End Page Header --}}
                
                @include('dashboard.category.warehouse.receipt-export.receipt.receipt-item')

            </div>
        </div>
    @endsection
