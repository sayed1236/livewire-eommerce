<div class="tab tab-nav-boxed tab-nav-underline product-tabs">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a wire:click="show_describtion" style="cursor:pointer"
                class="nav-link @if($describtion) active @endif">Description</a>
        </li>
        <li class="nav-item">
            <a wire:click="show_specification" style="cursor:pointer"
                class="nav-link @if($specification) active @endif">Specification</a>
        </li>
        <li class="nav-item">
            <a wire:click="show_vendor_info" style="cursor:pointer"
                class="nav-link @if($vendor_info) active @endif">Seller Info</a>
        </li>
        <li class="nav-item">
            <a wire:click="show_reviews" style="cursor:pointer" class="nav-link @if($reviews) active @endif">Customer
                Reviews ({{ count($product->products_rates) }})</a>
        </li>

    </ul>
    <div class="tab-content">
        @if($describtion)
        <div class="tab-pane @if($describtion) active @endif" id="product-tab-description">
            <div class="row mb-4">
                <div class="col-md-6 mb-5">
                    <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt arcu cursus vitae congue mauris.
                        Sagittis id consectetur purus ut. Tellus rutrum tellus pelle Vel
                        pretium lectus quam id leo in vitae turpis massa.</p>
                    <ul class="list-type-check">
                        <li>Nunc nec porttitor turpis. In eu risus enim. In vitae mollis
                            elit.
                        </li>
                        <li>Vivamus finibus vel mauris ut vehicula.</li>
                        <li>Nullam a magna porttitor, dictum risus nec, faucibus sapien.
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="banner banner-video product-video br-xs">
                        <figure class="banner-media">
                            <a href="#">
                                <img src="{{ url('site/images/products/video-banner-610x300.jpg') }}" alt="banner"
                                    width="610" height="300" style="background-color: #bebebe;">
                            </a>
                            <a class="btn-play-video btn-iframe"
                                href="{{ url('site/video/memory-of-a-woman.mp4') }}"></a>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="row cols-md-3">
                <div class="mb-3">
                    <h5 class="sub-title font-weight-bold"><span class="mr-3">1.</span>Free
                        Shipping &amp; Return</h5>
                    <p class="detail pl-5">We offer free shipping for products on orders
                        above 50$ and offer free delivery for all orders in US.</p>
                </div>
                <div class="mb-3">
                    <h5 class="sub-title font-weight-bold"><span>2.</span>Free and Easy
                        Returns</h5>
                    <p class="detail pl-5">We guarantee our products and you could get back
                        all of your money anytime you want in 30 days.</p>
                </div>
                <div class="mb-3">
                    <h5 class="sub-title font-weight-bold"><span>3.</span>Special Financing
                    </h5>
                    <p class="detail pl-5">Get 20%-50% off items over 50$ for a month or
                        over 250$ for a year with our special credit card.</p>
                </div>
            </div>
        </div>
        @endif
        @if($specification)
        <div class="tab-pane @if($specification) active @endif" id="product-tab-specification">
            <ul class="list-none">
                <li>
                    <label>name</label>
                    <p>{{ $product->name }}</p>
                </li>
                @foreach ($product->atts_cats as $attributes)
                <li>
                    <label>{{ @$attributes->attrcats->attribute->main_attribute->name }}</label>
                    <p>
                        ,{{ @$attributes->attrcats->attribute->value }}
                    </p>
                </li>
                @endforeach

                {{--  <li>
                    <label>Guarantee Time</label>
                    <p>3 Months</p>
                </li>  --}}
            </ul>
        </div>
        @endif
        @if($vendor_info)
        <div class="tab-pane @if($vendor_info) active @endif" id="product-tab-vendor">
            <div class="row mb-3">
                <div class="col-md-6 mb-4">
                    <figure class="vendor-banner br-sm">
                        <img src="{{ img_chk_exist(@$product->vendor->logo) }}" alt="Vendor Banner" width="610"
                            height="295" style="background-color: #353B55;" />
                    </figure>
                </div>
                <div class="col-md-6 pl-2 pl-md-6 mb-4">
                    <div class="vendor-user">
                        <figure class="vendor-logo mr-4">
                            <a href="#">
                                <img src="{{ img_chk_exist(@$product->vendor->logo) }}" alt="Vendor Logo"
                                    width="80" height="80" />
                            </a>
                        </figure>
                        <div>
                            <div class="vendor-name"><a href="#">{{ @$product->vendor->name }}</a></div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: 90%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <a href="#" class="rating-reviews">(32 Reviews)</a>
                            </div>
                        </div>
                    </div>
                    <ul class="vendor-info list-style-none">
                        <li class="store-name">
                            <label>Store Name:</label>
                            <span class="detail">{{ @$product->latestProductStock->stock->stock_name }}</span>
                        </li>
                        <li class="store-address">
                            <label>Address:</label>
                            <span class="detail">{{ @$product->latestProductStock->stock->address }}
                                States (US)</span>
                        </li>
                        <li class="store-phone">
                            <label>Phone:</label>
                            <a href="#tel:">{{ @$product->vendor->mobile }}</a>
                        </li>
                    </ul>
                    <a href="vendor-dokan-store.html" class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
                        Store<i class="w-icon-long-arrow-right"></i></a>
                </div>
            </div>
            <p class="mb-5"><strong class="text-dark">L</strong>orem ipsum dolor sit amet,
                consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.
                Venenatis tellus in metus vulputate eu scelerisque felis. Vel pretium
                lectus quam id leo in vitae turpis massa. Nunc id cursus metus aliquam.
                Libero id faucibus nisl tincidunt eget. Aliquam id diam maecenas ultricies
                mi eget mauris. Volutpat ac tincidunt vitae semper quis lectus. Vestibulum
                mattis ullamcorper velit sed. A arcu cursus vitae congue mauris.
            </p>
            <p class="mb-2"><strong class="text-dark">A</strong> arcu cursus vitae congue
                mauris. Sagittis id consectetur purus
                ut. Tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla.
                Diam in
                arcu cursus euismod quis. Eget sit amet tellus cras adipiscing enim eu. In
                fermentum et sollicitudin ac orci phasellus. A condimentum vitae sapien
                pellentesque
                habitant morbi tristique senectus et. In dictum non consectetur a erat. Nunc
                scelerisque viverra mauris in aliquam sem fringilla.</p>
        </div>
        @endif
        @if($reviews)
        <div class="tab-pane @if($reviews) active @endif" id="product-tab-reviews">
            <div class="row mb-4">
                <div class="col-xl-4 col-lg-5 mb-4">
                    <div class="ratings-wrapper">
                        <div class="avg-rating-container">
                            <h4 class="avg-mark font-weight-bolder ls-50">{{ number_format($avgrating, 2) }}</h4>
                            <div class="avg-rating">
                                <p class="text-dark mb-1">Average Rating</p>
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        @php $width=0;
                                        $avg=20;
                                        $count=1;
                                        while ($count <= $avgrating) { $width+=$avg; $count++; } @endphp <span
                                            class="ratings" style="width: @php echo $width;  @endphp%;"></span>


                                            <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a class="rating-reviews">(
                                        @if(count($product->trader_history_logs))
                                        {{ count($product->trader_history_logs) }}
                                        @else
                                        0
                                        @endif
                                        reviews)</a>
                                </div>
                            </div>
                        </div>
                        <div class="ratings-value d-flex align-items-center text-dark ls-25">
                            <span class="text-dark font-weight-bold">{{ number_format(($avgrating/5)*100,2)
                                }}%
                        </div>
                        <div class="ratings-list">
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: 100%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <div class="progress-bar progress-bar-sm ">
                                    <span></span>
                                </div>
                                <div class="progress-value">
                                    <mark>{{ number_format($fiverating,2) }}%</mark>
                                </div>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: 80%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <div class="progress-bar progress-bar-sm ">
                                    <span></span>
                                </div>
                                <div class="progress-value">
                                    <mark>{{ number_format($fourrating,2) }}%</mark>
                                </div>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: 60%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <div class="progress-bar progress-bar-sm ">
                                    <span></span>
                                </div>
                                <div class="progress-value">
                                    <mark>{{ number_format($threerating,2) }}%</mark>
                                </div>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: 40%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <div class="progress-bar progress-bar-sm ">
                                    <span></span>
                                </div>
                                <div class="progress-value">
                                    <mark>{{ number_format($tworating,2) }}%</mark>
                                </div>
                            </div>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: 20%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <div class="progress-bar progress-bar-sm ">
                                    <span></span>
                                </div>
                                <div class="progress-value">
                                    <mark>{{ number_format($onerating,2) }}%</mark>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7 mb-4">
                    <div class="review-form-wrapper">
                        <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                            Review</h3>
                        <p class="mb-3">Your email address will not be published. Required
                            fields are marked *</p>
                        <form wire:submit.prevent="saveReview" class="review-form">
                            <div class="rating-form">
                                <label for="rating">Your Rating Of This Product :</label>
                                <span class="rating-stars">
                                    <a class="star-1 @if($rating==1) active @endif" wire:click.prevent="setRating(1)"
                                        style="cursor:pointer">1</a>
                                    <a class="star-2 @if($rating==2) active @endif" wire:click.prevent="setRating(2)"
                                        style="cursor:pointer">2</a>
                                    <a class="star-3 @if($rating==3) active @endif" wire:click.prevent="setRating(3)"
                                        style="cursor:pointer">3</a>
                                    <a class="star-4 @if($rating==4) active @endif" wire:click.prevent="setRating(4)"
                                        style="cursor:pointer">4</a>
                                    <a class="star-5 @if($rating==5) active @endif" wire:click.prevent="setRating(5)"
                                        style="cursor:pointer">5</a>
                                </span>

                            </div>
                            <textarea cols="30" rows="6" wire:model="message"  placeholder="Write Your Review Here..."
                                class="form-control" id="review"></textarea>


                            <button type="submit" class="btn btn-dark">Submit
                                Review</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a style="cursor: pointer" wire:click="show_all_replies"
                            class="nav-link @if($show_all) active @endif">Show All</a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer" wire:click="positive_trader_replies"
                            class="nav-link @if($positive_repl) active @endif">Most Helpful
                            Positive</a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor: pointer" wire:click="negative_trader_replies"
                            class="nav-link @if($negative_repl) active @endif">Most Helpful
                            Negative</a>
                    </li>

                </ul>
                <div class="tab-content">
                    @if($show_all)
                    <div class="tab-pane @if($show_all) active @endif" id="show-all">
                        <ul class="comments list-style-none">
                            @if(isset($product->products_rates))
                            @foreach($product->products_rates as $products_rate)
                            <li class="comment">
                                <div class="comment-body">
                                    <figure class="comment-avatar">
                                        <img src="{{ url('site/images/agents/1-100x100.png') }}" alt="Commenter Avatar"
                                            width="90" height="90">
                                    </figure>
                                    <div class="comment-content">
                                        <h4 class="comment-author">
                                            <a style="cursor: pointer">{{
                                                App\Models\Trader\Trader::find($products_rate->trader_id)->name }}</a>
                                            <span class="comment-date">
                                                @if ($products_rate->created_at)
                                                {{ $products_rate->created_at->format('F j, Y \a\t g:i A') }}
                                                @endif
                                            </span>
                                        </h4>
                                        <div class="ratings-container comment-rating">
                                            

                                            <div class="ratings-full">
                                                @php
                                                $width=0;
                                                $avg=20;
                                                $counter=1;
                                                while ($counter <= $products_rate->rate) { $width+=$avg; $counter++; } @endphp <span
                                                    class="ratings" style="width:@php echo $width @endphp%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>
                                        <p>{{ $products_rate->notes }}</p>

                                    </div>
                                </div>
                            </li>
                            @endforeach


                            @endif

                        </ul>
                    </div>
                    @endif
                    @if($positive_repl)
                    <div class="tab-pane @if($positive_repl) active @endif" id="helpful-positive">
                        <ul class="comments list-style-none">
                            @if($product->products_rates)
                            @foreach($product->products_rates as $products_rate)
                            @if($products_rate->rate>3)
                            <li class="comment">
                                <div class="comment-body">
                                    <figure class="comment-avatar">
                                        <img src="{{ url('site/images/agents/1-100x100.png') }}" alt="Commenter Avatar"
                                            width="90" height="90">
                                    </figure>
                                    <div class="comment-content">
                                        <h4 class="comment-author">
                                            <a style="cursor: pointer">{{
                                                App\Models\Trader\Trader::find($products_rate->trader_id)->name }}</a>
                                            <span class="comment-date">
                                                {{ $products_rate->created_at->format('F j, Y \a\t g:i A') }}
                                            </span>
                                        </h4>
                                        <div class="ratings-container comment-rating">
                                            

                                             <div class="ratings-full">
                                                @php
                                                $width=0;
                                                $avg=20;
                                                $counter=1;
                                                while ($counter <= $products_rate->rate) { $width+=$avg; $counter++; } @endphp <span
                                                    class="ratings" style="width:@php echo $width @endphp%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>
                                        <p>{{ $products_rate->notes }}</p>

                                    </div>
                                </div>
                            </li>

                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    @endif
                    @if($negative_repl)
                    <div class="tab-pane @if($negative_repl) active @endif" id="helpful-negative">
                        <ul class="comments list-style-none">
                            @if(isset($product->products_rates))
                            @foreach($product->products_rates as $products_rate)
                            @if($products_rate->rate<3) <li class="comment">
                                <div class="comment-body">
                                    <figure class="comment-avatar">
                                        <img src="{{ url('site/images/agents/1-100x100.png') }}" alt="Commenter Avatar"
                                            width="90" height="90">
                                    </figure>
                                    <div class="comment-content">
                                        <h4 class="comment-author">
                                            <a style="cursor: pointer">{{
                                                App\Models\trader\Trader::find($products_rate->trader_id)->name }}</a>
                                            <span class="comment-date">
                                                {{ $products_rate->created_at->format('F j, Y \a\t g:i A') }}
                                            </span>
                                        </h4>
                                        <div class="ratings-container comment-rating">
                                            

                                            <div class="ratings-full">
                                                @php
                                                $width=0;
                                                $avg=20;
                                                $counter=1;
                                                while ($counter <= $products_rate->rate) { $width+=$avg; $counter++; } @endphp <span
                                                    class="ratings" style="width:@php echo $width @endphp%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>
                                        <p>{{ $products_rate->notes }}</p>

                                    </div>
                                </div>
                                </li>
                                @endif
                                @endforeach

                                @endif
                        </ul>
                    </div>
                    @endif


                </div>
            </div>
        </div>
        @endif
    </div>
</div>