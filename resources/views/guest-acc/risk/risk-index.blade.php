@extends('guest-acc.layout.content')

@section('title_ds', 'Quản lý bán xe')
@section('pg-hd-2', 'Quản lý bán xe')

@section('title')
    Hỗ trợ khách hàng
@endsection 
{{-- @include('guest-acc.layout.header') --}}
@section('guest-content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Hỡ trợ khách hàng</h4>
                    </div>
                    <div class="card-body">
                       <div class="container">
                        <p>Bạn cần trợ giúp điều gì ?</p>   
                            <form action="">
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="vd" class="label-form">Vấn đề liên quan đến</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <select name="vd" id="vd" class="form-select">
                                            <option selected disabled>Lựa chọn</option>
                                            <option value="1">Xe</option>
                                            <option value="2">Thanh toán</option>
                                            <option value="3">Tài khoản</option>
                                            <option value="4">Mua hàng</option>
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="tieude" class="label-form">Tiêu đề</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <input type="text" class="form-control" id="tieude" name="tieude"></input>    
                                    </div>    
                                </div>  
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label for="nd" class="label-form">Nội dung</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <textarea name="nd" id="nd" class="form-control" style="height: 200px"></textarea>    
                                    </div>    
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                    <button type="submit" class="btn btn-primary">Gửi đi</button>    
                                </div>   
                            </form>   
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 
