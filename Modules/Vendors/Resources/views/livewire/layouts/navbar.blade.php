<div>

    <div class="page-wrapper">
        <!-- Start of Header -->
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left no-desk">
                        <p class="welcome-msg">Welcome to Octopios Marketplace</p>
                    </div>
                    <div class="header-right pr-0">
                        {{--  <div class="dropdown">
                            <a href="#currency">USD</a>
                            <div class="dropdown-box">
                                <a href="#USD">USD</a>
                                <a href="#EUR">EUR</a>
                            </div>
                        </div>  --}}
                        <!-- End of DropDown Menu -->

                        <div class="dropdown">
                            <a href="#language"><img src="{{url('site/images/flags/eng.png')}}" alt="ENG Flag" width="14" height="8" class="dropdown-image" /> ENG</a>
                            <div class="dropdown-box">
                                <a href="#ENG">
                                    <img src="{{url('site/images/flags/eng.png')}}" alt="ENG Flag" width="14" height="8" class="dropdown-image" />
                                    ENG
                                </a>
                                <a href="#FRA">
                                    <img src="{{url('site/images/flags/fra.png')}}" alt="FRA Flag" width="14" height="8" class="dropdown-image" />
                                    FRA
                                </a>
                            </div>
                        </div>
                        <!-- End of Dropdown Menu -->
                        <span class="divider"></span>

                       @if ($user)
                        {{-- <a href="url('/vendor/logout')"  --}}
                        <span><i class="w-icon-account"></i>{{ $user->name }}</span>

                            <a wire:click="logout"> <i class="w-icon-account"></i> Logout</a>
                        {{-- a>  --}}
                        @else
                        <a href="{{ url('/vendors/login') }}" class="">
                            <i class="w-icon-account"></i>Sign In</a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="{{ url('/vendors/login') }}" class="">Register</a>

                        @endif
                    </div>
                </div>
            </div>
            <!-- End of Header Top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left mr-md-4">
                        <a href="#" class="mobile-menu-toggle w-icon-hamburger" aria-label="menu-toggle"> </a>
                        <a href="{{ url('/') }}" class="logo ml-lg-0">
                            <img src="{{url('site/images/logo.png')}}" alt="logo" />
                        </a>

                        <form  class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper mr-4 ml-4">

                            <div class="select-box">
                                <select wire:model="category_id" id="category" name="category">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>

                                    @endforeach

                                </select>
                            </div>
                            <input wire:model="search_input" type="text" class="form-control" name="search" id="search" placeholder="Search in..." required />
                            <button wire:click="search" class="btn btn-search" ><i class="w-icon-search"></i></button>
                        </form>
                    </div>
                    <div class="header-right ml-4">
                        <div class="header-call d-xs-show d-lg-flex align-items-center">
                            <a href="tel:#" class="fal fa-headset"></a>
                            <div class="call-info d-xl-show">
                                <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                    <span class="text-capitalize">Call us now</span>
                                </h4>
                                <a href="tel:#" class="phone-number ls-50">0800123456</a>
                            </div>
                        </div>
                        {{--  <a class="wishlist label-down link d-xs-show" href="wishlist.html">
                            <i class="fal fa-heart"></i>
                            <span class="wishlist-label d-lg-show">Wishlist</span>
                        </a>
                        <a class="compare label-down link d-xs-show" href="compare.html">
                            <i class="fal fa-repeat"></i>
                            <span class="compare-label d-lg-show">Compare</span>
                        </a>
                          <div class="dropdown cart-dropdown mr-0 mr-lg-2">
                            <div class="cart-overlay"></div>
                            <a href="#" class="cart-toggle label-down link">
                                <i class="fal fa-shopping-bag">
                                    <span class="cart-count">2</span>
                                </i>
                                <span class="cart-label">Cart</span>
                            </a>
                            <div class="dropdown-box">
                                <div class="products">
                                    <div class="product product-cart">
                                        <div class="product-detail">
                                            <a href="shop-both-sidebar.html" class="product-name">
                                                Beige knitted elas<br />
                                                tic runner shoes
                                            </a>
                                            <div class="price-box">
                                                <span class="product-quantity">1</span>
                                                <span class="product-price">$25.68</span>
                                            </div>
                                        </div>
                                        <figure class="product-media">
                                            <a href="shop-both-sidebar.html">
                                                <img src="{{url('site/images/cart/product-1.jpg')}}" alt="product" height="84" width="94" />
                                            </a>
                                        </figure>
                                        <button class="btn btn-link btn-close" aria-label="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="product product-cart">
                                        <div class="product-detail">
                                            <a href="shop-both-sidebar.html" class="product-name">
                                                Blue utility pina<br />
                                                fore denim dress
                                            </a>
                                            <div class="price-box">
                                                <span class="product-quantity">1</span>
                                                <span class="product-price">$32.99</span>
                                            </div>
                                        </div>
                                        <figure class="product-media">
                                            <a href="shop-both-sidebar.html">
                                                <img src="{{url('site/images/cart/product-2.jpg')}}" alt="product" width="84" height="94" />
                                            </a>
                                        </figure>
                                        <button class="btn btn-link btn-close" aria-label="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="cart-total">
                                    <label>Subtotal:</label>
                                    <span class="price">$58.67</span>
                                </div>

                                <div class="cart-action">
                                    <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                                    <a href="checkout.html" class="btn btn-primary btn-rounded">Checkout</a>
                                </div>
                            </div>
                            <!-- End of Dropdown Box -->
                        </div>  --}}
                    </div>
                </div>
            </div>
            <!-- End of Header Middle -->

            <div class="header-bottom sticky-content fix-top sticky-header">
                <div class="container">
                    <div class="inner-wrap no-withstick">
                        <div class="header-left flex-1">
                            {{--  <div class="dropdown category-dropdown has-border" data-visible="true">
                                <a href="#" class="category-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>

                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu">
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-tshirt2"></i>Fashion </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <h4 class="menu-title">Women</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">New Arrivals</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Best Sellers</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Trending</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Clothing</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Shoes</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Bags</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Accessories</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Jewlery & Watches</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <h4 class="menu-title">Men</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">New Arrivals</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Best Sellers</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Trending</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Clothing</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Shoes</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Bags</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Accessories</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Jewlery & Watches</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <div class="banner-fixed menu-banner menu-banner2">
                                                        <figure>
                                                            <img src="{{url('site/images/menu/banner-2.jpg')}}" alt="Menu Banner" width="235" height="347" />
                                                        </figure>
                                                        <div class="banner-content">
                                                            <div class="banner-price-info mb-1 ls-normal">
                                                                Get up to
                                                                <strong class="text-primary text-uppercase">20%Off</strong>
                                                            </div>
                                                            <h3 class="banner-title ls-normal">Hot Sales</h3>
                                                            <a href="shop-banner-sidebar.html" class="btn btn-dark btn-sm btn-link btn-slide-right btn-icon-right"> Shop Now<i class="w-icon-long-arrow-right"></i> </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-home"></i>Home & Garden </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <h4 class="menu-title">Bedroom</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Beds, Frames & Bases</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Dressers</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Nightstands</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Kids Beds & Headboards</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Armoires</a></li>
                                                    </ul>

                                                    <h4 class="menu-title mt-1">Living Room</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Coffee Tables</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Chairs</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Tables</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Futons & Sofa Beds</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Cabinets & Chests</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <h4 class="menu-title">Office</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Office Chairs</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Desks</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Bookcases</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">File Cabinets</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Breakroom Tables</a></li>
                                                    </ul>

                                                    <h4 class="menu-title mt-1">Kitchen & Dining</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Dining Sets</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Kitchen Storage Cabinets</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Bashers Racks</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Dining Chairs</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Dining Room Tables</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Bar Stools</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <div class="menu-banner banner-fixed menu-banner3">
                                                        <figure>
                                                            <img src="{{url('site/images/menu/banner-3.jpg')}}" alt="Menu Banner" width="235" height="461" />
                                                        </figure>
                                                        <div class="banner-content">
                                                            <h4 class="banner-subtitle font-weight-normal text-white mb-1">
                                                                Restroom
                                                            </h4>
                                                            <h3 class="banner-title text-white ls-normal">
                                                                Furniture Sale
                                                            </h3>
                                                            <div class="banner-price-info text-white font-weight-normal ls-25">Up to <span class="text-secondary text-uppercase">25% Off</span></div>
                                                            <a href="shop-banner-sidebar.html" class="btn btn-white btn-link btn-sm btn-slide-right btn-icon-right"> Shop Now<i class="w-icon-long-arrow-right"></i> </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-electronics"></i>Electronics </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <h4 class="menu-title">Laptops &amp; Computers</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Desktop Computers</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Monitors</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Laptops</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Hard Drives &amp; Storage</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Computer Accessories</a></li>
                                                    </ul>

                                                    <h4 class="menu-title mt-1">TV &amp; Video</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">TVs</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Home Audio Speakers</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Projectors</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Media Streaming Devices</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <h4 class="menu-title">Digital Cameras</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Digital SLR Cameras</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Sports & Action Cameras</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Camera Lenses</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Photo Printer</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Digital Memory Cards</a></li>
                                                    </ul>

                                                    <h4 class="menu-title mt-1">Cell Phones</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Carrier Phones</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Unlocked Phones</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Phone & Cellphone Cases</a></li>
                                                        <li><a href="shop-both-sidebar.html" title="Octopios">Cellphone Chargers</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <div class="menu-banner banner-fixed menu-banner4">
                                                        <figure>
                                                            <img src="{{url('site/images/menu/banner-4.jpg')}}" alt="Menu Banner" width="235" height="433" />
                                                        </figure>
                                                        <div class="banner-content">
                                                            <h4 class="banner-subtitle font-weight-normal">Deals Of The Week</h4>
                                                            <h3 class="banner-title text-white">Save On Smart EarPhone</h3>
                                                            <div class="banner-price-info text-secondary text-uppercase text-secondary">
                                                                20% Off
                                                            </div>
                                                            <a href="shop-banner-sidebar.html" class="btn btn-white btn-outline btn-sm btn-rounded">Shop Now</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-furniture"></i>Furniture </a>
                                            <ul class="megamenu type2">
                                                <li class="row">
                                                    <div class="col-md-3 col-lg-3 col-6">
                                                        <h4 class="menu-title">Furniture</h4>
                                                        <hr class="divider" />
                                                        <ul>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Sofas & Couches</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Armchairs</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Bed Frames</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Beside Tables</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Dressing Tables</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6">
                                                        <h4 class="menu-title">Lighting</h4>
                                                        <hr class="divider" />
                                                        <ul>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Light Bulbs</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Lamps</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Celling Lights</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Wall Lights</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Bathroom Lighting</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6">
                                                        <h4 class="menu-title">Home Accessories</h4>
                                                        <hr class="divider" />
                                                        <ul>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Decorative Accessories</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Candals & Holders</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Home Fragrance</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Mirrors</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Clocks</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6">
                                                        <h4 class="menu-title">Garden & Outdoors</h4>
                                                        <hr class="divider" />
                                                        <ul>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Garden Furniture</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Lawn Mowers</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Pressure Washers</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">All Garden Tools</a></li>
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">Outdoor Dining</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-6">
                                                        <div class="banner banner-fixed menu-banner5 br-xs">
                                                            <figure>
                                                                <img src="{{url('site/images/menu/banner-5.jpg')}}" alt="Banner" width="410" height="123" style="background-color: #d2d2d2;" />
                                                            </figure>
                                                            <div class="banner-content text-right y-50">
                                                                <h4 class="banner-subtitle font-weight-normal text-default text-capitalize">
                                                                    New Arrivals
                                                                </h4>
                                                                <h3 class="banner-title text-capitalize ls-normal">
                                                                    Amazing Sofa
                                                                </h3>
                                                                <div class="banner-price-info font-weight-normal ls-normal">Starting at <strong>$125.00</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="banner banner-fixed menu-banner5 br-xs">
                                                            <figure>
                                                                <img src="{{url('site/images/menu/banner-6.jpg')}}" alt="Banner" width="410" height="123" style="background-color: #9f9888;" />
                                                            </figure>
                                                            <div class="banner-content y-50">
                                                                <h4 class="banner-subtitle font-weight-normal text-white text-capitalize">
                                                                    Best Seller
                                                                </h4>
                                                                <h3 class="banner-title text-capitalize text-white ls-normal">
                                                                    Chair &amp; Lamp
                                                                </h3>
                                                                <div class="banner-price-info font-weight-normal ls-normal text-white">From <strong>$165.00</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-heartbeat"></i>Healthy & Beauty </a>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-gift"></i>Gift Ideas </a>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-gamepad"></i>Toy & Games </a>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-ice-cream"></i>Cooking </a>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-ios"></i>Smart Phones </a>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-camera"></i>Cameras & Photo </a>
                                        </li>
                                        <li>
                                            <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-ruby"></i>Accessories </a>
                                        </li>
                                        <li>
                                            <a href="shop-banner-sidebar.html" class="text-primary text-uppercase ls-25"> View All Categories<i class="w-icon-angle-right"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>  --}}
                            @auth
                            <nav class="main-nav">
                                <ul class="menu">
                                    {{-- <li wire:click="active(1)" class="{{$active1}}">
                                    <a href="{{ url('/vendors/myaccount') }}">dashboard</a>
                                    </li> --}}
                                    <li class="">
                                        <a href="{{ url('/vendors/myaccount') }}">dashboard</a>
                                    </li>
                                    {{-- <li  class="">
                                        <a href="{{ url('/vendors/myproducts') }}">my products</a>
                                    </li> --}}
                                    <li class="">
                                        <a href="{{ url('/vendors/stocks-products') }}">Stocks Products</a>
                                    </li>
                                    <li class="">
                                        <a href="{{ url('/vendors/legall-affairs') }}"> legal data</a>
                                    </li>
                                    <li class="">
                                        <a href="{{ url('/vendors/orders-state') }}"> orders</a>
                                    </li>


                                    {{-- <li>
                                        <a href="shop-both-sidebar.html" title="Octopios">Shop</a>

                                        <!-- Start of Megamenu -->
                                        <ul class="megamenu">
                                            <li>
                                                <h4 class="menu-title">Shop Category</h4>
                                                <ul>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Shop Category</h4>
                                                <ul>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Shop Category</h4>
                                                <ul>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Shop Category</h4>
                                                <ul>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                    <li><a href="shop-both-sidebar.html" title="Octopios">Name Of Products</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- End of Megamenu -->
                                    </li>
                                    <li>
                                        <a href="manufacturer.html">Manufacturer</a>
                                    </li>
                                    <li>
                                        <a href="freelancer.html">Freelancer</a>
                                    </li>
                                    <li>
                                        <a href="saller.html">Become A Seller</a>
                                    </li>
                                    <li>
                                        <a href="quote.html">Request A Quote</a>
                                    </li>  --}}
                                </ul>
                            </nav>

                            @endauth


                        </div>

                        {{--  <div class="header-right pr-0 ml-4">
                            <a href="#" class="d-xl-show mr-6"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                            <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                        </div>  --}}
                    </div>

                    <div class="inner-wrap no-outstick">
                        <div class="header-left flex-1">
                            <a href="{{ url('/') }}" class="logo ml-lg-0">
                                <img src="{{url('site/images/logo-white.png')}}" alt="logo" />
                            </a>

                            <form method="get" action="#" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper mr-4 ml-4">
                                <div class="select-box">
                                    <select id="category" name="category">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>

                                        @endforeach

                                    </select>
                                </div>
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search in..." required />
                                <button class="btn btn-search" type="submit"><i class="w-icon-search"></i></button>
                            </form>

                            <div class="header-right pr-0 ml-4">
                                {{--  <div class="dropdown">
                                    <a href="#currency">USD</a>
                                    <div class="dropdown-box">
                                        <a href="#USD">USD</a>
                                        <a href="#EUR">EUR</a>
                                    </div>
                                </div>  --}}
                                <!-- End of DropDown Menu -->

                                <div class="dropdown">
                                    <a href="#language"><img src="{{url('site/images/flags/eng.png')}}" alt="ENG Flag" width="14" height="8" class="dropdown-image" /> ENG</a>
                                    <div class="dropdown-box">
                                        <a href="#ENG">
                                            <img src="{{url('site/images/flags/eng.png')}}" alt="ENG Flag" width="14" height="8" class="dropdown-image" />
                                            ENG
                                        </a>
                                        <a href="#FRA">
                                            <img src="{{url('site/images/flags/fra.png')}}" alt="FRA Flag" width="14" height="8" class="dropdown-image" />
                                            FRA
                                        </a>
                                    </div>
                                </div>
                                @if ($user)
                                {{-- <a href="url('/vendor/logout')"  --}}
                                <span><i class="w-icon-account"></i>{{ $user->name }}</span>

                                    <a wire:click="logout"> <i class="w-icon-account"></i> Logout</a>
                                {{-- a>  --}}
                                @else
                                <a href="{{ url('/vendors/login') }}" class="">
                                    <i class="w-icon-account"></i>Sign In</a>
                                <span class="delimiter d-lg-show">/</span>
                                <a href="{{ url('/vendors/login') }}" class="">Register</a>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End of Header -->

</div>
