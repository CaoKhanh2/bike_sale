<div class="container bg-light py-3 my-3">
    <div class="row mb-3">
        <h2>Giỏ hàng</h2>
    </div>
    <div class="row mx-3">
        <div class="col-md-8">
            <table class="table table-hover border">
                <thead>
                    <tr>
                        <th></th>
                        <th>Thông tin sản phẩm</th>
                        <th style="width:10em">Đơn giá</th>
                        <th style="width:10em">Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="btn-decrease">-</button>
                                </div>

                                <input type="text" class="form-control text-center" id="quantity-input"
                                    value="1" aria-label="Quantity">

                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="btn-increase">+</button>
                                </div>
                            </div>

                        </td>
                        <td>100000</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="btn-decrease">-</button>
                                </div>

                                <input type="text" class="form-control text-center" id="quantity-input"
                                    value="1" aria-label="Quantity">

                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="btn-increase">+</button>
                                </div>
                            </div>
                        </td>
                        <td>@twitter</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Larry the Bird</td>
                        <td>@twitter</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="btn-decrease">-</button>
                                </div>

                                <input type="text" class="form-control text-center" id="quantity-input"
                                    value="1" aria-label="Quantity">

                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="btn-increase">+</button>
                                </div>
                            </div>
                        </td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
            <div class="col-md-8">
                <a href="{{ url('/')}}" class="btn btn-primary">Tiếp tục mua hàng</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row py-4 bg-white">
                <div class="col-3">
                    <p>Tổng tiền</p>
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
