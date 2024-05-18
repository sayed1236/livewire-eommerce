@section('reloadlogo')
<div class="loader-mask">
    <div class="loader">
        <img src="{{url('site/images/preload.gif')}}" alt="">
    </div>
</div>
@endsection
<div>

    <main class="main">
        <div class="intro-section">
            <div class=" pg-inner animation-slider">
                <div class="owl-carousel hero-banner">
                    {{-- @if (isset($sliders)) --}}
                    @foreach ($sliders as $slider)
                    <div class="banner banner-fixed intro-slide"
                        style='background-image: url("site/images/slide-1.jpg");'>
                        <div class="container">
                            <figure class="slide-image floating-item slide-animate" data-animation-options="{
                                'name': 'fadeInDownShorter', 'duration': '1s'
                            }" data-options="{'relativeInput':true,'clipRelativeInput':true,'invertX':true,'invertY':true}"
                                data-child-depth="0.2">
                                <img src="{{ img_chk_exist($slider->path) }}" alt="Ski"  />
                            </figure>
                            <div class="banner-content text-right y-50 ml-auto">
                                <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate"
                                    data-animation-options="{
                                    'name': 'fadeInUpShorter', 'duration': '1s'
                                }">Deals And Promotions</h5>
                                <h3 class="banner-title ls-25 mb-6 slide-animate" data-animation-options="{
                                    'name': 'fadeInUpShorter', 'duration': '1s'
                                }">Fashion <span class="text-primary">Skiwears</span>
                                </h3>
                                <a href="{{ route('trader.newarrival') }}"
                                    class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                    data-animation-options="{
                                    'name': 'fadeInUpShorter', 'duration': '1s'
                                }">
                                    Shop Now<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                            <!-- End of .banner-content -->
                        </div>
                        <!-- End of .container -->
                    </div>
                    <!-- End of .intro-slide1 -->
                    @endforeach
                    {{-- @endif --}}

                    <!-- End of .intro-slide3 -->
                </div>

            </div>
        </div>
        <!-- End of .intro-section -->

        <div class="container">
            <div class="icon-box-wrapper appear-animate br-sm">
                <div class="row cols-md-4 cols-sm-3 cols-1">
                    <div class="icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-shipping">
                            <i class="w-icon-truck"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Free Shipping & Returns</h4>
                            <p class="text-default">For all orders over $99</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Secure Payment</h4>
                            <p class="text-default">We ensure secure payment</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side text-dark icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Money Back Guarantee</h4>
                            <p class="text-default">Any back within 30 days</p>
                        </div>
                    </div>
                    <div class="icon-box icon-box-side text-dark icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Customer Support</h4>
                            <p class="text-default">Call or email us 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Iocn Box Wrapper -->

            <div class="title-link-wrapper appear-animate">
                <h2 class="title title-deals">Latest Discount Products</h2>
                {{--  <div class="product-countdown-container font-size-sm text-dark align-items-center">
                    <label>Offer Ends in: </label>
                    <div class="product-countdown countdown-compact ml-1 " data-until="+10d" data-relative="true"
                        data-compact="true">10days,00:00:00</div>
                </div>  --}}
                <a href="{{route('trader.newarrival')}}" class=" ls-25">More Products<i
                        class="w-icon-long-arrow-right"></i></a>
            </div>
            <!-- End of .title-link-wrapper -->

            <div class="product-deals-wrapper appear-animate mb-7"
                >
                <div class="owl-carousel custom-nav deals-slider">
                    @if(isset($products))
                    @foreach ($products as $product )
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a style="cursor:pointer" wire:click.prevent="showproduct({{ $product->id}})">
                                    <img src="{{ img_chk_exist($product->img) }}" alt="Product"  
                                        >
                                        @if(isset($product->products_gallaries))
                                        @foreach($product->products_gallaries as $gallary)
                                        <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product"  
                                             >
                                        @break
                                        @endforeach
                                        @endif
                                </a>

                                <div class="product-action-vertical">
                                    <a wire:click="add_cart({{ $product->id }})" style="cursor:pointer"
                                        class="btn-product-icon btn-cart fal fa-shopping-bag" title="Add to cart"></a>
                                    <a wire:click="add_to_wishlist({{ $product->id }})" style="cursor:pointer"
                                        class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    <a wire:click="show_modal({{ $product->id }})" style="cursor:pointer"
                                        class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                    <a wire:click="add_to_compare({{ $product->id }})" style="cursor:pointer"
                                        class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                </div>

                                <div class="product-label-group">
                                    {{-- <label class="product-label label-new">New</label> --}}
                                    {{-- <label class="product-label label-discount">-{{ $product->discount }}%</label>
                                    --}}
                                </div>
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a style="cursor:pointer"
                                        wire:click="showproduct({{ $product->id}})">{{ $product->name }}</a>
                                </h4>
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
                                <div class="product-price">
                                    <ins class="new-price">${{ @$product->latestProductStock->selling_price}}
                                    </ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- End of Product Deals Warpper -->

            <div class="row category-wrapper electronics-cosmetics appear-animate mb-7">
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-sm">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/categories/1-1.jpg') }}" alt="Category Banner"
                                    style="background-color: #25282D;" />
                        </figure>
                        <div class="banner-content y-50">
                            <h3 class="banner-title text-white ls-25 mb-0">Electronics</h3>
                            <div class="banner-price-info text-white font-weight-bold text-uppercase mb-1">Starting
                                At
                                <strong class="text-secondary">$125.00</strong>
                            </div>
                            <hr class="banner-divider bg-white" />
                            <a href="shop-banner-sidebar.html"
                                class="btn btn-white btn-link btn-underline btn-icon-right">
                                Shop Now<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-sm">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/categories/1-2.jpg') }}" alt="Category Banner"
                                    style="background-color: #eeedec;" />
                        </figure>
                        <div class="banner-content y-50">
                            <h3 class="banner-title ls-25 text-capitalize mb-0">Cosmetics Sets</h3>
                            <div class="banner-price-info font-weight-bold text-uppercase mb-1">Sale Up To
                                <strong class="text-secondary">30% Off</strong>
                            </div>
                            <hr class="banner-divider bg-dark" />
                            <a href="shop-banner-sidebar.html"
                                class="btn btn-dark btn-link btn-underline btn-icon-right">
                                Shop Now<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Category Wrapper -->

            {{-- <h2 class="title mb-5 appear-animate">Top Weekly Vendors</h2>
            <div class="swiper-container swiper-theme vendor-wrapper mb-4 appear-animate" data-swiper-options="{
                'spaceBetween': 20,
                'slidesPerView': 1,
                'breakpoints': {
                    '576': {
                        'slidesPerView': 2
                    },
                    '768': {
                        'slidesPerView': 3
                    },
                    '1200': {
                        'slidesPerView': 4
                    }
                }
            }">
                <div class="swiper-wrapper row cols-lg-4 cols-md-3 cols-sm-2 cols-1">
                    <div class="swiper-slide vendor-widget vendor-widget-1">
                        <div class="vendor-products grid-type">
                            <div class="vendor-product lg-item">
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ url('site/images/demos/demo2/products/2-1.jpg') }}"
                                            alt="Vendor Product"  >
                                    </a>
                                </figure>
                            </div>
                            <div class="vendor-product sm-item">
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ url('site/images/demos/demo2/products/2-2.jpg') }}"
                                            alt="Vendor Product"  >
                                    </a>
                                </figure>
                            </div>
                            <div class="vendor-product sm-item">
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ url('site/images/demos/demo2/products/2-3.jpg') }}"
                                            alt="Vendor Product"  >
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <div class="vendor-details">
                            <figure class="vendor-logo">
                                <a href="vendor-dokan-store.html">
                                    <img src="{{ url('site/images/demos/demo2/vendor-logo/1.jpg') }}" alt="Vendor Logo"
                                           >
                                </a>
                            </figure>
                            <div class="vendor-personal">
                                <h4 class="vendor-name">
                                    <a href="vendor-dokan-store.html">Vendor 1</a>
                                </h4>
                                <span class="vendor-product-count">(27 Products)</span>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Vendor Widget -->

                    <!-- End of Vendor Widget -->
                </div>
                <div class="swiper-pagination"></div>
            </div> --}}
            <!-- End of Vendor Wrapper -->
            <div class="tab tab-with-title tab-nav-boxed appear-animate">
                <h2 class="title">Consumer Electronics</h2>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if($newarrival) active @endif" wire:click="new_arrivals" href="">New
                            Arrivals</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link @if($selling) active @endif" wire:click="sellings" href="">Best Selling</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($most_popular) active @endif" wire:click="most_populars" href="">Most
                            Popular</a>
                    </li>

                </ul>
            </div>
            <!-- End of Tab Title-->
            <div class="tab-content tap-filhome appear-animate">
                @if ($newarrival)
                <div class="tab-pane @if($newarrival) active @endif" id="tab-1">
                    <div class="row grid-type products">
					

                        @php $i = 0; @endphp
                        @foreach ($newarrivals as $newarrival)
                        @if ($i === 0)
						{{--
                        <div class="product-wrap lg-item">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a style="cursor: pointer" wire:click="showproduct({{ $newarrival->id }})">
                                        <img src="{{ img_chk_exist( $newarrival->img )}}" alt="Product"  
                                            >
                                        @if(isset($newarrival->products_gallaries))
                                        @foreach($newarrival->products_gallaries as $gallary)
                                        <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product"  
                                            >
                                        @break
                                        @endforeach
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">
                                        <a wire:click="add_cart({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-cart fal fa-shopping-bag"
                                            title="Add to cart"></a>
                                        <a wire:click="add_to_wishlist({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                        <a wire:click="show_modal({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        <a wire:click="add_to_compare({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                    </div>

                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                        @if($newarrival->discount != 0)
                                        <label class="product-label label-discount">-{{ $newarrival->discount
                                            }}%</label>
                                        @endif
                                    </div>

                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a style="cursor:pointer"
                                            wire:click="showproduct({{ $newarrival->id }})">
                                            {{ $newarrival->name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        @php
                                        $count=0;
                                        $sumcount=0;
                                        @endphp
                                        @if(isset($newarrival->products_rates))
                                        @foreach ($newarrival->products_rates as $rating)

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
                                        <a style="cursor:pointer" wire:click="showproduct({{ $newarrival->id }})"
                                            class="rating-reviews"> ({{ count($newarrival->products_rates)
                                            }}Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">${{ @$newarrival->latestProductStock->selling_price}}
                                        </ins>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                        @else
                        <div class="product-wrap sm-item">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a style="cursor: pointer" wire:click.prevent="showproduct({{ $newarrival->id }})">
                                        <img src="{{ img_chk_exist($newarrival->img) }}"
                                            alt="Product"      >
                                        @if(isset($newarrival->products_gallaries))
                                        @foreach($newarrival->products_gallaries as $gallary)
                                        <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product"  
                                             >
                                        @break
                                        @endforeach
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">
                                        <a wire:click="add_cart({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-cart fal fa-shopping-bag"
                                            title="Add to cart"></a>
                                        <a wire:click="add_to_wishlist({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                        <a wire:click="show_modal({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        <a wire:click="add_to_compare({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                    </div>
                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                        @if($newarrival->discount != 0)
                                        <label class="product-label label-discount">-{{ $newarrival->discount
                                            }}%</label>
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a style="cursor:pointer"
                                            wire:click="showproduct({{$newarrival->id}})">{{ $newarrival->name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        @php
                                        $count=0;
                                        $sumcount=0;
                                        @endphp
                                        @if(isset($newarrival->products_rates))
                                        @foreach ($newarrival->products_rates as $rating)

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
                                        <a style="cursor:pointer" wire:click="showproduct({{ $newarrival->id }})"
                                            class="rating-reviews"> ({{ count($newarrival->products_rates)
                                            }}Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">${{ @$newarrival->latestProductStock->selling_price}}
                                        </ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @php $i++; @endphp
                        @endforeach

                    </div>
                </div>
                @endif
                @if ($selling)
                <div class="tab-pane  @if($selling) active @endif" id="tab-2">
                    <div class="row grid-type products">
                        @php $i = 0; @endphp
                        @foreach ($more_sales_products as $newarrival)
                        @if ($i === 0)
                        <div class="product-wrap lg-item">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a style="cursor: pointer" wire:click="showproduct({{ $newarrival->id }})">
                                        <img src="{{ img_chk_exist( $newarrival->img )}}" alt="Product" width="300"
                                            style="height:640px" height="338">
                                        @if(isset($newarrival->products_gallaries))
                                        @foreach($newarrival->products_gallaries as $gallary)
                                        <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product" width="300"
                                            style="height: 640px">
                                        @break
                                        @endforeach
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">
                                        <a wire:click="add_cart({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-cart fal fa-shopping-bag"
                                            title="Add to cart"></a>
                                        <a wire:click="add_to_wishlist({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                        <a wire:click="show_modal({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        <a wire:click="add_to_compare({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                    </div>

                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                        @if($newarrival->discount != 0)
                                        <label class="product-label label-discount">-{{ $newarrival->discount
                                            }}%</label>
                                        @endif
                                    </div>

                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a style="cursor:pointer"
                                            wire:click="showproduct({{ $newarrival->id }})">
                                            {{ $newarrival->name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        @php
                                        $count=0;
                                        $sumcount=0;
                                        @endphp
                                        @if(isset($newarrival->products_rates))
                                        @foreach ($newarrival->products_rates as $rating)

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
                                        <a style="cursor:pointer" wire:click="showproduct({{ $newarrival->id }})"
                                            class="rating-reviews"> ({{ count($newarrival->products_rates)
                                            }}Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">${{ @$newarrival->latestProductStock->selling_price}}
                                        </ins>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="product-wrap sm-item">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a style="cursor: pointer" wire:click.prevent="showproduct({{ $newarrival->id }})">
                                        <img src="{{ img_chk_exist($newarrival->img) }}" alt="Product" width="300"
                                            style="height:290px" height="338">
                                        @if(isset($newarrival->products_gallaries))
                                        @foreach($newarrival->products_gallaries as $gallary)
                                        <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product" width="300"
                                            style="height: 290px">
                                        @break
                                        @endforeach
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">
                                        <a wire:click="add_cart({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-cart fal fa-shopping-bag"
                                            title="Add to cart"></a>
                                        <a wire:click="add_to_wishlist({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                        <a wire:click="show_modal({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        <a wire:click="add_to_compare({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                    </div>
                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                        @if($newarrival->discount != 0)
                                        <label class="product-label label-discount">-{{ $newarrival->discount
                                            }}%</label>
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a style="cursor:pointer"
                                            wire:click="showproduct({{ $newarrival->id }})">{{ $newarrival->name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        @php
                                        $count=0;
                                        $sumcount=0;
                                        @endphp
                                        @if(isset($newarrival->products_rates))
                                        @foreach ($newarrival->products_rates as $rating)

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
                                        <a style="cursor:pointer" wire:click="showproduct({{ $newarrival->id }})"
                                            class="rating-reviews"> ({{ count($newarrival->products_rates)
                                            }}Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">${{ @$newarrival->latestProductStock->selling_price}}
                                        </ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @php $i++; @endphp
                        @endforeach

                    </div>
                </div>
                @endif
                @if ($most_popular)
                <div class="tab-pane @if($most_popular) active @endif" id="tab-1">
                    <div class="row grid-type products">
                        @php $i = 0; @endphp
                        @foreach ($product_popularity as $newarrival)
                        @if ($i === 0)
                        <div class="product-wrap sm-item">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a style="cursor: pointer" wire:click="showproduct({{ $newarrival->id }})">
                                        <img src="{{ img_chk_exist( $newarrival->img )}}" alt="Product"  
                                          >
                                        @if(isset($newarrival->products_gallaries))
                                        @foreach($newarrival->products_gallaries as $gallary)
                                        <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product"  
                                            >
                                        @break
                                        @endforeach
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">
                                        <a wire:click="add_cart({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-cart fal fa-shopping-bag"
                                            title="Add to cart"></a>
                                        <a wire:click="add_to_wishlist({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                        <a wire:click="show_modal({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        <a wire:click="add_to_compare({{ $newarrival->id }})" style="cursor:pointer"
                                            class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                    </div>

                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                        @if($newarrival->discount != 0)
                                        <label class="product-label label-discount">-{{ $newarrival->discount
                                            }}%</label>
                                        @endif
                                    </div>

                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a style="cursor:pointer"
                                            wire:click="showproduct({{ $newarrival->id }})">
                                            {{ $newarrival->name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        @php
                                        $count=0;
                                        $sumcount=0;
                                        @endphp
                                        @if(isset($newarrival->products_rates))
                                        @foreach ($newarrival->products_rates as $rating)

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
                                        <a style="cursor:pointer" wire:click="showproduct({{ $newarrival->id }})"
                                            class="rating-reviews"> ({{ count($newarrival->products_rates)
                                            }}Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">${{ @$newarrival->latestProductStock->selling_price}}
                                        </ins>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="product-wrap sm-item">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a style="cursor: pointer" wire:click.prevent="showproduct({{ $newarrival->id }})">
                                        <img src="{{ img_chk_exist($newarrival->img) }}" alt="Product"  
                                               >
                                        @if(isset($newarrival->products_gallaries))
                                        @foreach($newarrival->products_gallaries as $gallary)
                                        <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product">
                                        @break
                                        @endforeach
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">
                                        <a wire:click="add_cart({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-cart fal fa-shopping-bag"
                                            title="Add to cart"></a>
                                        <a wire:click="add_to_wishlist({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                        <a wire:click="show_modal({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        <a wire:click="add_to_compare({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                    </div>
                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                        @if($newarrival->discount != 0)
                                        <label class="product-label label-discount">-{{ $newarrival->discount
                                            }}%</label>
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a style="cursor:pointer"
                                            wire:click="showproduct({{ $newarrival->id }})">{{ $newarrival->name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        @php
                                        $count=0;
                                        $sumcount=0;
                                        @endphp
                                        @if(isset($newarrival->products_rates))
                                        @foreach ($newarrival->products_rates as $rating)

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
                                        <a style="cursor:pointer" wire:click="showproduct({{ $newarrival->id }})"
                                            class="rating-reviews"> ({{ count($newarrival->products_rates)
                                            }}Reviews)</a>
                                    </div>
                                    <div class="product-price">
                                        <ins class="new-price">${{ @$newarrival->latestProductStock->selling_price}}
                                        </ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @php $i++; @endphp
                        @endforeach

                    </div>
                </div>
                @endif
            </div>
            <!-- End of Tab Content -->

            <div class="sale-banner banner br-sm appear-animate">
                <div class="banner-content">
                    <h4
                        class="content-left banner-subtitle text-uppercase mb-8 mb-md-0 mr-0 mr-md-4 text-secondary ls-25">
                        <span class="text-dark font-weight-bold lh-1 ls-normal">Up
                            <br>To</span>70% Sale!
                    </h4>
                    <div class="content-right">
                        <h3 class="banner-title text-uppercase font-weight-normal mb-4 mb-md-0 ls-25 text-white">
                            <span>Pay Only For
                                <strong class="mr-10 pr-lg-10">Your Lovling Electronics</strong>
                                Pay Only For
                                <strong class="mr-10 pr-lg-10">Your Lovling Electronics</strong>
                                Pay Only For
                                <strong class="mr-10 pr-lg-10">Your Lovling Electronics</strong>
                            </span>
                        </h3>
                        <a href="#" class="btn btn-white btn-rounded">Shop Now
                            <i class="w-icon-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- End of Sale Banner -->
            @if(isset($categories))
            @foreach ($categories as $category )


            <div class="banner-product-wrapper appear-animate row mb-8">
                <div class="col-xl-5col col-md-4 mb-4">
                    <div class="categories h-100">
                        <h2 class="title text-left">{{ $category->name }}</h2>
                        <ul class="list-style-none mb-4">
                            @if(count($category->sub_category))
                            @foreach ($category->sub_category as $sub_category )

                            <li><a style="cursor: pointer" wire:click="show_category({{ $sub_category->id }})">{{
                                    $sub_category->name }}</a></li>
                            @endforeach
                            @endif
                        </ul>
                        <a href="{{ route('trader.category',$category->id) }}"
                            class="btn btn-dark btn-link btn-underline btn-icon-right font-weight-bolder text-capitalize ls-50">
                            Browse All<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-5col4 col-md-8 mb-4">
                    <div class="banner br-sm mb-4" style="background-image: url(site/images/demos/demo2/banners/1.jpg);
                        background-color: #EEF0EF;">
                        <div class="banner-content d-block d-lg-flex align-items-center">
                            <div class="content-left mr-auto">
                                <h5 class="banner-subtitle font-weight-normal text-capitalize texyt-dark ls-25 mb-0">
                                    Flash Sale <strong class="text-uppercase text-secondary">50% Off</strong>
                                </h5>
                                <h3 class="banner-title text-capitalize ls-25">Fashion Figure Skate Sale</h3>
                                <p class="text-dark">Only until the end of this week.</p>
                            </div>
                            <a href="shop-banner-sidebar.html" class="content-left btn btn-dark btn btn-outline 
                                btn-rounded btn-icon-right mt-4 mt-lg-0">Shop Now<i
                                    class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- End of Banner -->
                    <div class="">
					
                                    <div class="owl-carousel custom-nav deals-slider-four">
                                        @php
                                            
                                        @endphp

                            {{-- hi --}}
                            @foreach ($category->sub_category as $sub_category)

                            @foreach ($sub_category->sub_category as $sub_sub_category)

                            @foreach ($sub_sub_category->products as $product)
                            <div class="product-wrap">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="" wire:click.prevent="showproduct({{ $product->id}})">
                                            <img src="{{ img_chk_exist($product->img) }}" alt="Product"  
                                                   >
                                            @if(isset($product->products_gallaries))
                                            @foreach($product->products_gallaries as $gallary)
                                            <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product"  
                                                 >
                                            @break
                                            @endforeach
                                            @endif
                                        </a>
                                        <div class="product-action-vertical">
                                            <a wire:click="add_cart({{ $product->id }})" style="cursor:pointer"
                                                class="btn-product-icon btn-cart fal fa-shopping-bag"
                                                title="Add to cart"></a>
                                            <a wire:click="add_to_wishlist({{ $product->id }})" style="cursor:pointer"
                                                class="btn-product-icon btn-wishlist w-icon-heart"
                                                title="Add to wishlist"></a>
                                            <a wire:click="show_modal({{ $product->id }})" style="cursor:pointer"
                                                class="btn-product-icon btn-quickview w-icon-search"
                                                title="Quickview"></a>
                                            <a wire:click="add_to_compare({{ $product->id }})" style="cursor:pointer"
                                                class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a style="cursor:pointer"
                                                wire:click.prevent="showproduct({{ $product->id}})">{{ $product->name
                                                }}</a>
                                        </h4>
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
                                            <a href="product-default.html" class="rating-reviews">({{
                                                count($product->products_rates) }}Reviews)</a>
                                        </div>
                                        <div class="product-price">
                                            <ins class="new-price">${{ @$product->latestProductStock->selling_price}}
                                            </ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach
                            @endforeach


                        </div>
                        {{-- <div class="swiper-pagination"></div> --}}
                    </div>
                    <!-- End of Swiper -->
                </div>
            </div>

            <div class="banner br-sm banner-electronics appear-animate" style="background-image: url({{ url('site/images/demos/demo2/banners/3.jpg') }});
            background-color: #333;">
                <div class="banner-content mr-10 pr-1">
                    <div class="banner-price-info text-white font-weight-normal ls-25">
                        Save Big on <span class=" text-secondary text-uppercase">50% Off</span>
                    </div>
                    <h3 class="banner-title text-white mb-0 ls-25">Cameras and Leans Sale</h3>
                </div>
                <a href="shop-both-sidebar.html" class="btn btn-white btn-rounded btn-icon-right mt-1">Shop Now<i
                        class="w-icon-long-arrow-right"></i></a>
            </div>
            @endforeach
            @endif
            <!-- End of Category Wrapper -->


            <!-- End of Banner -->

            <div class="title-link-wrapper mb-2 appear-animate">
                <h2 class="title">Top Rated Products</h2>
                <a href="{{ route('trader.top_rated') }}" class="font-weight-bold ls-25">More Products<i
                        class="w-icon-long-arrow-right"></i></a>
            </div>

            <div class="top-products mb-6 appear-animate">
                <div class="owl-carousel custom-nav deals-slider">
                    @if(isset($top_rated_products))
                    @foreach ($top_rated_products as $top_rated)
                    <div class="product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a  href="" wire:click="showproduct({{ $top_rated->id }})">
                                    <img src="{{ img_chk_exist($top_rated->img) }}" alt="Product"  
                                        >
                                    @if(isset($newarrival->products_gallaries))
                                    @foreach($newarrival->products_gallaries as $gallary)
                                    <img src="{{ img_chk_exist( $gallary->path )}}" alt="Product"  
                                         >
                                    @break
                                    @endforeach
                                    @endif
                                </a>
                                <div class="product-label-group">
                                    @if ( $top_rated->discount)
                                    <label class="product-label label-discount">-{{ $top_rated->discount }}%</label>

                                    @endif
                                </div>
                                <div class="product-action-vertical">
                                    <a wire:click="add_cart({{ $top_rated->id }})" style="cursor:pointer"
                                        class="btn-product-icon btn-cart fal fa-shopping-bag" title="Add to cart"></a>
                                    <a wire:click="add_to_wishlist({{ $top_rated->id }})" style="cursor:pointer"
                                        class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    <a wire:click="show_modal({{ $top_rated->id }})" style="cursor:pointer"
                                        class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                    <a wire:click="add_to_compare({{ $top_rated->id }})" style="cursor:pointer"
                                        class="btn-product-icon  fal fa-repeat" title="Add to Compare"></a>
                                </div>
                                {{-- <div class="product-countdown-container">
                                    <div class="product-countdown countdown-compact" data-until="2021, 9, 9"
                                        data-format="DHMS" data-compact="false"
                                        data-labels-short="Days, Hours, Mins, Secs">
                                        00:00:00:00</div>
                                </div> --}}
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name"><a style="cursor:pointer"
                                        wire:click="showproduct({{ $top_rated->id }})">{{
                                        $top_rated->name }}</a></h4>
                                <div class="ratings-container">
                                    @php
                                    $count=0;
                                    $sumcount=0;
                                    @endphp
                                    @if(isset($top_rated->products_rates))
                                    @foreach ($top_rated->products_rates as $rating)

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
                                    <a href="product-default.html" class="rating-reviews">({{
                                        count($top_rated->products_rates) }}Reviews)</a>
                                </div>
                                <div class="product-price">
                                    <ins class="new-price">${{ @$top_rated->latestProductStock->selling_price}}
                                    </ins>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif


                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- End of Swiper Container -->

            <h2 class="title text-left text-capitalize mb-5 appear-animate">Your Recent Views</h2>
            <div class="appear-animate viewed-products mb-7">
                <div class="owl-carousel custom-nav deals-slider-sss">
                    @if($top_views)
                    @foreach ($top_views as $top_view)
                    <div class="product-wrap">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a style="cursor:pointer" wire:click="showproduct({{ $top_view->id }})">
                                    <img src="{{ img_chk_exist($top_view->img) }}"
                                        alt="Category image"   style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a style="cursor:pointer" wire:click="showproduct({{ $top_view->id }})">{{
                                    $top_view->name }}</a>
                            </h4>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    <!-- End of Product Wrap -->

                    <!-- End of Product Wrap -->

                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- End of Swiper Container -->

            {{--  <h2 class="title text-left mb-5 appear-animate">Our Clients</h2>
            <div class="swiper-container swiper-theme brands-wrapper br-sm mb-10 appear-animate"
                data-swiper-options="{
                'loop': true,
                'spaceBetween': 20,
                'slidesPerView': 2,
                'autoplay': {
                    'delay': 4000,
                    'disableOnInteraction': false
                },
                'breakpoints': {
                    '576': {
                        'slidesPerView': 3
                    },
                    '768': {
                        'slidesPerView': 4
                    },
                    '992': {
                        'slidesPerView': 6
                    },
                    '1200': {
                        'slidesPerView': 8
                    }
                }
            }" style="height: 60px">
                <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-2">
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/brands/1.png') }}" alt="Brand"   />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/brands/2.png') }}" alt="Brand"   />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/brands/3.png') }}" alt="Brand"   />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/brands/4.png') }}" alt="Brand"   />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/brands/5.png') }}" alt="Brand"   />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/brands/6.png') }}" alt="Brand"   />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/brands/7.png') }}" alt="Brand"   />
                        </figure>
                    </div>
                    <div class="swiper-slide">
                        <figure>
                            <img src="{{ url('site/images/demos/demo2/brands/8.png') }}" alt="Brand"   />
                        </figure>
                    </div>
                </div>
            </div>  --}}
            <!-- End of Brands Wrapper -->

            <h2 class="title text-left mb-5 pt-1 appear-animate">From Our Blog</h2>
            <div class="post-wrapper mb-10 mb-lg-5 appear-animate" >
                <div class="blogs-slider owl-carousel custom-nav">
                    <div class="post">
                        <figure class="post-media br-sm">
                            <a href="{{ route('trader.blog') }}">
                                <img src="site/images/demos/demo2/blog/1.jpg" alt="Post" 
                                    style="background-color: #898078;">
                            </a>
                            <div class="post-calendar">
                                <span class="post-day">05</span>
                                <span class="post-month">Mar</span>
                            </div>
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">We want to be different, and Fashion
                                    gives
                                    me that outlet to do</a></h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="post">
                        <figure class="post-media br-sm">
                            <a href="{{ route('trader.blog') }}">
                                <img src="site/images/demos/demo2/blog/2.jpg" alt="Post"    
                                    style="background-color: #EDEFEE;">
                            </a>
                            <div class="post-calendar">
                                <span class="post-day">14</span>
                                <span class="post-month">Mar</span>
                            </div>
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">Explore Fashion For Women In</a></h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip
                                    isic ing elit, sed do eiusmod.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="post">
                        <figure class="post-media br-sm">
                            <a href="{{ route('trader.blog') }}">
                                <img src="site/images/demos/demo2/blog/3.jpg" alt="Post"    
                                    style="background-color: #A1A09E;">
                            </a>
                            <div class="post-calendar">
                                <span class="post-day">25</span>
                                <span class="post-month">Mar</span>
                            </div>
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">Fashion tells about who you are from
                                    external point of view</a></h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="post">
                        <figure class="post-media br-sm">
                            <a href="{{ route('trader.blog') }}">
                                <img src="site/images/demos/demo2/blog/4.jpg" alt="Post"    
                                    style="background-color: #EDF1F2;">
                            </a>
                            <div class="post-calendar">
                                <span class="post-day">16</span>
                                <span class="post-month">Mar</span>
                            </div>
                        </figure>
                        <div class="post-details">
                            <h4 class="post-title"><a href="post-single.html">Just found the ultimate denim
                                    dresses</a>
                            </h4>
                            <div class="post-content">
                                <p>Lorem ipsum dolor sit amet conse ctetur adip
                                    isic ing elit, sed do eiusmod.</p>
                            </div>
                            <a href="post-single.html" class="btn btn-link btn-dark btn-underline">Read More<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Container -->
    </main>
@if(isset($_SESSION['subscribe-show']))
    <!-- End of Main -->
    <div class="cnt223">
        <div class="cnt-layer"></div>
        <div class="newsletter-popup">

            <span class="close-it"><i class="fal fa-times"></i></span>

            <div class="newsletter-content">
                <h4 class="text-uppercase font-weight-normal ls-25">Get Up to<span class="text-primary">25% Off</span>
                </h4>
                <h2 class="ls-25">Sign up to Octopios</h2>
                <p class="text-light ls-10">Subscribe to the Octopios market newsletter to receive updates on special
                    offers.</p>
                    <form wire:submit.prevent="subscribe" class="input-wrapper input-wrapper-inline input-wrapper-round">
                        <input type="email" class="form-control email font-size-md"  id="email2"
                            placeholder="Your email address" wire:model="subemail">
                            
                        <button class="btn btn-dark" >SUBMIT</button>
                        
                    </form>
                    @error('subemail')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                <div class="form-checkbox d-flex align-items-center">
                    <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup"
                        name="hide-newsletter-popup" required="" />
                    <label for="hide-newsletter-popup" class="font-size-sm text-light">Dont show this popup
                        again.</label>
                </div>
            </div>
        </div>
       
    </div>
 @endif
    

</div>


</div>




