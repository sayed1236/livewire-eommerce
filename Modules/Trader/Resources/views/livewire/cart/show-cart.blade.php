<main class="main cart">
		
    <nav class="breadcrumb-nav">
<div class="container">
<h2>Shopping Cart</h2>
<ul class="breadcrumb bb-no">
<li class="active"><a href="cart.html">Shopping Cart</a></li>
<li><a href="checkout.html">Checkout</a></li>
<li><a href="order.html">Order Complete</a></li>
</ul>
</div>
</nav>
<!-- End of Breadcrumb -->


<!-- Start of PageContent -->
<div class="page-content">
<div class="container">
<div class="row gutter-lg mb-10">
<div class="col-lg-8 pr-lg-4 mb-6">
    <table class="shop-table cart-table">
        <thead>
            <tr>
                <th class="product-name"><span>Product</span></th>
                <th></th>
                <th class="product-price"><span>Price</span></th>
                <th class="product-quantity"><span>Quantity</span></th>
                <th class="product-subtotal"><span>Subtotal</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($carts as $cart)
            <tr>
                <td class="product-thumbnail">
                    <div class="p-relative">
                        <a style="cursor:pointer" wire:click="showproduct({{ $cart->id}})">
                            <figure>
                                <img src="{{ img_chk_exist($cart->attributes->img) }}" alt="product"
                                    width="300" height="338">
                            </figure>
                        </a>
                        <button type="submit" wire:click="delete_prod({{ $cart->id }})" class="btn btn-close"><i
                                class="fas fa-times"></i></button>
                    </div>
                </td>
                <td class="product-name">
                    <a style="cursor:pointer" wire:click="showproduct({{ $cart->id}})">
                        {{ $cart->name }}
                    </a>
                </td>
                <td class="product-price"><span class="amount">${{ $cart->price }}</span></td>
                <td class="product-quantity">
                    <div class="input-group">
                        <input class="quantity form-control" type="number" wire:model.live="quantity.{{ $cart->id }}" placeholder="{{ $cart->quantity }}" min="1" max="100000">
                        {{--  <button class="quantity-plus w-icon-plus" wire:click="increase({{ $cart->id }})"> </button>
                        <button class="quantity-minus w-icon-minus"></button>  --}}
                    </div>
                </td>
              
                <td class="product-subtotal">
                  
            @if(isset($quantity[$cart->id]))
                    @php
                    $productStockDiscount = App\Models\ProductStockDiscount::where('product_id', $cart->id)->first();
                    $productStock = App\Models\Productsstock::where('product_id', $cart->id)->first();
                    @endphp
                @if(!$show_amount)
                <button class="btn btn-danger" wire:click="check_amount">check</button>
                @else
                    @if($productStock->quantity >= $quantity[$cart->id])
                        <span class="amount">${{ $cart->price * (
                            (isset($quantity[$cart->id]) && floatval($quantity[$cart->id]) > 0 ? floatval($quantity[$cart->id]) : $cart->quantity) *
                            (isset($quantity[$cart->id]) && $productStockDiscount ?
                                ($quantity[$cart->id] >= $productStockDiscount->quantity_from && $quantity[$cart->id] <= $productStockDiscount->quantity_to ?
                                    (1 - $productStockDiscount->discount_percent / 100)
                                    : 1)
                                : 1)
                        ) }}</span>
                        @elseif($productStock->quantity <= $quantity[$cart->id])
                        <p>these amount unavailable</p>
                        @else
                        {{ $quantity[$cart->id] * $cart->price }}
                    @endif
                @endif
            @else
            ${{ $cart->quantity * $cart->price }}    
            @endif
                
                    
                    
                </td>

                @if(isset($quantity[$cart->id]) && $productStockDiscount)
                @if($quantity[$cart->id] >= $productStockDiscount->quantity_from && $quantity[$cart->id] <= $productStockDiscount->quantity_to)
                <div class="alert alert-icon alert-success alert-bg alert-inline ">
                    <h4 class="alert-title">
                        <i class="fas fa-check"></i>{{ $productStockDiscount->discount_percent }}%!</h4> in subtotal already discount...
                </div>
                @endif
                @endif

            </tr>

            @empty
            <tr>
                <td colspan="5">
                    <p style="color: black; text-align: center; font-size: 18px; font-weight: bold; padding: 10px; background-color: #f6be00;">No product added</p>
                </td>
            </tr>
           @endforelse
        </tbody>
    </table>

    <div class="cart-action mb-6">
        <a href="#" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
        <button type="submit" class="btn btn-rounded btn-default btn-clear" wire:click="clear_cart" value="Clear Cart">Clear Cart</button> 
        <button type="submit" class="btn btn-rounded btn-update " wire:click="update_cart" value="Update Cart">Update Cart</button>
    </div>

    <form class="coupon" wire:submit="addcoupon">
        <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
        <input type="text" class="form-control mb-4" wire:model="coupon" placeholder="Enter coupon code here..."  />
        <button class="btn btn-dark btn-outline btn-rounded">Apply Coupon</button>
      @error('coupon')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </form>
