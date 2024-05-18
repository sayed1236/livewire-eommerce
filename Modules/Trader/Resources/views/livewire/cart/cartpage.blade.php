<main class="main cart">




    <nav class="breadcrumb-nav">
        <div class="container">
            <h2>Order</h2>

            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Order</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->


    <div class="container">
        <div class="indes-content">
            <div class="bg-smoke">



                <div class="sao-carts my-5">
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item flex-fill as-done" role="presentation" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Step 1">
                            <a wire:click="show_cart"
                                class="nav-link   mx-auto d-flex align-items-center justify-content-center @if($cart) active @endif"
                                id="step1-tab" style="cursor: pointer;">
                                <div class="sp-num">1</div>
                                <strong>Cart</strong>
                            </a>
                        </li>
                        <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Step 2">
                            <a wire:click="show_checkout"
                                class="nav-link  mx-auto d-flex align-items-center justify-content-center @if($checkout) active @endif"
                                style="cursor: pointer;" id="step2-tab">
                                <div class="sp-num">2</div>
                                <strong>Billing Info</strong>
                            </a>
                        </li>
                        <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Step 3">
                            <a wire:click="show_payment"
                                class="nav-link  mx-auto d-flex align-items-center justify-content-center @if($payment) active @endif"
                                style="cursor: pointer;" id="step3-tab">
                                <div class="sp-num">3</div>
                                <strong>payments methods</strong>
                            </a>
                        </li>
                        <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Step 4">
                            <a wire:click="show_finish"
                                class="nav-link  mx-auto d-flex align-items-center justify-content-center @if($finish) active @endif"
                                style="cursor: pointer;" id="step4-tab" role="tab">
                                <div class="sp-num">4</div>
                                <strong>Finish</strong>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show @if($cart) active @endif">

                            <div class="form-card">


                                <div class="indes-content">
                                    <div class="">
                                        <div class="appointment-form-wrap">

                                            <div class="da-head">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h4>Cart</h4>
                                                    </div>
                                                    <div class="col-5">
                                                        <h2 class="steps">Step 1 - 4</h2>
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="row gutter-lg mb-4">
                                                <div class="col-lg-8 pr-lg-4">
                                                    <table class="shop-table cart-table">
                                                        <thead>
                                                            <tr>
                                                                <th>img</th>
                                                                <th class="product-name"><span>Product</span>
                                                                </th>
                                                                <th class="product-price"><span>Price</span>
                                                                </th>
                                                                <th class="product-quantity">
                                                                    <span>Quantity</span>
                                                                </th>
                                                                <th class="product-subtotal">
                                                                    <span>Subtotal</span>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                            @php $total =0;@endphp
                                                            @if(isset($trader_orders))
                                                            @foreach ($trader_orders as $order )
                                                            <tr>
                                                                <td class="product-thumbnail">
                                                                    <div class="p-relative">
                                                                        <a wire:click="showproduct({{ @$order->product->id }})"
                                                                            style="cursor:pointer">
                                                                            <figure>
                                                                                <img src="{{ img_chk_exist(@$order->product->img) }}"
                                                                                    alt="product" width="300"
                                                                                    height="338" style="height:170px">
                                                                            </figure>
                                                                        </a>
                                                                        <button type="submit"
                                                                            wire:click="delete_prod({{ @$order->id }})"
                                                                            class="btn btn-close"><i
                                                                                class="fas fa-times"></i></button>
                                                                    </div>
                                                                </td>
                                                                <td class="product-name">
                                                                    <a wire:click="showproduct({{ @$order->product->id }})"
                                                                        style="cursor:pointer">
                                                                        {{ @$order->product->name }}
                                                                    </a>
                                                                </td>
                                                                <td class="product-price"><span class="amount">${{
                                                                        @$order->product->latestProductStock->selling_price
                                                                        }}</span></td>
                                                                <td class="product-quantity">
                                                                    <div class="input-group">
                                                                        <input class="quantity form-control defin_value"
                                                                            type="number"
                                                                            value="{{  @$order->quantity }}"
                                                                            wire:change="add_count({{ @$order->id }})"
                                                                            min="1" max="100000">
                                                                        <button class="quantity-plus w-icon-plus"
                                                                            wire:click="plus({{ @$order->id }})"></button>
                                                                        <button class="quantity-minus w-icon-minus"
                                                                            wire:click="minus({{ @$order->id }})"></button>
                                                                    </div>
                                                                </td>
                                                                @php
                                                                $discount = 0; // Default value

                                                                if ($order->product->discounts_product->isNotEmpty()) {
                                                                foreach ($order->product->discounts_product as
                                                                $productDiscount) {
                                                                if ($order->quantity >= $productDiscount->quantity_from
                                                                &&
                                                                $order->quantity <= $productDiscount->quantity_to) {
                                                                    $discount = $order->total_price *
                                                                    ($productDiscount->discount_percent / 100);
                                                                    break; // Exit the loop once a discount is found
                                                                    }
                                                                    }
                                                                    }

                                                                    $total += $order->total_price - $discount;
                                                                    @endphp


                                                                    <td class="product-subtotal">
                                                                        @if($order->product->latestProductStock->quantity
                                                                        <= $order->quantity )

                                                                            <span class="amount"
                                                                                style="text-decoration: line-through; color:red ">
                                                                                ${{
                                                                                number_format(floatval($order->total_price)
                                                                                * (isset($quant) && $quant >
                                                                                0 ? floatval($quant) : 1), 1) }}
                                                                            </span>
                                                                            @else
                                                                            <span class="amount">
                                                                                ${{
                                                                                number_format(floatval($order->total_price)
                                                                                * (isset($quant) && $quant >
                                                                                0 ? floatval($quant) : 1), 1) }}
                                                                            </span>
                                                                            @endif




                                                                    </td>
                                                            </tr>
                                                            @if($order->product->discounts_product->isNotEmpty())
                                                            @foreach($order->product->discounts_product as $discount)
                                                            @if($discount->quantity_from <= $order->quantity &&
                                                                $order->quantity <= $discount->quantity_to)
                                                                    <tr>
                                                                        <td colspan="5">
                                                                            <div class="alert alert-success"
                                                                                role="alert">
                                                                                <p
                                                                                    style="color: black; text-align: center; font-size: 18px; font-weight: bold; padding: 10px; background-color: #f6be00;">
                                                                                    Discount for this quantity is {{
                                                                                    $discount->discount_percent }}...
                                                                                </p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach
                                                                    @endif


                                                                    @if($order->product->latestProductStock->quantity <=
                                                                        $order->quantity )
                                                                        <tr>
                                                                            <td colspan="5">
                                                                                <div class="alert alert-success"
                                                                                    role="alert">
                                                                                    <p
                                                                                        style="color: black; text-align: center; font-size: 18px; font-weight: bold; padding: 10px; background-color: #f6be00;">
                                                                                        these amount not found </p>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if(@$order->product->min_amount_to_buy >=
                                                                        @$order->quantity )
                                                                        <tr>
                                                                            <td colspan="5">
                                                                                <div class="alert alert-success"
                                                                                    role="alert">
                                                                                    <p
                                                                                        style="color: black; text-align: center; font-size: 18px; font-weight: bold; padding: 10px; background-color: #f6be00;">
                                                                                        at least {{
                                                                                        @$order->product->min_amount_to_buy
                                                                                        }} to buy </p>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                        @endforeach
                                                                        @endif

                                                        </tbody>
                                                    </table>

                                                    <div class="cart-action">
                                                        <a href="{{ route('trader.newarrival') }}"
                                                            class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                                                class="w-icon-long-arrow-left"></i>Continue
                                                            Shopping</a>
                                                        <button type="submit"
                                                            class="btn btn-rounded btn-default btn-clear"
                                                            name="clear_cart" wire:click="clear_cart"
                                                            value="Clear Cart">Clear
                                                            Cart</button>

                                                    </div>

                                                </div>
                                                <div class="col-lg-4 ">
                                                    <div class="stbar">
                                                        <div class="cart-summary mb-4" wire:poll>
                                                            <h4 class="title">Cart Totals</h4>









                                                            <hr class="divider mb-6">




                                                            <div
                                                                class="order-total d-flex justify-content-between align-items-center">
                                                                <label>Total</label>
                                                                <span class="ls-50">${{ @$total }}</span>
                                                            </div>
                                                            @if(count($trader_orders)>0)
                                                            <a wire:click="show_checkout" style="cursor:pointer"
                                                                class="btn btn-block btn-dark btn-icon-right btn-rounded btn btn-info next link-to-tab btn-checkout">
                                                                Proceed to Billing Info<i
                                                                    class="w-icon-long-arrow-right"></i></a>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- <div class="d-flex justify-content-end">
                                                <a class="btn btn-info next link-to-tab">Next</a>
                                            </div> --}}


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade @if($checkout) active @endif">

                            <div class="appointment-form-wrap">



                                <div class="da-head">
                                    <div class="row">
                                        <div class="col-7">
                                            <h4>Billing Info</h4>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 2 - 4</h2>
                                        </div>
                                    </div>
                                </div>




                                <form class="form checkout-form">






                                    <div class="row mb-9">
                                        <div class="col-lg-7 pr-lg-4 mb-4">
                                            <div class="stbar">

                                                <div class="form-group">
                                                    <label for="email">Email *</label>
                                                    <input type="text" placeholder="Enter your email"
                                                        class="form-control form-control-md mb-2 @error('email') is-invalid @enderror"
                                                        wire:model="email">

                                                    @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>





                                                <div class="form-group">
                                                    <label>Country / Region *</label>
                                                    <div class="select-box">
                                                        <select wire:model.live='country_id'
                                                            class="form-control form-control-md">
                                                            @isset($countries)
                                                            <option value="" @if (empty($country_id)) selected @endif>
                                                                Select Country</option>
                                                            @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}" @if($country->id ==
                                                                $country_id) selected @endif>
                                                                {{ $country->name }}
                                                            </option>
                                                            @endforeach
                                                            @endisset
                                                        </select>



                                                        </select>
                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label>State *</label>
                                                    <div class="select-box">
                                                        <select wire:model.live="state"
                                                            class="form-control form-control-md">
                                                            <option value="">Select state</option>

                                                            @isset($states)
                                                            @foreach ($states as $state)
                                                            <option value="{{ $state->name }}" class="option">{{
                                                                $state->name }}</option>
                                                            @endforeach
                                                            @endisset
                                                        </select>
                                                        @error('state')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="row gutter-sm">
                                                    <div class="col-md-6">


                                                        <div class="form-group">
                                                            <label>postal_code *</label>
                                                            <input type="text" class="form-control form-control-md"
                                                                wire:model="postal_code">
                                                            @error('postal_code')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone *</label>
                                                            <input type="text" class="form-control form-control-md"
                                                                placeholder=" phone " wire:model="mobile">
                                                            @error('mobile')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address *</label>
                                                        <input type="text" placeholder="enter your address "
                                                            class="form-control form-control-md mb-2"
                                                            wire:model="address">
                                                        @error('address')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Street address *</label>
                                                        <input type="text" placeholder="enter your street "
                                                            class="form-control form-control-md mb-2"
                                                            wire:model="street">
                                                        @error('street')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="order-notes">Order notes (optional)</label>
                                                    <textarea class="form-control mb-0" id="order-notes"
                                                        wire:model="notes" cols="30" rows="4"
                                                        placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                                                    @error('notes')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 mb-4">
                                            <div class="stbar">
                                                <div class="order-summary-wrapper">
                                                    <h3 class="title">Your Order</h3>
                                                    <div class="order-summary" wire:poll>

                                                        <table class="order-table">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="3">
                                                                        <b>Product</b>
                                                                    </th>
                                                                    <th colspan="1">
                                                                        <b>Discount</b>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                $total = 0;
                                                                @endphp

                                                                @if(isset($trader_orders))
                                                                @foreach ($trader_orders as $order)
                                                                @if($order->product->min_amount_to_buy <= $order->
                                                                    quantity &&
                                                                    $order->product->latestProductStock->quantity >
                                                                    $order->quantity)
                                                                    @php
                                                                    $discount = 0; // Default value

                                                                    if
                                                                    ($order->product->discounts_product->isNotEmpty()) {
                                                                    foreach ($order->product->discounts_product as
                                                                    $productDiscount) {
                                                                    if ($order->quantity >=
                                                                    $productDiscount->quantity_from && $order->quantity
                                                                    <= $productDiscount->quantity_to) {
                                                                        $discount = $order->total_price *
                                                                        ($productDiscount->discount_percent / 100);
                                                                        break; // Exit the loop once a discount is found
                                                                        }
                                                                        }
                                                                        }

                                                                        $orderTotal = $order->total_price - $discount;
                                                                        $total += $orderTotal;
                                                                        @endphp

                                                                        <tr class="bb-no">
                                                                            <td class="product-thumbnail">
                                                                                <div class="p-relative">
                                                                                    <a href="">
                                                                                        <figure>
                                                                                            <img src="{{ img_chk_exist($order->product->img) }}"
                                                                                                alt="product"
                                                                                                width="300"
                                                                                                height="338">
                                                                                        </figure>
                                                                                    </a>
                                                                                </div>
                                                                            </td>

                                                                            <td class="product-name">
                                                                                {{ $order->product->name }}
                                                                                <i class="fas fa-times"></i> <span
                                                                                    class="product-quantity">{{
                                                                                    $order->quantity }}</span>
                                                                            </td>
                                                                            <td class="product-total">${{ $orderTotal }}
                                                                            </td>

                                                                            @if($order->product->discounts_product->isNotEmpty())
                                                                            @foreach($order->product->discounts_product
                                                                            as $discount)
                                                                            @if($discount->quantity_from <= $order->
                                                                                quantity && $order->quantity <=
                                                                                    $discount->quantity_to)
                                                                                    <td>
                                                                                        %{{ $discount->discount_percent
                                                                                        }}
                                                                                    </td>
                                                                                    @endif
                                                                                    @endforeach
                                                                                    @endif

                                                                        </tr>
                                                                        @endif
                                                                        @endforeach
                                                                        @endif

                                                                        <tr class="cart-subtotal bb-no">

                                                                            <td colspan="2">
                                                                                <b>Subtotal</b>
                                                                            </td>
                                                                            <td colspan="2">
                                                                                <b>${{ @$total }} </b>
                                                                            </td>
                                                                        </tr>


                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="shipping-methods">
                                                                    <td colspan="4" class="text-left">
                                                                        <h4 class="title">Cart Totals</h4>


                                                                        <form class="coupon">

                                                                            <label class="ls-25">Coupon Discount</label>
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Enter coupon code here..."
                                                                                    wire:model.live="coupon">

                                                                                <a wire:click="discountcoupon"
                                                                                    class="btn btn-dark btn-rounded">Apply</a>
                                                                                {{ $error_coupon }}
                                                                            </div>
                                                                            @error('coupon')
                                                                            <div class="alert alert-danger">{{ $message
                                                                                }}</div>
                                                                            @enderror

                                                                        </form>
                                                                        <hr class="divider mb-6">


                                                                        <div
                                                                            class="order-total d-flex justify-content-between align-items-center">
                                                                            <label>Discount coupon</label>
                                                                            @if(@$coupon_discount)
                                                                            <span class="ls-50">%{{ @$coupon_discount
                                                                                }}</span>

                                                                            <a class="btn btn-primary"
                                                                                wire:click="delete_coupon">delete</a>
                                                                            @endif
                                                                        </div>

                                                                        {{-- <p class="alert alert-danger">
                                                                            Sorry, you are not apply this promotional
                                                                            code.
                                                                        </p>

                                                                        <p class="alert alert-success">
                                                                            accept promotional code.
                                                                        </p> --}}









                                                                    </td>
                                                                </tr>

                                                                <tr class="order-total">
                                                                    <th colspan="1">
                                                                        <b>Total</b>
                                                                    </th>
                                                                    <td colspan="3">
                                                                        @php
                                                                        $totalaftercoupon=0;
                                                                        $totalaftercoupon = $total - ($total *
                                                                        (@$coupon_discount / 100));
                                                                        @endphp
                                                                        @if($coupon_discount)
                                                                        <span style="text-decoration: line-through">${{
                                                                            @$total }}</span>
                                                                        <b>
                                                                            ${{ isset($totalaftercoupon) ?
                                                                            $totalaftercoupon : $total }}
                                                                        </b>
                                                                        @else
                                                                        <b>
                                                                            ${{ @$total }}
                                                                        </b>
                                                                        @endif

                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>


                                                        <div class="form-group place-order pt-6">
                                                            <button type="submit" wire:click.prevent="show_payment"
                                                                class="btn btn-dark btn-block btn-rounded">Place
                                                                Order</button>
                                                            {{ @$comcheckout }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="d-flex justify-content-between">
                                    <a href="show_checkout" class="btn btn-dark previous link-to-tab"> Back</a>
                                    <a wire:click="show_payment" class="btn btn-info next link-to-tab">Next</a>
                                </div>

                            </div>
                        </div>



                        <div class="tab-pane fade @if($payment) active @endif">

                            <div class="appointment-form-wrap">


                                <div class="da-head">
                                    <div class="row">
                                        <div class="col-7">
                                            <h4>payments methods</h4>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 3 - 4</h2>
                                        </div>
                                    </div>
                                </div>








                                <div class="main-back">
                                    <div class="container m-auto bg-white p-5 bod-3">
                                        <div class="row">
                                            <!-- CARD FORM -->
                                            <div class="col-lg-8 col-md-12">
                                                <form>
                                                    <div class="header flex-between flex-vertical-center">
                                                        <div class="flex-vertical-center">
                                                            <i class="fal fa-money size-xl pr-sm f-main-color"></i>
                                                            <span class="title">
                                                                payments methods
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-data flex-fill flex-vertical">
                                                        <!-- Card Number -->





                                                        <div class="information_module payment_options">
                                                            <div class="toggle_title">
                                                                <h4>Select Payment Method</h4>
                                                            </div>

                                                            <ul>
                                                                <li>
                                                                    <div class="custom-radio">
                                                                        <input type="radio" id="opt1" class=""
                                                                            name="filter_opt">
                                                                        <label for="opt1">
                                                                            <span class="circle"></span>Cash On
                                                                            delivery</label>
                                                                    </div>
                                                                    {{-- <img src="{{ url('site/images/cards.png') }}"
                                                                        alt="Visa Cards"> --}}
                                                                </li>

                                                                <li>
                                                                    <div class="custom-radio">
                                                                        <input type="radio" id="opt2" class="" disabled
                                                                            name="filter_opt">
                                                                        <label for="opt2">
                                                                            <span
                                                                                class="circle"></span>Master/card</label>
                                                                    </div>
                                                                    {{-- <img src="{{ url('site/paypal.png') }}"
                                                                        alt="Visa Cards"> --}}
                                                                </li>


                                                            </ul>
                                                        </div>


                                                        <div class="flex-between flex-vertical-center">
                                                            <div class="card-property-title">
                                                                <strong>Card Number</strong>
                                                                <span>Enter 16-digit card number on the
                                                                    card</span>
                                                            </div>
                                                        </div>




                                                        <!-- Card Field -->
                                                        <div class="flex-between">
                                                            <div class="card-number flex-vertical-center flex-fill">
                                                                <div
                                                                    class="card-number-field flex-vertical-center flex-fill">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 48 48" width="24px" height="24px">
                                                                        <path fill="#ff9800"
                                                                            d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z" />
                                                                        <path fill="#d50000"
                                                                            d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z" />
                                                                        <path fill="#ff3d00"
                                                                            d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z" />
                                                                    </svg>
                                                                    <input type="text" placeholder="Card Number"
                                                                        disabled class="form-control" id="cardNumber"
                                                                        onkeypress="return onlyNumberKey(event)"
                                                                        maxlength="19" name="cardNumber"
                                                                        data-bound="carddigits_mock"
                                                                        data-def="0000 0000 0000 0000" required />
                                                                </div>
                                                                <i class="fal fa-check-circle size-lg f-main-color"></i>
                                                            </div>
                                                        </div>

                                                        <!-- Expiry Date -->
                                                        <div class="flex-between">
                                                            <div class="card-property-title">
                                                                <strong>Expiry Date</strong>
                                                                <span>Enter the expiration date of the
                                                                    card</span>
                                                            </div>
                                                            <div class="card-property-value flex-vertical-center">
                                                                <div class="input-container half-width">
                                                                    <input disabled class="numbers month-own"
                                                                        data-def="00" type="text" data-bound="mm_mock"
                                                                        placeholder="MM" />
                                                                </div>
                                                                <span class="m-md">/</span>
                                                                <div class="input-container half-width">
                                                                    <input disabled class="numbers year-own"
                                                                        data-def="01" type="text" data-bound="yy_mock"
                                                                        placeholder="YYYY" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- CCV Number -->
                                                        <div class="flex-between">
                                                            <div class="card-property-title">
                                                                <strong>CVC Number</strong>
                                                                <span>Enter card verification code from the back
                                                                    of the
                                                                    card</span>
                                                            </div>
                                                            <div class="card-property-value">
                                                                <div class="input-container">
                                                                    <input id="cvc" disabled placeholder="Card CVV"
                                                                        maxlength="3"
                                                                        onkeypress="return onlyNumberKey(event)"
                                                                        type="password" />
                                                                    <i id="cvc_toggler" data-target="cvc"
                                                                        class="fal fa-eye pointer"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Name -->
                                                        <div class="flex-between">
                                                            <div class="card-property-title">
                                                                <strong>Cardholder Name</strong>
                                                                <span>Enter cardholder name</span>
                                                            </div>
                                                            <div class="card-property-value">
                                                                <div class="input-container">
                                                                    <input disabled id="name" data-bound="name_mock"
                                                                        data-def="Mr. Cardholder" type="text"
                                                                        class="uppercase"
                                                                        placeholder="CARDHOLDER NAME" />
                                                                    <i class="fal fa-user"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-between">
                                                            <div class="card-property-title">
                                                                <strong>Mobile No.</strong>
                                                                <span>Enter Mobile No.</span>
                                                            </div>
                                                            <div class="card-property-value">
                                                                <div class="input-container">
                                                                    <input disabled id="phone" type="text"
                                                                        placeholder="Your Mobile No." />
                                                                    <i class="fal fa-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="action flex-center">
                                                        <button type="submit" class="b-main-color pointer">
                                                            Pay Now
                                                        </button>
                                                    </div> --}}
                                                </form>
                                            </div>

                                            <!-- SIDEBAR -->
                                            <div class="col-lg-4 col-md-12 py-5">
                                                <div></div>
                                                <div class="purchase-section flex-fill flex-vertical">
                                                    <div class="card-mockup flex-vertical">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                                            width="40px" height="40px">
                                                            <path fill="#ff9800"
                                                                d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z" />
                                                            <path fill="#d50000"
                                                                d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z" />
                                                            <path fill="#ff3d00"
                                                                d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z" />
                                                        </svg>
                                                        <div>
                                                            <strong>
                                                                <div id="name_mock"
                                                                    class="size-md pb-sm uppercase ellipsis">
                                                                    mr. Cardholder
                                                                </div>
                                                            </strong>
                                                            <div class="size-md pb-md">
                                                                <strong>
                                                                    <span id="carddigits_mock">0000 0000 0000
                                                                        0000</span>
                                                                </strong>
                                                            </div>
                                                            <div class="flex-between flex-vertical-center">
                                                                <strong class="size-md">
                                                                    <span>Expiry Date : </span><span
                                                                        id="mm_mock">00</span> / <span
                                                                        id="yy_mock">00</span>
                                                                </strong>

                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 48 48" width="40px" height="40px">
                                                                    <path fill="#1565C0"
                                                                        d="M45,35c0,2.209-1.791,4-4,4H7c-2.209,0-4-1.791-4-4V13c0-2.209,1.791-4,4-4h34c2.209,0,4,1.791,4,4V35z" />
                                                                    <path fill="#FFF"
                                                                        d="M15.186 19l-2.626 7.832c0 0-.667-3.313-.733-3.729-1.495-3.411-3.701-3.221-3.701-3.221L10.726 30v-.002h3.161L18.258 19H15.186zM17.689 30L20.56 30 22.296 19 19.389 19zM38.008 19h-3.021l-4.71 11h2.852l.588-1.571h3.596L37.619 30h2.613L38.008 19zM34.513 26.328l1.563-4.157.818 4.157H34.513zM26.369 22.206c0-.606.498-1.057 1.926-1.057.928 0 1.991.674 1.991.674l.466-2.309c0 0-1.358-.515-2.691-.515-3.019 0-4.576 1.444-4.576 3.272 0 3.306 3.979 2.853 3.979 4.551 0 .291-.231.964-1.888.964-1.662 0-2.759-.609-2.759-.609l-.495 2.216c0 0 1.063.606 3.117.606 2.059 0 4.915-1.54 4.915-3.752C30.354 23.586 26.369 23.394 26.369 22.206z" />
                                                                    <path fill="#FFC107"
                                                                        d="M12.212,24.945l-0.966-4.748c0,0-0.437-1.029-1.573-1.029c-1.136,0-4.44,0-4.44,0S10.894,20.84,12.212,24.945z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <ul class="purchase-props">


                                                        <li class="flex-between">
                                                            <span>Numers Item</span>
                                                            <strong>4</strong>
                                                        </li>


                                                        <li class="flex-between">
                                                            <span>Company</span>
                                                            <strong>Apple</strong>
                                                        </li>
                                                        <li class="flex-between">
                                                            <span>Order number</span>
                                                            <strong>429252965</strong>
                                                        </li>
                                                        <li class="flex-between">
                                                            <span>VAT (20%)</span>
                                                            <strong>$100.00</strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="separation-line"></div>
                                                <div class="total-section flex-between flex-vertical-center">
                                                    <div class="flex-fill flex-vertical">
                                                        <div class="total-label f-secondary-color">You have to
                                                            Pay</div>
                                                        <div>
                                                            <strong>549</strong>
                                                            <small>.99 <span
                                                                    class="f-secondary-color">USD</span></small>
                                                        </div>
                                                    </div>
                                                    <i class="fal fa-coins size-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- partial -->


                                <div class="d-flex justify-content-between">
                                    <a href="show_checkout" class="btn btn-dark previous link-to-tab"> Back</a>
                                    {{-- <a wire:click="show_payment" class="btn btn-info next link-to-tab">Next</a>
                                    --}}
                                    <a wire:click="save" class="btn btn-secondary next link-to-tab">Submit </a>

                                </div>


                            </div>

                        </div>
                        <div class="tab-pane fade @if($finish) active @endif">

                            <div class="appointment-form-wrap">



                                <div class="da-head">
                                    <div class="row">
                                        <div class="col-7">
                                            <h4>Finish</h4>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 4 - 4</h2>
                                        </div>
                                    </div>
                                </div>





                                <div class="main-container">
                                    <div class="check-container">
                                        <div class="check-background">
                                            <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="check-shadow"></div>
                                    </div>

                                    <p>Thank you. Your order has been received.<br>
                                        GO To Your Accout To See Your Orders <a
                                            href="{{ route('trader.account') }}">Track Your Order Now !</a></p>
                                </div>



                                <br>




                                <div class="d-flex justify-content-between">
                                    <a href="show_checkout" class="btn btn-dark previous link-to-tab"> Back</a>
                                    {{-- <a wire:click="save" class="btn btn-secondary next link-to-tab">Submit </a>
                                    --}}
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- End of PageContent -->
    @push('scripts')
    <script>
        $(".defin_value").change(function() {
        {{--  console.log('hi');  --}}
        @this.set('count_new',this.value);
    });
    </script>
    @endpush
</main>