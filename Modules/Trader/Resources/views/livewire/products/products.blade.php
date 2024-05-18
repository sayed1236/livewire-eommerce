@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('site/vendor/photoswipe/default-skin/default-skin.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('site/vendor/photoswipe/photoswipe.min.css') }}">


@endsection

<main class="main mb-10 pb-1">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <h2>Products</h2>
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('home') }}">Home</a></li>


                <li>{{ @$product->name }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg">
                <div class="main-content">
                    <div class="product product-single row">
                        <div class="col-md-6 mb-6">
                            <div class="product-gallery product-gallery-sticky">
                                <div class="swiper-container product-single-swiper swiper-theme nav-inner"
                                    data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                    <div class="swiper-wrapper row cols-1 gutter-no">
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="{{ img_chk_exist($product->img) }}"
                                                    data-zoom-image="{{ img_chk_exist($product->img) }}"
                                                    alt="{{@$product->name}}" width="800" style="height: 450px"
                                                    height="900">
                                            </figure>
                                        </div>
                                        @if(isset($product->products_gallaries))
                                        @foreach ($product->products_gallaries as $gallary )
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="{{ img_chk_exist($gallary->path) }}"
                                                    data-zoom-image="{{ img_chk_exist($gallary->path) }}"
                                                    alt="{{ @$product->name }}" width="488" style="height:550px"
                                                    height="549">
                                            </figure>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <button class="swiper-button-next"></button>
                                    <button class="swiper-button-prev"></button>
                                    <a href="#" class="product-gallery-btn product-image-full"><i
                                            class="w-icon-zoom"></i></a>
                                </div>
                                <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                    'navigation': {
                                        'nextEl': '.swiper-button-next',
                                        'prevEl': '.swiper-button-prev'
                                    }
                                }">
                                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                        {{--  <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="{{ img_chk_exist($product->img) }}"
                                                    data-zoom-image="{{ img_chk_exist($product->img) }}"
                                                    alt="{{@$product->name}}" width="800" style="height: 130px"
                                                    height="900" >
                                            </figure>
                                        </div>
                                        @if(isset($product->products_gallaries))
                                        @foreach ($product->products_gallaries as $gallary )
                                        <div class="product-thumb swiper-slide">
                                            <img src="{{ img_chk_exist($gallary->path) }}" alt="Product Thumb"
                                                width="800" height="900" style="height: 130px">
                                        </div>
                                        @endforeach
                                        @endif  --}}

                                    </div>
                                    <button class="swiper-button-next"></button>
                                    <button class="swiper-button-prev"></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-6">
                            <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                <h1 class="product-title">{{ $product->name }}</h1>
                                <div class="product-bm-wrapper">
                                    @if(isset($product->category))

                                    <figure class="brand">
                                        <img src="{{ img_chk_exist($product->category->img) }}" alt="Brand" width="102"
                                            height="48" />
                                    </figure>
                                    @endif
                                    <div class="product-meta">
                                        @if(isset($product->category))
                                        <div class="product-categories">
                                            Category:
                                            <span class="product-category"><a style="cursor: pointer"
                                                    wire:click="show_category({{ $product->category_id }})">{{
                                                    $product->category->name
                                                    }}</a></span>
                                        </div>
                                        @endif
                                        <div class="product-sku">
                                            SKU: <span>MS46891340</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="product-divider">

                                <div class="product-price"><ins class="new-price">${{
                                        @$product->latestProductStock->selling_price }}</ins></div>

                                <div class="ratings-container">
                                    @php
                                    $count=0;
                                    $sumcount=0;
                                    @endphp
                                    @if(isset($product->products_rates))
                                    @foreach ($product->products_rates as $rating)

                                    @php
                                    $sumcount+=$rating->rate;
                                    $count++;
                                    @endphp
                                    @endforeach
                                    @endif
                                    @php
                                    if($count>0){
                                    $avgrate=$sumcount/$count;
                                    }else{
                                    $avgrate=0;
                                    }
                                    @endphp


                                    <div class="ratings-full">
                                        @php
                                        $width=0;
                                        $avg=20;
                                        $counter=1;
                                        while ($counter <= $avgrate) { $width+=$avg; $counter++; } @endphp <span
                                            class="ratings" style="width: @php echo $width @endphp%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="product-default.html" class="rating-reviews"> ({{
                                        count($product->products_rates) }}Reviews)</a>
                                </div>

                                <div class="product-short-desc">
                                    <ul class="list-type-check list-style-none">
                                        <li>{{ @$product->description }}.</li>
                                        
                                    </ul>
                                </div>

                                <hr class="product-divider">

                                @foreach ($product->atts_cats as $attributes )

                                {{--  @foreach ($attributes->attribute as $asd)  --}}
                                    
                              
                                <div class="product-form product-variation-form product-size-swatch">
                                    <label class="" style="">{{ @$attributes->attrcats->attribute->main_attribute->name }}:</label>
                                    
                                    <div class="flex-wrap d-flex align-items-center product-variations">
                                        {{--  @foreach ($attributes->attribute_values as $attribute_values)  --}}
                                        <a   class="size ">{{ @$attributes->attrcats->attribute->value }}</a>
                                        {{--  @endforeach  --}}
                                    </div>
                                </div>
                                {{--  @endforeach  --}}
                                @endforeach
                                {{-- @if($price) --}}
                                {{-- <a href="#" class="product-variation-clean" style="display:inline">Clean All</a>

                                <div class="product-variation-price" style="display: block">
                                    <span>465</span>
                                </div> --}}
                                {{-- @endif --}}

								
                                <div class="fix-bottom product-sticky-content sticky-content">
                                    <div class="product-form container">
                                        <div class="product-qty-form">
                                            <div class="input-group">
                                                <input class="quantity form-control" wire:model="quantity" type="number"
                                                    min="1" max="10000000">
                                                <button class="quantity-plus w-icon-plus" wire:click="plus"></button>
                                                <button class="quantity-minus w-icon-minus" wire:click="minus"></button>
                                            </div>

                                        </div>

                                        <button class="btn btn-primary btn-cart" wire:click="add_cart">
                                            <i class="w-icon-cart"></i>
                                            <span>Add to Cart</span>
                                        </button>
                                    </div>
                                    @error('quantity')
                                    <div class="alert alert-success" role="alert">
                                        <p
                                            style="color: black; text-align: center; font-size: 18px; font-weight: bold; padding: 10px; background-color: #f6be00;">
                                            enter quantity </p>
                                    </div> @enderror
                                </div>

                                <div class="social-links-wrapper">
                                    <div class="social-links">
                                        <div class="social-icons social-no-color border-thin">
                                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                            <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                            <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                                        </div>
                                    </div>
                                    <span class="divider d-xs-show"></span>
                                    <div class="product-link-wrapper d-flex">
                                        <a  wire:click.prevent="add_to_wishlist({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                                        <a wire:click="add_to_compare({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon  btn-icon-left w-icon-compare"><span></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                {{--  <th>Product ID</th>  --}}
                                <th>Product Name</th>
                                <th>Quantity From</th>
                                <th>Quantity To</th>
                                <th>Discount Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->prouct_price as $productDisc)
                            <tr>
                                {{--  <td>ty</td>  --}}
                                <td>{{ $product->name }}</td>
                                <td>{{ $productDisc->quantity_from }}</td>
                                <td>{{ $productDisc->quantity_to }}</td>
                                <td>{{ $productDisc->discount_percent	 }}</td>
                            </tr>
                            @endforeach
                                
                            
                        </tbody>
                    </table> 
                    <div class="frequently-bought-together mt-5">
                        <h2 class="title title-underline">Frequently Bought Together</h2>
                        <div class="bought-together-products row mt-8 pb-4">
                            <div class="product product-wrap text-center">
                                <figure class="product-media">
                                    <img src="{{ img_chk_exist($product->img) }}" alt="Product" width="138" height="138"
                                         />
                                    <div class="product-checkbox">
                                        <input type="checkbox" class="custom-checkbox" id="product_check1"
                                            name="product_check1">
                                        <label></label>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name">
                                        <a wire:click="showproduct({{ @$product->id }})" style="cursor:pointer">{{ @$product->name }}</a>
                                    </h4>
                                    <div class="product-price">${{
                                        @$product->latestProductStock->selling_price }} </div>
                                </div>
                            </div>
                            @php $totaloffer =0; @endphp
                            @if($product_popularity)
                            @foreach ($product_popularity as $vendor_product )
                            @php @$totaloffer += $vendor_product->latestProductStock->selling_price @endphp
                            <div class="product product-wrap text-center">
                                <figure class="product-media">
                                    <img src="{{ img_chk_exist($vendor_product->img) }}" alt="Product" width="138"
                                        height="138"  />
                                    <div class="product-checkbox">
                                        <input type="checkbox" class="custom-checkbox" id="product_check1"
                                            name="product_check1">
                                        <label></label>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name">
                                        <a wire:click="showproduct({{ @$vendor_product->id }})" style="cursor:pointer">{{ @$vendor_product->name }}</a>
                                    </h4>
                                    <div class="product-price">${{
                                        @$vendor_product->latestProductStock->selling_price }} </div>
                                </div>
                            </div>
                            @endforeach
                            @endif


                            <div class="product-button">
                                <div class="bought-price font-weight-bolder text-primary ls-50">${{ @$totaloffer +
                                    @$product->latestProductStock->selling_price }}</div>
                                <div class="bought-count">Total for items</div>
                                {{--  <a href="cart.html" class="btn btn-dark btn-rounded">Add All To Cart</a>  --}}
                            </div>
                        </div>
                    </div>
                    <livewire:trader::products.product-details :product_id="$product->id" />

                    <section class="vendor-product-section" style="height: 400px">
                        <div class="title-link-wrapper mb-4">
                            <h4 class="title text-left">More Products From This Seller</h4>
                            <a wire:click="vendorproducts({{ $product->company_id }})" style="cursor:pointer"
                                class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                                Products<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                            'spaceBetween': 20,
                            'slidesPerView': 2,
                            'breakpoints': {
                                '576': {
                                    'slidesPerView': 3
                                },
                                '768': {
                                    'slidesPerView': 4
                                },
                                '992': {
                                    'slidesPerView': 3
                                }
                            }
                        }">
                            <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                                @foreach ($vendor_products as $product)
                                <div class="swiper-slide product">
                                    <figure class="product-media">
                                        <a wire:click="showproduct({{ $product->id}})" style="cursor: pointer">
                                            <img src="{{ img_chk_exist($product->img) }}" alt="Product" width="300"
                                                height="338" style="height:290px" />
                                        </a>
                                        <div class="product-action-vertical">
                                            <a style="cursor: pointer" wire:click="add_cart({{ $product->id }})"
                                                class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                            <a style="cursor: pointer" wire:click="add_to_wishlist({{ $product->id }})"
                                                class="btn-product-icon btn-wishlist w-icon-heart"
                                                title="Add to wishlist"></a>
                                            <a wire:click="add_to_compare({{ $product->id }})" style="cursor:pointer"
                                                class="btn-product-icon  w-icon-compare"
                                                title="Add to Compare"></a>
                                        </div>
                                        <div class="product-action">
                                            <a class="btn-product " wire:click="show_modal({{ $product->id }})"
                                                style="cursor: pointer" title="Quick View">Quick
                                                View</a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h3 class="product-name">
                                            <a style="cursor: pointer"
                                                wire:click.prevent="showproduct({{ $product->id}})">{{ $product->name
                                                }}</a>
                                        </h3>
                                        <div class="ratings-container">
                                            @php
                                            $count=0;
                                            $sumcount=0;
                                            @endphp
                                            @if(isset($product->products_rates))
                                            @foreach ($product->products_rates as $rating)

                                            @php
                                            $sumcount+=$rating->rate;
                                            $count++;
                                            @endphp
                                            @endforeach
                                            @endif
                                            @php
                                            if($count>0){
                                            $avgrate=$sumcount/$count;
                                            }else{
                                            $avgrate=0;
                                            }
                                            @endphp


                                            <div class="ratings-full">
                                                @php
                                                $width=0;
                                                $avg=20;
                                                $counter=1;
                                                while ($counter <= $avgrate) { $width+=$avg; $counter++; } @endphp <span
                                                    class="ratings" style="width: @php echo $width @endphp%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a style="cursor: pointer" wire:click="showproduct({{ $product->id}})"
                                                class="rating-reviews">
                                                ({{ count($product->products_rates) }}Reviews)</a>
                                        </div>
                                        <div class="product-pa-wrapper">
                                            <div class="product-price">
                                               ${{
                                                @$product->latestProductStock->selling_price }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach




                            </div>
                        </div>
                    </section>
                    {{-- <section class="related-product-section">
                        <div class="title-link-wrapper mb-4">
                            <h4 class="title">Related Products</h4>
                            <a href="#" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                                Products<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                        <div class="swiper-container swiper-theme" data-swiper-options="{
                                                    'spaceBetween': 20,
                                                    'slidesPerView': 2,
                                                    'breakpoints': {
                                                        '576': {
                                                            'slidesPerView': 3
                                                        },
                                                        '768': {
                                                            'slidesPerView': 4
                                                        },
                                                        '992': {
                                                            'slidesPerView': 3
                                                        }
                                                    }
                                                }">
                            <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2" style="height:300px">
                                @if(isset($product_popularity))
                                @foreach ($product_popularity as $product)
                                <div class="swiper-slide product">
                                    <figure class="product-media">
                                        <a href="product-default.html">
                                            <img src="{{ img_chk_exist($product->img) }}" alt="Product" width="300"
                                                height="338" style="height:290px" />
                                        </a>
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                title="Add to cart"></a>
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                title="Add to wishlist"></a>
                                            <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                title="Add to Compare"></a>
                                        </div>
                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                                                View</a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="product-default.html">Drone</a></h4>
                                        <div class="ratings-container">
                                            @php
                                            $count=0;
                                            $sumcount=0;
                                            @endphp
                                            @if(isset($product->products_rates))
                                            @foreach ($product->products_rates as $rating)

                                            @php
                                            $sumcount+=$rating->rate;
                                            $count++;
                                            @endphp
                                            @endforeach
                                            @endif
                                            @php
                                            if($count>0){
                                            $avgrate=$sumcount/$count;
                                            }else{
                                            $avgrate=0;
                                            }
                                            @endphp


                                            <div class="ratings-full">
                                                @php
                                                $width=0;
                                                $avg=20;
                                                $counter=1;
                                                while ($counter <= $avgrate) { $width+=$avg; $counter++; } @endphp <span
                                                    class="ratings" style="width: @php echo $width @endphp%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a style="cursor: pointer"
                                                wire:click.prevent="showproduct({{ $product->id}})"
                                                class="rating-reviews">
                                                ({{ count($product->products_rates) }}Reviews)</a>
                                        </div>
                                        <div class="product-pa-wrapper">
                                            <div class="product-price">
                                                {{
                                                @$product->latestProductStock->selling_price }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif

                            </div>
                        </div>
                    </section> --}}
                </div>
                <!-- End of Main Content -->
                <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                    <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                    <div class="sidebar-content scrollable">
                        <div class="sticky-sidebar">
                            <div class="widget widget-icon-box">
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-truck"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                        <p>For all orders over $99</p>
                                    </div>
                                </div>
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-bag"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Secure Payment</h4>
                                        <p>We ensure secure payment</p>
                                    </div>
                                </div>
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-money"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Money Back Guarantee</h4>
                                        <p>Any back within 30 days</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Widget Icon Box -->

                            <div class="widget widget-banner">
                                <div class="banner banner-fixed br-sm">
                                    <figure>
                                        <img src="{{ url('site/images/shop/banner3.jpg') }}" alt="Banner" width="266"
                                            height="220" style="background-color: #1D2D44;" />
                                    </figure>
                                    <div class="banner-content">
                                        <div class="banner-price-info font-weight-bolder text-white lh-1 ls-25">
                                            40<sup class="font-weight-bold">%</sup><sub
                                                class="font-weight-bold text-uppercase ls-25">Off</sub>
                                        </div>
                                        <h4 class="banner-subtitle text-white font-weight-bolder text-uppercase mb-0">
                                            Ultimate Sale</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Widget Banner -->

                            <div class="widget widget-contact">
                                <div class="title-link-wrapper mb-2">
                                    <h4 class="title title-link font-weight-bold">Contact Seller</h4>
                                </div>

                                <div class="widget-body">
                                    <textarea wire:model="message" maxlength="1000" cols="25" rows="6"
                                        placeholder="Type your messsage..." class="form-control"
                                        required="required"></textarea>
                                    @error('message')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if($this->show_mesage !==null)
                                    <div class="alert alert-success">{{ $show_mesage }}</div>
                                    @endif
                                    <a wire:click="savemsg" class="btn btn-dark btn-rounded">Send Message</a>
                                </div>
                            </div>
                            <!-- End of Widget Banner -->

                            <div class="widget widget-products">
                                <div class="title-link-wrapper mb-2">
                                    <h4 class="title title-link font-weight-bold">More Products</h4>
                                </div>

                                <div class="nav-top">
                                    <div class="snav-top" style="height:100px">
                                                    <div class="owl-carousel one-slider">
                                                        @php $i = 0; @endphp
                                                    
                                                        @foreach($more_products as $more_product)
                                                            @php if($i < 3) { @endphp
                                                                <div class="widget-col">
                                                                    @if(isset($more_product))
                                                                        <div class="product product-widget">
                                                                            <figure class="product-media">
                                                                                <a style="cursor:pointer" wire:click="showproduct({{ $more_product->id }})">
                                                                                    <img src="{{ img_chk_exist($more_product->img) }}" alt="Product" width="100" height="113" />
                                                                                </a>
                                                                            </figure>
                                                                            <div class="product-details">
                                                                                <h4 class="product-name">
                                                                                    <a style="cursor:pointer" wire:click="showproduct({{ $more_product->id }})">
                                                                                        {{ $more_product->name }}
                                                                                    </a>
                                                                                </h4>
                                                    
                                                                                @php
                                                                                    $count = 0;
                                                                                    $sumcount = 0;
                                                                                @endphp
                                                    
                                                                                @if(isset($more_product->products_rates))
                                                                                    @foreach ($more_product->products_rates as $rating)
                                                                                        @php
                                                                                            $sumcount += $rating->rate;
                                                                                            $count++;
                                                                                        @endphp
                                                                                    @endforeach
                                                                                @endif
                                                    
                                                                                @php
                                                                                    $avgrate = ($count > 0) ? $sumcount / $count : 0;
                                                                                @endphp
                                                    
                                                                                <div class="ratings-container">
                                                                                    <div class="ratings-full">
                                                                                        @php
                                                                                            $width = 0;
                                                                                            $avg = 20;
                                                                                            $counter = 1;
                                                                                            while ($counter <= $avgrate) {
                                                                                                $width += $avg;
                                                                                                $counter++;
                                                                                            }
                                                                                        @endphp
                                                                                        <span class="ratings" style="width: {{ $width }}%;"></span>
                                                                                        <span class="tooltiptext tooltip-top"></span>
                                                                                    </div>
                                                                                </div>
                                                    
                                                                                <div class="product-price">
                                                                                    ${{ @$more_product->latestProductStock->selling_price }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @php $i++; @endphp
                                                                    @endif
                                                                </div>
                                                            @php } @endphp
                                                        @endforeach
                                                    </div>
                                                    
                                       
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </aside>
        <!-- End of Sidebar -->
    </div>
    </div>
    </div>
    <!-- End of Page Content -->
</main>