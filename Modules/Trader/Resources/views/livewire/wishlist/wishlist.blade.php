@section('header')
{{--  <link rel="stylesheet" type="text/css" href="{{ url('site/css/style.min.css') }}">  --}}

@endsection
<main class="main wishlist-page">
    <!-- Start of Page Header -->
    {{--  <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Wishlist</h1>
        </div>
    </div>  --}}
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
   
    <nav class="breadcrumb-nav mb-10">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Wishlist</li>
            </ul>
        </div>
    </nav>
 
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            <h3 class="wishlist-title">My wishlist</h3>
            @if(count($wishlists))
            <table class="shop-table wishlist-table">
                <thead>
                    <tr>
                        <th class="product-name"><span>Product</span></th>
                        <th></th>
                        <th class="product-price"><span>Price</span></th>
                        <th class="product-stock-status"><span>Stock Status</span></th>
                        <th class="wishlist-action">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlists as $wishlist)
                    <tr>
                        <td class="product-thumbnail">
                            <div class="p-relative">
                                <a wire:click="showproduct({{ $wishlist->product->id}})">
                                    <figure>
                                        <img src="{{ img_chk_exist($wishlist->product->img) }}" alt="product" width="300"
                                            height="338">
                                    </figure>
                                </a>
                                <button type="submit" wire:click="delete_favo({{ $wishlist->id }})" class="btn btn-close"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </td>
                        <td class="product-name">
                            <a href="{{ route('trader.product',$wishlist->product->id) }}">
                               {{ $wishlist->product->name }}
                            </a>
                        </td>
                        
                            <td class="product-price">                           
                            ${{ @$wishlist->product->latestProductStock->selling_price }} 

                           
                    </td>
                        <td class="product-stock-status">
                            @if($wishlist->product->latestProductStock->stock)
                            <span class="wishlist-in-stock">In Stock</span>
                            @else
                            <span class="wishlist-in-stock" style="color: black">Out Stock</span>
                            @endif
                        </td>
                        <td class="wishlist-action">
                            <div class="d-lg-flex">
                                <a wire:click="show_modal({{ $wishlist->product->id }})"
                                    class="btn  btn-outline btn-default btn-rounded btn-sm mb-2 mb-lg-0">Quick
                                    View</a>
                                <a wire:click="add_cart({{ $wishlist->product->id }})" class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                                    cart</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
            @else
            <main class="main">
              
                <!-- Start of Page Content -->
                <div class="page-content error-404">
                    <div class="container">
                        <div class="banner">
                            <figure style="width:200px; height:100px">
                                <img src="{{ url('site/images/pages/404.png') }}" alt="Error 404"  
                                    width="" height="" />
                            </figure>
                            <div class="banner-content text-center">
                                <h2 class="banner-title">
                                    <span class="text-secondary">Wishlists Not Found!!!</span> 
                                </h2>
                                <a href="{{ route('home') }}" class="btn btn-dark btn-rounded btn-icon-right">Go Back Home<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Page Content -->
            </main>
          
            @endif
            <div class="social-links">
                <label>Share On:</label>
                <div class="social-icons social-no-color border-thin">
                    <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                    <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                    <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                    <a href="#" class="social-icon social-email far fa-envelope"></a>
                    <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-quick fade">

        <div class="modal-overlay"></div>
        <div class="product product-single product-popup">

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                    class="fal fa-times"></i></button>
            @if(isset($the_modal))


            <div class="row gutter-lg">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="product-gallery product-gallery-sticky">
                        <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                            <div class="swiper-wrapper row cols-1 gutter-no">
                                <div class="swiper-slide">
                                    <figure class="product-image">

                                        <img src="{{ img_chk_exist(@$the_modal->img) }}"
                                            data-zoom-image="{{ img_chk_exist(@$the_modal->img) }}"
                                            alt="Water Boil Black Utensil" width="800" height="900"
                                            style="height:430px" />

                                    </figure>
                                </div>
                                @if(isset($the_modal->products_gallaries))
                                @foreach ($the_modal->products_gallaries as $gallary )
                                <div class="swiper-slide">
                                    <figure class="product-image">
                                        <img src="{{ img_chk_exist(@$gallary->path) }}"
                                            data-zoom-image="{{ img_chk_exist(@$gallary->path) }}"
                                            alt="{{ @$the_modal->name }}" width="488" style="height:550px" height="549">
                                    </figure>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <button class="swiper-button-next"></button>
                            <button class="swiper-button-prev"></button>
                        </div>
                        <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                    'navigation': {
                        'nextEl': '.swiper-button-next',
                        'prevEl': '.swiper-button-prev'
                    }
                }">
                            <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                @if(isset($the_modal->products_gallaries))
                                @foreach ($the_modal->products_gallaries as $gallary )
                                <div class="product-thumb swiper-slide">
                                    <img src="{{ img_chk_exist(@$gallary->path) }}" alt="Product Thumb" width="800"
                                        height="900" style="height: 130px">
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <button class="swiper-button-next"></button>
                            <button class="swiper-button-prev"></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 overflow-hidden p-relative">
                    <div class="product-details scrollable pl-0">
                        <h2 class="product-title">Electronics Black Wrist Watch</h2>
                        <div class="product-bm-wrapper">
                            <figure class="brand">
                                <img src="{{ img_chk_exist(@$the_modal->category->img) }}" alt="Product" width="138"
                                    height="138" style="height:290px" />
                            </figure>
                            <div class="product-meta">
                                <div class="product-categories">
                                    Category:
                                    <span class="product-category"><a href="#">{{ @$the_modal->category->name
                                            }}</a></span>
                                </div>
                                <div class="product-sku">SKU: <span>MS46891340</span></div>
                            </div>
                        </div>

                        <hr class="product-divider" />

                        <div class="product-price">$40.00</div>

                        <div class="ratings-container">
                            <div class="ratings-full">
                                <span class="ratings" style="width: 80%;"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <a href="#" class="rating-reviews">(3 Reviews)</a>
                        </div>

                        <div class="product-short-desc">
                            <ul class="list-type-check list-style-none">
                                <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                                <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                                <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                            </ul>
                        </div>

                        <hr class="product-divider" />
                        @if(isset($the_modal->attributes))
                        @foreach ($the_modal->attributes as $attributes )

                        <div class="product-form product-variation-form product-size-swatch">
                            <label class="mb-1">{{ $attributes->name }}:</label>
                            <div class="flex-wrap d-flex align-items-center product-variations">
                                @foreach ($attributes->attribute_values as $attribute_values)
                                <a href="#" class="size">{{ $attribute_values->name }}</a>
                                @endforeach

                            </div>
                            <a href="#" class="product-variation-clean">Clean All</a>
                        </div>

                        @endforeach
                        @endif
                        <div class="product-variation-price">
                            <span></span>
                        </div>

                        <div class="product-form">
                            <div class="product-qty-form">
                                <div class="input-group">
                                    <input class="quantity form-control" type="number" min="1" max="10000000" />
                                    <button class="quantity-plus w-icon-plus"></button>
                                    <button class="quantity-minus w-icon-minus"></button>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-cart">
                                <i class="fal fa-shopping-bag"></i>
                                <span>Add to Cart</span>
                            </button>
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
                                <a href="#" class="btn-product-icon btn-wishlist fal fa-heart"><span></span></a>
                                <a href="#" class="btn-product-icon  btn-icon-left fal fa-repeat"><span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
    <!-- End of PageContent -->
</main>


