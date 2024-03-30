@extends('layout.content')
@section('title', '')

@section('main')

    <div class="container">

        <div class="row mt-4 mb-4">
            @include('sub-page.sub-searchbox')
        </div>

        <div class="row mt-4 mb-4">
            <h2>Mua bán xe @yield('title-subpage') giá rẻ</h2>
        </div>

        <div class="row mt-4 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Xe Máy</li>
                </ol>
            </nav>
        </div>

        <div class="row mt-4 mb-4">
            @include('sub-page.box-list')
        </div>

        <div class="row mt-4 mb-4">
            
        </div>

        <div class="row mt-4 mb-4">
            @include('sub-page.list-archive-item')
        </div>

    </div>


@endsection
