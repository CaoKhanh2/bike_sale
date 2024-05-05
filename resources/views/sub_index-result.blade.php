@extends('layout.content')

@php
    $url = url()->current();
    $arr = explode('/', $url);
    $res = end($arr);
@endphp

@if ($res == 'xemay')
    @section('title-subpage', 'Xe máy')
@elseif($res == 'xedapdien')
    @section('title-subpage', 'Xe đạp điện')
@endif

@section('main')

    <div class="container">

        <div class="row mt-4 mb-4">
            @include('sub_page.sub_searchbox')
        </div>

        <div class="row mt-4 mb-4">
            <h2>Mua bán @yield('title-subpage') giá rẻ</h2>
        </div>

        <div class="row mt-4 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title-subpage')</li>
                </ol>
            </nav>
        </div>

        <div class="row mt-4 mb-4">
            @include('sub_page.box_list')
        </div>

        <div class="row mt-4 mb-4">
            {{-- Ảnh qc --}}
        </div>

        <div class="row mt-4 mb-4">
            @include('sub_page.list_archive_item_search')
        </div>

        <div class="row mt-4 mb-4">
            @include('sub_page.introduce')
        </div>

    </div>
    
@endsection
