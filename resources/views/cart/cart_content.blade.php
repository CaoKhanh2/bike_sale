<div class="container bg-light py-3 my-3">
    <div class="row mb-3 ms-3">
        <h3>Giỏ hàng</h3>
    </div>
    <div class="row mx-3">
        <table class="table table-hover border border-2 align-middle">
            <thead>
                <tr>
                    <th>Thông tin sản phẩm</th>
                    <th style="width:10em">Đơn giá</th>
                    <th style="width:10em">Số lượng</th>
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="{{ asset('Image\Xe\\XeDien\Asama ebk\xe-dap-dien-asama-ebk-do.jpg') }}"
                        alt="Ảnh" width="120" height="120"> Mark
                    </td>
                    <td>Otto</td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" id="btn-decrease">-</button>
                            </div>

                            <input type="text" class="form-control text-center" id="quantity-input" value="1"
                                aria-label="Quantity">

                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btn-increase">+</button>
                            </div>
                        </div>
                    </td>
                    <td>100000</td>
                    <td>
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-8">
            <a href="{{ url('/') }}" class="btn btn-primary">Tiếp tục mua hàng</a>
        </div>

    </div>
    <div class="row mx-3">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <div class="row py-4 bg-white">
                <div class="col-3">
                    <p class="fw-bold">Tổng tiền</p>
                </div>
                <div class="col-9 text-end">
                    <p>1000000</p>
                </div>
            </div>
            <div class="mb-4">
                <input type="submit" value="Thanh toán" id="thanhtoan" class="btn-info btn col-12">
            </div>
        </div>
    </div>
</div>
</div>

</div>
