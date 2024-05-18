<div>
    <div class="page-content">
      @if ($product)


        <div class="container">
            <div class="">
                <div class="main-content">
                    <div class="product product-single row">
                        <div class="col-md-6 mb-6">
                            <div class="product-gallery product-gallery-sticky">
                                <div class="m-img">

                                <div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                    <div class="swiper-wrapper row cols-1 gutter-no">
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="{{  img_chk_exist($product_img) }}"
                                                    data-zoom-image="images/products/default/1-800x900.jpg"
                                                    alt="Electronics Black Wrist Watch" width="800" height="900">
                                            </figure>
                                        </div>
                                        {{--  <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="images/products/default/2-800x900.jpg"
                                                    data-zoom-image="images/products/default/2-800x900.jpg"
                                                    alt="Electronics Black Wrist Watch" width="488" height="549">
                                            </figure>
                                        </div>
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="images/products/default/3-800x900.jpg"
                                                    data-zoom-image="images/products/default/3-800x900.jpg"
                                                    alt="Electronics Black Wrist Watch" width="800" height="900">
                                            </figure>
                                        </div>
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="images/products/default/4-800x900.jpg"
                                                    data-zoom-image="images/products/default/4-800x900.jpg"
                                                    alt="Electronics Black Wrist Watch" width="800" height="900">
                                            </figure>
                                        </div>
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="images/products/default/5-800x900.jpg"
                                                    data-zoom-image="images/products/default/5-800x900.jpg"
                                                    alt="Electronics Black Wrist Watch" width="800" height="900">
                                            </figure>
                                        </div>
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="images/products/default/6-800x900.jpg"
                                                    data-zoom-image="images/products/default/6-800x900.jpg"
                                                    alt="Electronics Black Wrist Watch" width="800" height="900">
                                            </figure>
                                        </div>  --}}
                                    </div>
                                    {{--  <button class="swiper-button-next"></button>
                                    <button class="swiper-button-prev"></button>
                                    <a href="#" class="product-gallery-btn product-image-full"><i class="w-icon-zoom"></i></a>  --}}
                                </div>

                                <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                    {{--  <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                        <div class="product-thumb swiper-slide">
                                            <img src="images/products/default/1-800x900.jpg"
                                                alt="Product Thumb" width="800" height="900">
                                        </div>
                                        <div class="product-thumb swiper-slide">
                                            <img src="images/products/default/2-800x900.jpg"
                                                alt="Product Thumb" width="800" height="900">
                                        </div>
                                        <div class="product-thumb swiper-slide">
                                            <img src="images/products/default/3-800x900.jpg"
                                                alt="Product Thumb" width="800" height="900">
                                        </div>
                                        <div class="product-thumb swiper-slide">
                                            <img src="images/products/default/4-800x900.jpg"
                                                alt="Product Thumb" width="800" height="900">
                                        </div>
                                        <div class="product-thumb swiper-slide">
                                            <img src="images/products/default/5-800x900.jpg"
                                                alt="Product Thumb" width="800" height="900">
                                        </div>
                                        <div class="product-thumb swiper-slide">
                                            <img src="images/products/default/6-800x900.jpg"
                                                alt="Product Thumb" width="800" height="900">
                                        </div>
                                    </div>  --}}
                                    <button class="swiper-button-next"></button>
                                    <button class="swiper-button-prev"></button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-6">
                            <div class="product-details" data-sticky-options="{'minWidth': 767}">

                                <h1 class="product-title">{{ $product_name }}</h1>
                                <span>  M.O.Q : {{ $m_o_q }}</span>
                                {{--  <div class="product-bm-wrapper">
                                    <figure class="brand">
                                        <img src="images/products/brand/brand-1.jpg" alt="Brand"
                                            width="102" height="48" />
                                    </figure>
                                    <div class="product-meta">
                                        <div class="product-categories">
                                            Category:
                                            <span class="product-category"><a href="#">Electronics</a></span>
                                        </div>
                                        <div class="product-sku">
                                            SKU: <span>MS46891340</span>
                                        </div>
                                    </div>
                                </div>  --}}

                                {{--  <hr class="product-divider">  --}}

                                {{--  <div class="product-price"><ins class="new-price">$40.00</ins></div>  --}}
                                <div class="container">
                                    <div class="appointment-form-wrap pl-0 pr-0">
                                        <h4 class="title title-underline ls-25 font-weight-bold"> details</h4>
                                        @php
                                        $i=0;
                                    @endphp
                                            <table class="cust-table">
                                                <tbody>
                                                    <tr>
                                                        <th class="num-th">#</th>
                                                        <th class="atr-th">Store name</th>
                                                        <th class="atr-th">Qantity</th>
                                                        <th class="vlu-th"> Selling Price</th>
                                                        <th class="vlu-th"> Buying Price</th>
                                                        <th class="vlu-th">  Data of enter</th>
                                                        <th class="vlu-th"> Data of expire</th>

                                                    </tr>
                                                    @foreach ($product_details as $product_detail)
                                                    <tr>
                                                        @php
                                                            $i++;
                                                        @endphp


                                                        <td>{{ $i }}</td>
                                                        <td>{{ $product_detail->stock->stock_name }}</td>
                                                        <td>{{ $product_detail->quantity }}</td>
                                                        <td>{{ $product_detail->selling_price }}</td>
                                                        <td>{{ $product_detail->buying_price }}</td>
                                                        <td>{{ $product_detail->date_of_enter }}</td>
                                                        <td>{{ $product_detail->date_of_expire }}</td>


                                                    </tr>
                                                    @endforeach

                                                    {{--  <tr>
                                                        <td>2</td>
                                                        <td>250 - 400</td>
                                                        <td>20%</td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn-dots dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="ُ#" class="view-action dropdown-item"><i class="fal fa-edit"></i> edit</a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="#" class="delete-action dropdown-item"><i class="fal fa-trash-alt"></i> Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>400 - 650</td>
                                                        <td>25%</td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn-dots dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a href="ُ#" class="view-action dropdown-item"><i class="fal fa-edit"></i> edit</a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="#" class="delete-action dropdown-item"><i class="fal fa-trash-alt"></i> Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>  --}}
                                                </tbody>
                                            </table>

              </div>

                                    </div>

                                {{--  <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 80%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="#product-tab-reviews" class="rating-reviews scroll-to">(3
                                        Reviews)</a>
                                </div>  --}}

                                {{--  <div class="product-short-desc">
                                    <ul class="list-type-check list-style-none">
                                        <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                                        <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                                        <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                                    </ul>
                                </div>  --}}

                                {{--  <hr class="product-divider">  --}}

                                {{--  <div class="product-form product-variation-form product-color-swatch">
                                    <label>Color:</label>
                                    <div class="d-flex align-items-center product-variations">
                                        <a href="#" class="color" style="background-color: #ffcc01"></a>
                                        <a href="#" class="color" style="background-color: #ca6d00;"></a>
                                        <a href="#" class="color" style="background-color: #1c93cb;"></a>
                                        <a href="#" class="color" style="background-color: #ccc;"></a>
                                        <a href="#" class="color" style="background-color: #333;"></a>
                                    </div>
                                </div>
                                <div class="product-form product-variation-form product-size-swatch">
                                    <label class="mb-1">Size:</label>
                                    <div class="flex-wrap d-flex align-items-center product-variations">
                                        <a href="#" class="size">Small</a>
                                        <a href="#" class="size">Medium</a>
                                        <a href="#" class="size">Large</a>
                                        <a href="#" class="size">Extra Large</a>
                                    </div>
                                    <a href="#" class="product-variation-clean">Clean All</a>
                                </div>  --}}

                                {{--  <div class="product-variation-price">
                                    <span></span>
                                </div>  --}}

