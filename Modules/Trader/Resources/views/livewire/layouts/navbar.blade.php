<div>
    <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>
    <!-- Start of Header -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-left no-desk">
                    <p class="welcome-msg">Welcome to Octopios Marketplace</p>
                </div>
                <div class="header-right pr-0">
                    <div class="dropdown">
                        <a href="#currency">USD</a>
                        <div class="dropdown-box">
                            <a href="#USD">USD</a>
                            <a href="#EUR">EUR</a>
                        </div>
                    </div>
                    <!-- End of DropDown Menu -->

                    <div class="dropdown">
                        <a href="#language"><img src="{{url('site/images/flags/eng.png')}}" alt="ENG Flag" width="14"
                                height="8" class="dropdown-image" /> ENG</a>
                        <div class="dropdown-box">
                            <a href="#ENG">
                                <img src="{{ url('site/images/flags/eng.png') }}" alt="ENG Flag" width="14" height="8"
                                    class="dropdown-image" />
                                ENG
                            </a>
                            <a href="#FRA">
                                <img src="{{ url('site/images/flags/fra.png') }}" alt="FRA Flag" width="14" height="8"
                                    class="dropdown-image" />
                                FRA
                            </a>
                        </div>
                    </div>
                    <!-- End of Dropdown Menu -->
                    <span class="divider"></span>
                    @auth('trader')

                    <a href="{{ route('trader.account') }}"><i class="w-icon-account"></i>My Account</a>
                    <div wire:click='logout' style="cursor: pointer" class="d-lg-show login ">
                        <a><i class="fal fa-sign-in"></i> Logout</a>
                    </div>
                    @else
                    <a href="{{ route('trader.loginastrader') }}"><i class="w-icon-account"></i>Sign In</a>
                    <a href="{{ route('trader.loginastrader') }}"><i class="fal fa-sign-in"></i>Register</a>
                    @endauth
                </div>
            </div>
        </div>
        <!-- End
            <!-- End of Header Top -->

        <div class="header-middle">
            <div class="container">
                <div class="header-left mr-md-4">
                    <a href="{{ route('home') }}" class="mobile-menu-toggle w-icon-hamburger" aria-label="menu-toggle">
                    </a>
                    <a href="{{ route('home') }}" class="logo ml-lg-0">
                        <img src="{{ url('site/images/logo.png') }}" alt="logo" />
                    </a>

                    <form wire:submit="search"
                        class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper mr-4 ml-4">
                        <div class="select-box">
                            <select id="category" wire:model="category">
                                <option value="vendors">sellers</option>
                                <option value="freelancers">freelancers</option>
                                <option value="products">products</option>

                            </select>
                        </div>
                        <input type="text" class="form-control" wire:model="valuesearch" id="search"
                            placeholder="Search in..." />

                        <button class="btn btn-search" type="submit"><i class="w-icon-search"></i></button>
                    </form>

                </div>
                @error('valuesearch')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="header-right ml-4">
                    <div class="header-call d-xs-show d-lg-flex align-items-center">
                        <a href="tel:#" class="fal fa-headset"></a>
                        <div class="call-info d-xl-show">
                            <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                <span class="text-capitalize">Call us now</span>
                            </h4>
                            <a href="tel:#" class="phone-number ls-50">90123456789</a>
                        </div>
                    </div>
                    @auth('trader')
                    <a class="wishlist label-down link d-xs-show" href="{{ route('trader.wishlist') }}">
                        <i class="fal fa-heart"></i>
                        <span class="wishlist-label d-lg-show">Wishlist</span>
                    </a>
                    @endauth
                    <a class="compare label-down link d-xs-show" href="{{ route('trader.compare') }}">
                        <i class="fal fa-repeat"></i>
                        <span class="compare-label d-lg-show">Compare</span>
                    </a>
                    <div class="dropdown cart-dropdown mr-0 mr-lg-2">
                        <div class="cart-overlay"></div>
                        <a href="{{ route('trader.cart') }}" class="cart-toggle label-down link" wire:poll>
                            <i class="fal fa-shopping-bag">
                                <span class="cart-count">{{ @$trader_orders->count() }}</span>
                            </i>
                            <span class="cart-label">Cart</span>
                        </a>
                        {{-- <div class="dropdown-box">
                            @php

                            $total =0;
                            @endphp
                            @if(isset($trader_orders))
                            @foreach($trader_orders as $order)
                            <div class="products">
                                <div class="product product-cart">
                                    <div class="product-detail">
                                        <a href="shop-both-sidebar.html" class="product-name">
                                            {{@$order->name}} <br />
                                        </a>
                                        <div class="price-box">
                                            <span class="product-quantity">{{@$order->quantity}}</span>
                                            <span
                                                class="product-price">${{@$order->product->latestProductStock->selling_price}}</span>
                                        </div>
                                    </div>
                                    <figure class="product-media">
                                        <a href="shop-both-sidebar.html">
                                            <img src="{{ img_chk_exist(@$order->product->img) }}" alt="product"
                                                height="84" width="94" />
                                        </a>
                                    </figure>
                                    <button class="btn btn-link btn-close" wire:click="delete_prod({{@$order->id}})"
                                        aria-label="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @php

                            $total += @$order->total_price;
                            @endphp

                            @endforeach
                            @endif


                            <div class="cart-total">
                                <label>Subtotal:</label>

                                <span class="price">${{ @$total }}</span>
                            </div>

                            <div class="cart-action">
                                <a href="{{ route('trader.cart') }}" class="btn btn-dark btn-outline btn-rounded">View
                                    Cart</a>
                                <a href="{{ route('trader.checkout') }}"
                                    class="btn btn-primary btn-rounded">Checkout</a>
                            </div>
                        </div> --}}
                        <!-- End of Dropdown Box -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Header Middle -->

        <div class="header-bottom sticky-content fix-top sticky-header">
            <div class="container">
                <div class="inner-wrap no-withstick">
                    <div class="header-left flex-1">
                        <div class="dropdown category-dropdown has-border" data-visible="true">
                            <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="true" data-display="static"
                                title="Browse Categories">
                                <i class="w-icon-category"></i>
                                <span>Browse Categories</span>
                            </a>

                            <div class="dropdown-box">
                                <ul class="menu vertical-menu category-menu">
                                    
                                    @foreach ($categories as $category)
                                    <li>
                                        <a href="shop-both-sidebar.html" title="Octopios"> <i class="w-icon-electronics"></i>Electronics </a>
                                        <ul class="megamenu">
                                            <li>
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($category->sub_category as $sub_category)

                                                @if ($i < 3)
                                                    <h4 class="menu-title">{{ $sub_category->name }}</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        @foreach ($sub_category->sub_category as $sub_sub_category)
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">{{ $sub_sub_category->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                @endforeach
                                                @foreach ($category->sub_category as $sub_category)
                                                @if ($i > 3)
                                                    <h4 class="menu-title mt-1">{{ $sub_category->name }}</h4>
                                                    <hr class="divider" />
                                                    <ul>
                                                        @foreach ($sub_category->sub_category as $sub_sub_category)
                                                            <li><a href="shop-both-sidebar.html" title="Octopios">{{ $sub_sub_category->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                        
                                                @php
                                                    $i++;
                                                @endphp
                                                @endforeach
                                            </li>
                                       
                                        
                                            
                                        </ul>
                                    </li>
                                    @endforeach
                                   

                                </ul>
                                </li>
                                
                                </ul>
                            </div>
                        </div>

                        <nav class="main-nav">
                            <ul class="menu">
                                <li class="active">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li>
                                    <a title="Octopios">Shop</a>


                                    <!-- Start of Megamenu -->
                                    <ul class="megamenu">

                                        <div class="megabox">
                                            <a href="{{ route('trader.bestselling') }}" title="Best selling">
                                                <div class="dtr-link">
                                                    <img src="{{ url('site/images/popular.png') }}" alt="">
                                                    <span>Best selling</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="megabox">
                                            <a href="{{ route('trader.mostpopular') }}" title="most popular">
                                                <div class="dtr-link">
                                                    <img src="{{ url('site/images/stars.png') }}" alt="">
                                                    <span>most popular</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="megabox">
                                            <a href="{{ route('trader.newarrival') }}" title="new arrivals">
                                                <div class="dtr-link">
                                                    <img src="{{url('site/images/new-arrival.png')}}" alt="">
                                                    <span>new arrivals</span>
                                                </div>
                                            </a>
                                        </div>



                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('trader.manufacturer') }}">Manufacturer</a>
                                </li>
                                <li>
                                    <a href="{{ route('trader.freelancer') }}">Freelancer</a>
                                </li>
                                <li>
                                    <a href="{{ url('vendors/login') }}">Become A Seller</a>
                                </li>
                                <li>
                                    <a href="{{ route('trader.cart') }}">Request A Quote</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="header-right pr-0 ml-4">
                        @auth('trader')
                        <a href="{{ route('trader.account') }}" class="d-xl-show mr-6"><i
                                class="w-icon-map-marker mr-1"></i>Track
                            Order</a>
                        @endauth
                        <a href="{{ route('trader.newarrival') }}"><i class="w-icon-sale"></i>Daily Deals</a>
                    </div>
                </div>


                <div class="inner-wrap no-outstick">
                    <div class="header-left flex-1">
                        <a href="{{ route('home') }}" class="logo ml-lg-0">
                            <img src="{{ url('site/images/logo-white.png') }}" alt="logo" />
                        </a>

                        <form wire:submit="search"
                            class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper mr-4 ml-4">
                            <div class="select-box">
                                <select id="category" wire:model="category">
                                    <option value="vendors">sellers</option>
                                    <option value="freelancers">freelancers</option>
                                    <option value="products">products</option>

                                </select>
                            </div>
                            <input type="text" class="form-control" wire:model="valuesearch" id="search"
                                placeholder="Search in..." />

                            <button class="btn btn-search" type="submit"><i class="w-icon-search"></i></button>
                        </form>

                        <div class="header-right pr-0 ml-4">
                            <div class="dropdown">
                                <a href="#currency">USD</a>
                                <div class="dropdown-box">
                                    <a href="#USD">USD</a>
                                    <a href="#EUR">EUR</a>
                                </div>
                            </div>
                            <!-- End of DropDown Menu -->

                            <div class="dropdown">
                                <a href="#language"><img src="{{ url('site/images/flags/eng.png') }}" alt="ENG Flag"
                                        width="14" height="8" class="dropdown-image" /> ENG</a>
                                <div class="dropdown-box">
                                    <a href="#ENG">
                                        <img src="{{ url('site/images/flags/eng.png') }}" alt="ENG Flag" width="14"
                                            height="8" class="dropdown-image" />
                                        ENG
                                    </a>
                                    <a href="#FRA">
                                        <img src="{{url('site/images/flags/fra.png')}}" alt="FRA Flag" width="14"
                                            height="8" class="dropdown-image" />
                                        FRA
                                    </a>
                                </div>
                            </div>
                            <!-- End of Dropdown Menu -->
                            <span class="divider d-lg-show"></span>
                            @auth('trader')
                            <a href="{{route('trader.account')}}" class="d-lg-show"><i class="w-icon-account"></i> My
                                Account</a>
                            <div style="margin-left: 10px" wire:click='logout' class="d-lg-show login ">
                                <a><i class="fal fa-sign-in"></i> Logout</a>
                            </div>
                            @else
                            <a href="{{ route('trader.loginastrader') }}" class="d-lg-show"><i
                                    class="w-icon-account"></i>Sign In</a>

                            <a href="{{ route('trader.loginastrader') }}" class="ml-0 d-lg-show"><i
                                    class="fal fa-sign-in"></i>Register</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End of Header -->
</div>