</div>
<div class="col-lg-4 sticky-sidebar-wrapper" >
    <div class="sticky-sidebar" >
        <div class="cart-summary mb-4" >
            <h3 class="cart-title text-uppercase">Cart Totals</h3>
            <div class="cart-subtotal d-flex align-items-center justify-content-between">
                <label class="ls-25">Subtotal</label>
                <span>${{ \Cart::getTotal() }}</span>
            </div>

            <hr class="divider">

            {{--  <ul class="shipping-methods mb-2">
                <li>
                    <label
                        class="shipping-title text-dark font-weight-bold">Shipping</label>
                </li>
                <li>
                    <div class="custom-radio">
                        <input type="radio" id="free-shipping" class="custom-control-input"
                            name="shipping">
                        <label for="free-shipping"
                            class="custom-control-label color-dark">Free
                            Shipping</label>
                    </div>
                </li>
                <li>
                    <div class="custom-radio">
                        <input type="radio" id="local-pickup" class="custom-control-input"
                            name="shipping">
                        <label for="local-pickup"
                            class="custom-control-label color-dark">Local
                            Pickup</label>
                    </div>
                </li>
                <li>
                    <div class="custom-radio">
                        <input type="radio" id="flat-rate" class="custom-control-input"
                            name="shipping">
                        <label for="flat-rate" class="custom-control-label color-dark">Flat
                            rate:
                            $5.00</label>
                    </div>
                </li>
            </ul>  --}}

            <div class="shipping-calculator">
                <p class="shipping-destination lh-1">Shipping to <strong>CA</strong>.</p>

                <form class="shipping-calculator-form">
                    <div class="form-group">
                        <div class="select-box">
                            <select name="country" class="form-control form-control-md" style="height:30px">
                                <option value="default" selected="selected">United States
                                    (US)
                                </option>
                                <option value="us">United States</option>
                                <option value="uk">United Kingdom</option>
                                <option value="fr">France</option>
                                <option value="aus">Australia</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="select-box">
                            <select name="state" class="form-control form-control-md" style="height:30px">
                                <option value="default" selected="selected">California
                                </option>
                                <option value="ohaio">Ohaio</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-md" type="text"
                            name="town-city" placeholder="Town / City">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-md" type="text"
                            name="zipcode" placeholder="ZIP">
                    </div>
                    <button type="submit" class="btn btn-dark btn-outline btn-rounded">Update
                        Totals</button>
                </form>
            </div>

            <hr class="divider mb-6">
            <div class="order-total d-flex justify-content-between align-items-center">
                <label>Total</label>
                <span class="ls-50">$100.00</span>
            </div>
            <a href="{{ route('trader.checkout') }}"
                class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End of PageContent -->
</main>