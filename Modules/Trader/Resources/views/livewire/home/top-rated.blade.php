<main class="main">
    <!-- Start of Breadcrumb -->


    <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center"
        style="background-image: url({{url('site/images/shop/banner2.jpg')}}); background-color: #FFC74E;">
        <div class="container banner-content">
            <h4 class="banner-subtitle font-weight-bold">Accessories Collection</h4>
            <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-10">Smart Watches</h3>
        </div>
    </div>


    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-2 pb-2">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Our Products</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <div class="page-content mb-10">

        <!-- End of Shop Banner -->
        <div class="container">
            <!-- Start of Page Content -->
            @if($show)

            <!-- Start of Shop Content -->
            <div class="shop-content row gutter-lg">
                <!-- Start of Sidebar, Shop Sidebar -->
                <aside class="sidebar shop-sidebar left-sidebar sticky-sidebar-wrapper sidebar-fixed">
                    <!-- Start of Sidebar Overlay -->
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" ><i class="close-icon"></i></a>

                    <!-- Start of Sidebar Content -->
                    <div class="sidebar-content scrollable">
                        <!-- Start of Sticky Sidebar -->
                        <div class="sticky-sidebar">
                            <div class="filter-actions">
                                <label>Filter :</label>
                                <a wire:click="clean_all" style="cursor: pointer"
                                    class="btn btn-dark btn-link filter-clean">Clean All</a>
                            </div>
                            <!-- Start of Collapsible widget -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title "><label>All Categories</label></h3>
                                <ul class="widget-body filter-items search-ul">

                                    @if (isset($categories))
                                    @foreach($categories as $category)
                                    <li><a wire:click="show_category({{ $category->id }})" style="cursor:pointer">{{
                                            $category->name }}</a></li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- End of Collapsible Widget -->

                            <!-- Start of Collapsible Widget -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title"><label>Price</label></h3>
                                <div class="widget-body">
                                    <ul class="filter-items search-ul">
                                        <li><a wire:click="filterProducts(0,100)" style="cursor: pointer;">$0.00 -
                                                $100.00</a></li>
                                        <li><a wire:click="filterProducts(100,200)" style="cursor: pointer;">$100.00 -
                                                $200.00</a></li>
                                        <li><a wire:click="filterProducts(200,300)" style="cursor: pointer;">$200.00 -
                                                $300.00</a></li>
                                        <li><a wire:click="filterProducts(300,500)" style="cursor: pointer;">$300.00 -
                                                $500.00</a></li>
                                        <li><a wire:click="filterProducts(500,3000)"
                                                style="cursor: pointer;">$500.00+</a></li>
                                    </ul>
                                    <form class="price-range">
                                        <input type="number" wire:model.live="min_price" class="min_price text-center"
                                            placeholder="$min"><span class="delimiter">-</span><input type="number"
                                            wire:model.live="max_price" class="max_price text-center"
                                            placeholder="$max">
                                    </form>
                                </div>
                            </div>
                            <!-- End of Collapsible Widget -->

                            @if(isset($attributes))
                            @foreach($attributes as $attribute)
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title @if(false) collapsed @endif"><label>{{ $attribute->name }}</label></h3>
                                <ul class="widget-body filter-items item-check  mt-1"> @if ($attribute->attribute_values)
                                    @foreach($attribute->attribute_values as $attribute_values)
                                    <div class="form-checkbox">

                                        <input type="checkbox" class="custom-checkbox" id="{{$attribute_values->name }}" name="{{$attribute_values->name }}" wire:click="getattribute({{ $attribute_values->id }})" >
                                    <label for="{{$attribute_values->name }}">{{$attribute_values->name }}</label>
                                </div>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            @endforeach
                            @endif
                            {{--  <div class="widget widget-collapsible">
                                <h3 class="widget-title collapsed"><label>Brand</label></h3>
                                <ul class="widget-body filter-items item-check mt-1">
                                    <li><a href="#">Elegant Auto Group</a></li>
                                    <li><a href="#">Green Grass</a></li>
                                    <li><a href="#">Node Js</a></li>
                                    <li><a href="#">NS8</a></li>
                                    <li><a href="#">Red</a></li>
                                    <li><a href="#">Skysuite Tech</a></li>
                                    <li><a href="#">Sterling</a></li>
                                </ul>
                            </div>  --}}
                            <!-- End of Collapsible Widget -->


                        </div>
                        <!-- End of Sidebar Content -->
                    </div>
                    <!-- End of Sidebar Content -->
                </aside>
                <!-- End of Shop Sidebar -->

                <!-- Start of Shop Main Content -->
                <div class="main-content">
                    <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <div class="toolbox-left">
                            <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                btn-icon-left d-block d-lg-none"><i
                                    class="w-icon-category"></i><span>Filters</span></a>
                            <div class="toolbox-item toolbox-sort select-box text-dark">
                                <label>Sort By :</label>
                                <select wire:model.live="sortprice" class="form-control">
                                    <option value="asc">Default sorting</option>
                                    {{-- <option value="popularity">Sort by popularity</option> --}}
                                    {{-- <option value="rating">Sort by average rating</option> --}}
                                    <option value="date">Sort by latest</option>
                                    <option value="asc">Sort by pric: low to high</option>
                                    <option value="desc">Sort by price: high to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="toolbox-right">
                            {{--  <div class="toolbox-item toolbox-show select-box">
                                <select wire:model.live="perPage">
                                    <option value="9">Show 9</option>
                                    <option value="12">Show 12</option>
                                    <option value="24">Show 24</option>
                                    <option value="36">Show 36</option>
                                </select>
                            </div>  --}}
                            <div class="toolbox-item toolbox-layout">
                                <a wire:click="grid" class="icon-mode-grid btn-layout @if($show) active @endif"
                                    style="cursor:pointer">
                                    <i class="w-icon-grid"></i>
                                </a>
                                <a wire:click="list" class="icon-mode-list btn-layout @if(!$show) active @endif"
                                    style="cursor:pointer">
                                    <i class=" w-icon-list"></i>
                                </a>
                            </div>
                        </div>
                    </nav>
                    <div class="product-wrapper row cols-xl-5 cols-lg-3 cols-md-4 cols-sm-3 cols-2">

                        @if(isset($products))
                        @foreach ($products as $product )
                        @if($product->latestProductStock)
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="" wire:click="showproduct({{ $product->id}})">
                                        <img src="{{ img_chk_exist($product->img)}}" width="300" style="height: 170px"
                                            height="338" />
                                    </a>
                                    <div class="product-action-horizontal">
                                        <a style="cursor: pointer" wire:click="add_cart({{ $product->id }})"
                                            class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                                        <a style="cursor: pointer" wire:click="add_to_wishlist({{ $product->id }})"
                                            class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>
                                        <a style="cursor: pointer" wire:click="add_to_compare({{ $product->id }})"
                                            class="btn-product-icon w-icon-compare" title="Compare"></a>
                                        <a wire:click="show_modal({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon  w-icon-search" title="Quick View"></a>

                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="product-cat">
                                        <a href="{{ route('trader.category', $product->category->id ) }}">{{ @$product->category->name }}</a>
                                    </div>
                                    <h3 class="product-name">
                                        <a style="cursor: pointer"
                                            wire:click.prevent="showproduct({{ $product->id}})">{{ $product->name }}</a>
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
                                        <a style="cursor: pointer" wire:click.prevent="showproduct({{ $product->id}})"
                                            class="rating-reviews">
                                            ({{ count($product->products_rates) }}Reviews)</a>
                                    </div>
                                    <div class="product-pa-wrapper">
                                        <div class="product-price">
                                            ${{ @$product->latestProductStock->selling_price }}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                      

                    </div>

                    <div class="toolbox toolbox-pagination justify-content-between">
                        <p class="showing-info mb-2 mb-sm-0">
                            Showing
                            <span>
                                {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }}
                            </span>
                            Products
                        </p>
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                    @if(!$products->hasMorePages())
                                    <a class="page-link" style="cursor: pointer" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" aria-label="Previous">

                                    <i class="w-icon-long-arrow-left"></i>
                                </a>
                                    @else
                                    <span class="page-link disabled" aria-label="Next">
                                        <i class="w-icon-long-arrow-left"></i>
                                    </span>
                                @endif
                               
                            </li>
                        
                            {{-- Page Numbers --}}
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" style="cursor: pointer" wire:click="gotoPage({{ $i }})" wire:loading.attr="disabled">{{ $i }}</a>
                                </li>
                            @endfor
                        
                            {{-- Next Page Link --}}
                            <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                                @if($products->hasMorePages())
                                    <a class="page-link" style="cursor: pointer" wire:click="nextPage" wire:loading.attr="disabled" rel="next" aria-label="Next">
                                        <i class="w-icon-long-arrow-right"></i>
                                    </a>
                                @else
                                    <span class="page-link disabled" aria-label="Next">
                                        <i class="w-icon-long-arrow-right"></i>
                                    </span>
                                @endif
                            </li>
                        </ul>
                        
                        
                        
                        
                                      
                                   
                        
                        
                    </div>
                </div>
                <!-- End of Shop Main Content -->


            </div>
            <!-- End of Shop Content -->


            @else


            <!-- Start of Shop Content -->
            <div class="shop-content">
                <!-- Start of Sidebar, Shop Sidebar -->
                <aside class="sidebar shop-sidebar left-sidebar sticky-sidebar-wrapper">
                    <!-- Start of Sidebar Overlay -->
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>


                    <!-- Start of Sidebar Content -->
                    <div class="sidebar-content scrollable">
                        <div class="filter-actions">
                            <label>Filter :</label>
                            <a style="cursor: pointer" wire:click="clean_all" class="btn btn-dark btn-link filter-clean">Clean All</a>
                        </div>
                        <!-- Start of Collapsible widget -->
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>All Categories</span></h3>
                            <ul class="widget-body filter-items search-ul">

                                @if (isset($categories))
                                @foreach($categories as $category)
                                <li><a wire:click="show_category({{ $category->id }})" style="cursor:pointer">{{
                                        $category->name }}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        <!-- End of Collapsible Widget -->

                        <!-- Start of Collapsible Widget -->
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title"><span>Price</span></h3>
                            <div class="widget-body">
                                <ul class="filter-items search-ul">
                                    <li><a wire:click="filterProducts(0,100)" style="cursor: pointer;">$0.00 -
                                            $100.00</a></li>
                                    <li><a wire:click="filterProducts(100,200)" style="cursor: pointer;">$100.00 -
                                            $200.00</a></li>
                                    <li><a wire:click="filterProducts(200,300)" style="cursor: pointer;">$200.00 -
                                            $300.00</a></li>
                                    <li><a wire:click="filterProducts(300,500)" style="cursor: pointer;">$300.00 -
                                            $500.00</a></li>
                                    <li><a wire:click="filterProducts(500,3000)" style="cursor: pointer;">$500.00+</a>
                                    </li>
                                </ul>
                                <form class="price-range">
                                    <input type="number" wire:model.live="min_price" class="min_price text-center"
                                        placeholder="$min"><span class="delimiter">-</span><input type="number"
                                        wire:model.live="max_price" class="max_price text-center" placeholder="$max">
                                </form>
                            </div>
                        </div>
                        <!-- End of Collapsible Widget -->

                        <!-- Start of Collapsible Widget -->
                        @if(isset($attributes))
                        @foreach($attributes as $attribute)
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title"><label>{{ $attribute->name }}</label></h3>
                            <ul class="widget-body filter-items item-check"> @if ($attribute->attribute_values)
                                @foreach($attribute->attribute_values as $attribute_values)
                                <div class="form-checkbox">

                                    <input type="checkbox" class="custom-checkbox" id="{{$attribute_values->name }}" name="{{$attribute_values->name }}" wire:click="getattribute({{ $attribute_values->id }})" >
                                <label for="{{$attribute_values->name }}">{{$attribute_values->name }}</label>
                            </div>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        @endforeach
                        @endif
                        <!-- End of Collapsible Widget -->
                    </div>
                    <!-- End of Sidebar Content -->
                </aside>
                <!-- End of Shop Sidebar -->

                <!-- Start of Shop Main Content -->
                <div class="main-content">
                    <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <div class="toolbox-left">
                            <a style="cursor: pointer" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                btn-icon-left"><i class="w-icon-category"></i><span>Filters</span></a>
                            <div class="toolbox-item toolbox-sort select-box text-dark">
                                <label>Sort By :</label>
                                <select wire:model.live="orderby" class="form-control">
                                    <option value="asc">Default sorting</option>
                                    {{-- <option value="popularity">Sort by popularity</option> --}}
                                    {{-- <option value="rating">Sort by average rating</option> --}}
                                    <option value="date">Sort by latest</option>
                                    <option value="asc">Sort by pric: low to high</option>
                                    <option value="desc">Sort by price: high to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="toolbox-right">
                            {{--  <div class="toolbox-item toolbox-show select-box">
                                <select wire:model.live="perPage">
                                    <option value="9">Show 9</option>
                                    <option value="12">Show 12</option>
                                    <option value="24">Show 24</option>
                                    <option value="36">Show 36</option>
                                </select>
                            </div>  --}}
                            <div class="toolbox-item toolbox-layout">
                                <a wire:click="grid" class="icon-mode-grid btn-layout @if($show) active @endif"
                                    style="cursor:pointer">
                                    <i class="w-icon-grid"></i>
                                </a>
                                <a wire:click="list" class="icon-mode-list btn-layout @if(!$show) active @endif"
                                    style="cursor:pointer">
                                    <i class=" w-icon-list"></i>
                                </a>
                            </div>
                        </div>
                    </nav>
                    <div class="product-wrapper row cols-xl-2 cols-sm-1 cols-xs-2 cols-1">


                        @if(isset($products))
                        @foreach ($products as $product )
                        @if($product->latestProductStock)
                        <div class="product product-list">
                            <figure class="product-media">
                                <a wire:click="showproduct({{ $product->id }})" style="cursor: pointer">
                                    <img src="{{ img_chk_exist($product->img) }}" alt="Product" width="330"
                                        height="338" />
                                    <img src="{{ img_chk_exist($product->img) }}" alt="Product" width="330" </a>
                                    <div class="product-action-vertical">
                                        <a wire:click="show_modal({{ $product->id }})" style="cursor:pointer"
                                            class="btn-product-icon  w-icon-search" title="Quick View"></a>
                                    </div>

                            </figure>
                            <div class="product-details">
                                <div class="product-cat">
                                    <a href="{{ route('trader.category',$product->category->id) }}">{{ @$product->category->name }}</a>
                                </div>
                                <h4 class="product-name">
                                    <a href="" wire:click="showproduct({{ $product->id}})">{{ @$product->name }}</a>
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
                                    <a style="cursor: pointer" wire:click="showproduct({{ $product->id}})"
                                        class="rating-reviews">
                                        ({{ count($product->products_rates) }}Reviews)</a>
                                </div>
                                <div class="product-price">
                                    ${{ @$product->latestProductStock->selling_price }}

                                </div>
                                <div class="product-desc">
                                    Ultrices eros in cursus turpis massa cursus mattis. Volutpat ac tincidunt
                                    vitae semper quis lectus. Aliquam id diam maecenas ultricies…
                                </div>
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to Cart"><i
                                            class="w-icon-cart"></i> Add To Cart</a>
                                    <a style="cursor: pointer" wire:click="add_to_wishlist({{ $product->id }})"
                                        class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                    <a style="cursor: pointer" wire:click="add_to_compare({{ $product->id }})" class="btn-product-icon  w-icon-compare" title="Compare"></a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>

                </div>
                <!-- End of Shop Main Content -->
                <div class="toolbox toolbox-pagination justify-content-between">
                    <p class="showing-info mb-2 mb-sm-0">
                        Showing
                        <span>
                            {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }}
                        </span>
                        Products
                    </p>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" style="cursor: pointer" wire:click="previousPage" wire:loading.attr="disabled" rel="prev" aria-label="Previous">
                                <i class="w-icon-long-arrow-left"></i>
                            </a>
                        </li>
                    
                        {{-- Page Numbers --}}
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                <a class="page-link" style="cursor: pointer" wire:click="gotoPage({{ $i }})" wire:loading.attr="disabled">{{ $i }}</a>
                            </li>
                        @endfor
                    
                        {{-- Next Page Link --}}
                        <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                            @if($products->hasMorePages())
                                <a class="page-link" style="cursor: pointer" wire:click="nextPage" wire:loading.attr="disabled" rel="next" aria-label="Next">
                                    <i class="w-icon-long-arrow-right"></i>
                                </a>
                            @else
                                <span class="page-link disabled" aria-label="Next">
                                    <i class="w-icon-long-arrow-right"></i>
                                </span>
                            @endif
                        </li>
                    </ul>
                    
                    
                    
                    
                                  
                               
                    
                    
                </div>
            </div>
            <!-- End of Shop Content -->

            @endif


        </div>
       
    </div>
</main>