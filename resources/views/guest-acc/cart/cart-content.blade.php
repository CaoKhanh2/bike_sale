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
                            @endif --}}
                        </div>
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

