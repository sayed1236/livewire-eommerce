<main class="main order">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <h2>View Order</h2>
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('trader.account') }}">My Account</a></li>
               
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content mb-10 pb-2">
        <div class="container">
            <div class="success-text checkout-card text-center mb-2 mt-2">
                <i class="icon fal fa-shield-check"></i>
               
            </div>

            <!-- End of Order Success -->

            <ul class="order-view list-style-none">
                <li>
                    <label>Order number</label>
                    <strong>945</strong>
                </li>
                <li>
                    <label>Status</label>
                    <strong>{{ @$orderproducts->status }}</strong>
                </li>
                <li>
                    <label>Date</label>
                    <strong>{{ @$orderproducts->created_at }}</strong>
                </li>
                <li>
                    <label>Total</label>
                    <strong>${{ @$orderproducts->order_total_price }}</strong>
                </li>
                <li>
                    <label>Payment method</label>
                    <strong>cash on delivery</strong>
                </li>
            </ul>
            <!-- End of Order View -->

            <div class="row">
                <div class="col-md-8 col-12 mb-2">
                    <div class="order-details-wrapper mb-3">
                        <h4 class="title ls-25 mb-3">Order Details</h4>
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th class="text-dark">image</th>
                                    <th class="text-dark">Product name</th>
                                    <th>price</th>
                                    <th>Quantity</th>

                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderproducts->orderproducts as $product )
                                <tr>
                                    <td class="product-thumbnail">
                                        <div class="p-relative">
                                            <a wire:click="showproduct({{ $product->product->id }})" style="cursor: pointer">
                                                <figure>
                                                    <img src="{{ img_chk_exist($product->product->img) }}" alt="product"
                                                        width="300" height="338" />
                                                </figure>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a wire:click="showproduct({{ $product->product->id }})" style="cursor: pointer">{{ $product->product->name }}</a>&nbsp;<br />
                                        Seller : <a >{{ @$product->product->vendor->name }}</a>
                                    </td>


                                    <td>${{ @$product->product->latestProductStock->selling_price }}</td>

                                    <td>{{ @$product->quantity }}</td>

                                    <td>${{ @$product->quantity * @$product->product->latestProductStock->selling_price }}</td>
                                </tr>
                                @endforeach
                             

                                
                            </tbody>
                            <tfoot>
                                  
                                <tr>
                                    <th colspan="4">Coupon Discount:</th>
                                    <td>{{ @$orderproducts->coupon_discount }}</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Payment method:</th>
                                    <td>cash on delivery</td>
                                </tr>
                                <tr class="total">
                                    <th class="border-no" colspan="4">Final Total:</th>
                                    @php
                                    $totalaftercoupon=0;
                                    $totalaftercoupon = @$orderproducts->order_total_price - (@$orderproducts->order_total_price * (@$orderproducts->coupon_discount / 100));
                                @endphp
                                @if(@$orderproducts->coupon_discount>0)
                                    <td class="border-no" style="color:green">${{ @$totalaftercoupon }}</td>
                                    <td class="border-no" style="text-decoration: line-through; color:red">${{ @$orderproducts->order_total_price  }}</td>

                                    @else
                                    <td class="border-no">${{ @$orderproducts->order_total_price  }}</td>

                                    @endif
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="col-md-4 col-12 mb-3">
                    <div class="ecommerce-address shipping-address">
                        <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address
                        </h4>
                        <address class="mb-4">
                            <table class="address-table">
                                <tbody>
                                    <tr>
                                        <td> Name</td>
                                        <td>{{ auth('trader')->user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>{{ @$orderproducts->address->country }}</td>
                                    </tr>
                                    <tr>
                                        <td>state</td>
                                        <td>{{ $orderproducts->address->state }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Street</td>
                                        <td>{{ $orderproducts->address->street }}</td>
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                        </address>
                    </div>
                </div>
            </div>
            <!-- End of Order Details -->

            <a href="{{ route('trader.cart') }}" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-2"><i
                    class="w-icon-long-arrow-left"></i>Back To Shopping Cart</a>
        </div>
    </div>
    <!-- End of PageContent -->
</main>