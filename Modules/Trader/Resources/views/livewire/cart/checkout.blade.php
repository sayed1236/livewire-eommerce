<div class="appointment-form-wrap">



    <div class="da-head">
        <div class="row">
            <div class="col-7">
                <h4>Checkout</h4>
            </div>
            <div class="col-5">
                <h2 class="steps">Step 2 - 4</h2>
            </div>
        </div>
    </div>




    <form class="form checkout-form" wire:submit="save">






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
                            <select wire:model.live='country_id' class="form-control form-control-md">
                                @isset($countries)
                                <option value="" @if (empty($country_id)) selected @endif>Select Country</option>
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" @if($country->id == $country_id) selected @endif>
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
                            <select wire:model.live="state" class="form-control form-control-md">
                                <option value="" >Select state</option>

                                @isset($states)
                                @foreach ($states as $state)
                                <option value="{{ $state->name }}" class="option">{{ $state->name }}</option>
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
                                <input type="text" class="form-control form-control-md" wire:model="postal_code">
                                @error('postal_code')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone *</label>
                                <input type="text" class="form-control form-control-md" placeholder=" phone "
                                    wire:model="mobile">
                                @error('mobile')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address *</label>
                            <input type="text" placeholder="enter your address "
                                class="form-control form-control-md mb-2" wire:model="address">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Street address *</label>
                            <input type="text" placeholder="enter your street "
                                class="form-control form-control-md mb-2" wire:model="street">
                            @error('street')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="order-notes">Order notes (optional)</label>
                        <textarea class="form-control mb-0" id="order-notes" wire:model="notes" cols="30" rows="4"
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
                                    @php $total =0;
                                   
                                    @endphp
                                    @if(isset($trader_orders))
                                    @foreach ($trader_orders as $order )
                                    @if(@$order->product->min_amount_to_buy <=
                                    @$order->quantity )
                                    @if(@$order->product->latestProductStock->quantity <=
                                    $order->quantity )
                                    @else
                                    @php
                                    $discount = 0; // Default value
                                    if ($order->product->discounts_product &&
                                    $order->quantity >= $order->product->discounts_product->quantity_from &&
                                    $order->quantity <= $order->product->discounts_product->quantity_to) {
                                        $discount = $order->total_price *
                                        ($order->product->discounts_product->discount_percent / 100);
                                        }
                                     $total += @$order->total_price - @$discount;
                                     @endphp

                                    <tr class="bb-no">

                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="">
                                                    <figure>
                                                        <img src="{{ img_chk_exist($order->product->img) }}"
                                                            alt="product" width="300" height="338">
                                                    </figure>
                                                </a>
                                            </div>
                                        </td>


                                        <td class="product-name">Palm Print Jacket
                                            <i class="fas fa-times"></i> <span class="product-quantity">{{
                                                @$order->quantity }}</span>
                                        </td>
                                        <td class="product-total">
                                            @php
                                            $discount = 0; // Default value
                                            if ($order->product->discounts_product &&
                                            $order->quantity >= $order->product->discounts_product->quantity_from &&
                                            $order->quantity <= $order->product->discounts_product->quantity_to) {
                                                $discount = $order->total_price *
                                                ($order->product->discounts_product->discount_percent / 100);
                                                }
                                                @endphp

                                                ${{ $order->total_price - $discount }}



                                        </td>

                                        @if($order->product->discounts_product->quantity_from <= $order->quantity &&
                                            $order->quantity <= $order->
                                                product->discounts_product->quantity_to)
                                                <td>

                                                    %{{
                                                    $order->product->discounts_product->discount_percent
                                                    }}

                                                </td>
                                                @endif

                                    </tr>
                                    @endif
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


                                            <form class="coupon" >

                                                <label class="ls-25">Coupon Discount</label>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter coupon code here..." wire:model.live="coupon">
                                                        
                                                    <a wire:click="discountcoupon" class="btn btn-dark btn-rounded">Apply</a>
                                                   
                                                </div>
                                                @error('coupon')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                {{ @$error_coupon }}
                                            </form>
                                            <hr class="divider mb-6">

                                         
                                            <div
                                            class="order-total d-flex justify-content-between align-items-center">
                                            <label>Discount coupon</label>
                                            @if(@$coupon_discount)
                                            <span class="ls-50">%{{ @$coupon_discount }}</span>
                                           
                                            <a class="btn btn-primary" wire:click="delete_coupon">delete</a>
                                            @endif
                                            </div>
                                           
                                            {{-- <p class="alert alert-danger">
                                                Sorry, you are not apply this promotional code.
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
                                            $totalaftercoupon = $total - ($total * (@$coupon_discount / 100));
                                        @endphp
                                        @if($coupon_discount)
                                        <span style="text-decoration: line-through">${{ @$total }}</span>
                                        <b>
                                            ${{ isset($totalaftercoupon) ? $totalaftercoupon : $total }}
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
                                <button type="submit"  class="btn btn-dark btn-block btn-rounded">Place
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
        <a href="#step1" class="btn btn-dark previous link-to-tab"> Back</a>
        <a href="#step3" class="btn btn-info next link-to-tab">Next</a>
    </div>

</div>
