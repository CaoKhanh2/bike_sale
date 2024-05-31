@extends('layout.content')

@php
    $url = url()->current();
    $arr = explode('/', $url);
    $res = end($arr);
@endphp

@if ($res == 'motorbike')
    @section('title-subpage', 'Xe máy')
    @section('title', 'Xe máy')
    @section('pg-hd-2', 'Xe máy') @section('act2', 'text-dark')
@elseif($res == 'electric-bicycles')
    @section('title-subpage', 'Xe đạp điện')
    @section('title', 'Xe đạp điện')
    @section('pg-hd-2', 'Xe đạp điện') @section('act2', 'text-dark')
@endif


@section('main')

    <div class="container">

        <div class="row mt-4 mb-4">
            @include('sub-page.sub-searchbox')
        </div>

        <div class="row mt-4 mb-4">
            <h2>Mua bán @yield('title-subpage') giá rẻ</h2>
        </div>

        <div>
            @include('layout.header-breadcrum')
        </div>

        <div class="row mt-4 mb-4">
            @include('sub-page.box-list')
        </div>

        <div class="row mt-4 mb-4">
            {{-- Ảnh qc --}}
        </div>

        <div class="row mt-4 mb-4">
            @include('sub-page.list-archive-item')
        </div>

        <div class="row mt-4 mb-4">
            @include('sub-page.introduce')
        </div>

    </div>

@endsection