<!--
                                {{--  <div class="fix-bottom product-sticky-content sticky-content">
                                    <div class="product-form container">
                                        <div class="product-qty-form">
                                            <div class="input-group">
                                                <input class="quantity form-control" type="number" min="1"
                                                    max="10000000">
                                                <button class="quantity-plus w-icon-plus"></button>
                                                <button class="quantity-minus w-icon-minus"></button>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-cart">
                                            <i class="fal fa-shopping-bag"></i>
                                            <span>Add to Cart</span>
                                        </button>
                                    </div>
                                </div>  --}}
-->
                                {{--  <div class="social-links-wrapper">
                                    <div class="social-links">
                                        <div class="social-icons social-no-color border-thin">
                                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                            <a href="#"
                                                class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                            <a href="#"
                                                class="social-icon social-youtube fab fa-linkedin-in"></a>
                                        </div>
                                    </div>
                                    <span class="divider d-xs-show"></span>
                                    <div class="product-link-wrapper d-flex">
                                        <a href="#"
                                            class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                                        <a href="#"
                                            class="btn-product-icon btn-compare btn-icon-left fal fa-repeat"><span></span></a>
                                    </div>
                                </div>  --}}
                            </div>
                        </div>
                    </div>




                </div>
                <!-- End of Main Content -->

                <!-- End of Sidebar -->
            </div>
        </div>
        @else
        <h1> no data for this product</h1>
        @endif
    </div>
</div>
