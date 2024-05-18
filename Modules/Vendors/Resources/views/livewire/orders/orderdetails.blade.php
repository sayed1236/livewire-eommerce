<div>
    <!-- Start of PageContent -->
                <div class="page-content vendor-sty">
                    <div class="container">
                        {{--  <div class="success-text checkout-card text-center mb-2 mt-2">
                            <i class="icon fal fa-shield-check"></i>
                            <h2>Thank you for your order!</h2>
                            <p class="mb-1">Payment is successfully processsed and your order is on the way</p>
                            <p class="mb-1">You will receive an order confirmation email with details of your order and a link to track its progress.</p>
                            <p class="text-order badge bg-success mt-3">Transaction ID: OCTOP05764</p>
                        </div>  --}}

                        <!-- End of Order Success -->

                        <ul class="order-view list-style-none">
                            <li>
                                <label>Order number</label>
                                <strong>{{ @$order_products1->order->order_num }}</strong>
                            </li>
                            <li>
                                <label>Status</label>
                                <strong>{{ @$order_products1->order->status  }}</strong>
                            </li>
                            <li>
                                <label>Date</label>
                                <strong>{{  @$order_products1->order->created_at }}</strong>
                            </li>
                            <li>
                                <label>Total</label>
                                <strong>{{  @$order_products1->order->order_total_price }}</strong>
                            </li>
                            {{--  <li>
                                <label>Payment method</label>
                                <strong>Direct bank transfor</strong>
                            </li>  --}}
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
                                                {{--  <th>price</th>  --}}
												<th>Quantity</th>

                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($order_products2 as $order_product)
                                          <tr>
                                            <td class="product-thumbnail">
                                                <div class="p-relative">
                                                    <a href="product-default.html">
                                                        <figure>
                                                            <img src="{{ img_chk_exist(@$order_product->product->img)}}" alt="product" width="300" height="338" />
                                                        </figure>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#">{{ @$order_product->product->name }}</a>
                                                {{--  <br />
                                                Vendor : <a href="#">Vendor #1  --}}

                                                </a>
                                            </td>


                                            {{--  <td>$40.00</td>  --}}

                                            <td>{{  @$order_product->quantity }}</td>

                                            <td>{{ @$order_product->product_total_price }}</td>
                                        </tr>
                                          @endforeach



                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Subtotal:</th>
												<td>${{ @$order_products1->order->order_total_price }}</td>
                                            </tr>
                                            <tr>
                                                <th colspan="3">delivering time:</th>
                                                <td>{{ @$order_products1->order->delivering_time }}</td>
                                            </tr>
                                            {{--  <tr>
                                                <th colspan="4">Payment method:</th>
                                                <td>Direct bank transfor</td>
                                            </tr>  --}}
                                            {{--  <tr class="total">
                                                <th class="border-no" colspan="4">Total:</th>
                                                <td class="border-no">$100.00</td>
                                            </tr>  --}}
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4 col-12 mb-3">
                                <div class="ecommerce-address shipping-address">
                                    <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
                                    <address class="mb-4">
                                        <table class="address-table">
                                            <tbody>
                                                <tr>
                                                    <td>email</td>
                                                    <td>{{ @$adreess->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>mobile</td>
                                                    <td>{{ @$adreess->mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <td>country</td>
                                                    <td>{{ @$adreess->country }}</td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>{{ @$adreess->state }}</td>
                                                </tr>
                                                <tr>
                                                    <td>street</td>
                                                    <td>{{ @$adreess->street }}</td>
                                                </tr>
                                                <tr>
                                                    <td>notes</td>
                                                    <td>{{ @$adreess->notes }}</td>
                                                </tr>
                                                <tr>
                                                    <td>postal code</td>
                                                    <td>{{ @$adreess->postal_code }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <!-- End of Order Details -->

                        {{--  <a href="cart.html" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-2"><i class="w-icon-long-arrow-left"></i>Back To Shopping Cart</a>  --}}
                    </div>
                </div>
                <!-- End of PageContent -->
</div>
