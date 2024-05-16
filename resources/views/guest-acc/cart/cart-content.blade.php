<div class="container my-5">
    <div class="card shadow">
        {{-- @if ($gh->count() > 0) --}}
        <div class="card-body">
            @php $total = 0; @endphp    
            @foreach ($gh as $item)
                <div class="row product_data">
                    <div class="col-md-2 my-auto">
                        @foreach (explode(',', $item->hinhanh) as $path)
                            @if ($loop->first && $path != '')
                                <img src="{{ asset('storage/' . $path) }}" alt="Ảnh" height="200px" width="200px">
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-3 my-auto">
                        <h6 >{{ $item->tenxe }}</h6>
                    </div>
                    <div class="col-md-2 my-auto">
                        <h6>{{ number_format($item->giaban, 0, ',') . ' đ' }}</h6>
                    </div>
                    {{-- <div class="col-md-3 my-auto">
                        <input type="hidden" class="prod_id" value="">
                        @if ($item->products->qty >= $item->prod_qty)
                        <label for="Quantity">Quantity</label>
                        <div class="input-group text-center mb-3">
                            <button class="input-group-text changeQuantity decrement-btn">-</button>
                            <input type="text" name="quantity" value=""
                                class="form-control qty-input text-center">
                            <button class="input-group-text changeQuantity increment-btn">+</button>
                        </div>
                        @php $total += $item->products->selling_price * $item->prod_qty; @endphp
                            @else
                                <h6>Out of Stock</h6>
                            @endif
                    </div> --}}
                    <div class="col-md-2 my-auto">
                        <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i> Remove</button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <h6>
                Total Price:
                <a href="" class="btn btn-outline-success float-end">Proceed to Checkout</a>
            </h6>
        </div>
        {{-- @else 
            <div class="card-body text-center">
                <h2>Your <i class="fa fa-shopping-cart"> Cart is empty</i></h2>
                <a href="" class="btn btn-outline-primary float-end">Continue Shopping</a>
            </div>
        @endif --}}
    </div>
</div>



{{-- 
<div class="container bg-light py-3 my-3">
    <div class="row mb-3 ms-3">
        <h3>Giỏ hàng</h3>
    </div>
    <div class="row mx-3">
        <table class="table table-hover border border-2 align-middle">
            <thead class="text-center table-primary">
                <tr class="text-light">
                    <th>Sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>
                        <img src="{{ asset('Image\Xe\XeDien\Asama ebk\xe-dap-dien-asama-ebk-do.jpg') }}" alt="Ảnh" class="d-inline-block align-text-center"
                        width="140" height="120">
                    </td>
                    <td>Asama, ebk</td>
                    <td>1,000,000đ</td>
                    <td class="col-2">
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                            <input type="text" class="form-control text-center"
                                value="1" id="label" disabled>
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">+</button>
                        </div>
                    </td>
                    <td>1,000,000đ</td>
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
<script>

    const btn1 = document.getElementById("button-addon1");
    const btn2 = document.getElementById("button-addon2");
    const label = document.getElementById("label");

    let count = 1;

    btn1.onclick = function(){
        count--;
        if(count >= 0){
            label.value = count;
        }
        
    }

    btn2.onclick = function(){
        count++;
        label.value = count;
    }



</script>  --}}
