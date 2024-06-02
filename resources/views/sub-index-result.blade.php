@extends('layout.content')

@php
    $url = url()->current();
    $arr = explode('/', $url);
    $res = end($arr);

    $parsedUrl = parse_url($url);
    $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';

    // Define the prefix to check
    $prefix = '/sub-index/search';

    // Check if the path starts with the prefix
    $hasPrefix = substr($path, 0, strlen($prefix)) === $prefix;
@endphp

@foreach ($hangxe as $i)
    @if ($res == $i->mahx)
        @php
            $titleSubpage = $i->loaixe;
            $pgHd2 = $i->loaixe;
            $pgHd3 = $i->tenhang;
            $check = 'true';
            $act3 = 'text-dark';
        @endphp
    @elseif($hasPrefix)
        @php
            $titleSubpage = 'Xe';
            $pgHd2 = 'Kết quả tìm kiếm';
            $act2 = 'text-dark';
            $check = 'false';
        @endphp
    @endif
@endforeach

@section('title-subpage', $titleSubpage ?? 'Default Title')
@section('pg-hd-2', $pgHd2 ?? 'Default Title') @section('act2', $act2 ?? 'Default Class')
@section('pg-hd-3', $pgHd3 ?? 'Default Title') @section('act3', $act3 ?? 'Default Class') @section('st3', $check)


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
            @include('sub-page.list-archive-item-search')
        </div>

        <div class="row mt-4 mb-4">
            @include('sub-page.introduce')
        </div>

    </div>

@endsection
