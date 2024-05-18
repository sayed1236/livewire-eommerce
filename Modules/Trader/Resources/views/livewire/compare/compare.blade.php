@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('site/css/style.min.css') }}">

@endsection
<main class="main">
    <!-- Start of Page Header -->
    
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-2">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="demo1.html">Home</a></li>
                <li>Compare</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content mb-10 pb-2">
        <div class="container">
            <div class="compare-table">
                <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-products">
                    <div class="compare-col compare-field">Product</div>
                    @if(isset($products))
                    @forelse ($products as $product)
                    <div class="compare-col compare-product" >
                        <a wire:click="removeFromCompare({{ @$product->id }})" style="cursor: pointer" class="btn remove-product"><i class="w-icon-times-solid"></i></a>
                        <div class="product text-center">
                            <figure class="product-media">
                                <a style="cursor:pointer" wire:click="showproduct({{ $product->id}})">
                                    <img src="{{ img_chk_exist(@$product->img) }}" alt="Product" width="228"
                                       style="height: 340px" height="257" />
                                </a>
                                <div class="product-action-vertical">
                                    <a style="cursor: pointer"
                                    wire:click="add_cart({{ @$product->id }})" class="btn-product-icon btn-cart w-icon-cart"></a>
                                    <a style="cursor: pointer"
                                    wire:click="add_to_wishlist({{ @$product->id }})" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                                </div>
                            </figure>
                            <div class="product-details">
                                <h3 class="product-name"><a href="product-default.html">{{@$product->name}}</a></h3>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="color: black; text-align: center; font-size: 18px; font-weight: bold; padding: 10px; background-color: #f6be00;">No product added</p>
                    @endforelse 
                     @endif
                </div>
                <!-- End of Compare Products -->
                <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-price">
                    <div class="compare-col compare-field">Price</div>
                    @foreach ($products as $product )
                    @if(isset($product->latestProductStock))
                    
                    <div class="compare-col compare-value">
                        <div class="product-price">
                            <span class="new-price">${{ @$product->latestProductStock->selling_price }}</span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <!-- End of Compare Price -->
                <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-availability">
                    <div class="compare-col compare-field">Availability</div>
                    @foreach ($products as $product )
                    @if(isset($product->latestProductStock->stock))
                    
                    <div class="compare-col compare-value">In stock</div>
                   
                    @else
                    <div class="compare-col compare-value" style="color: black">out stock</div>

                    @endif
                    @endforeach
                </div>
                <!-- End of Compare Availability -->
                <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-description">
                    <div class="compare-col compare-field">description</div>
                    @if(isset($products))
                    @foreach ($products as $product )
                    <div class="compare-col compare-value">
                        <ul class="list-style-none list-type-check">
                            <li>{{ @$product->description }}</li>
                           
                        </ul>
                    </div>
                    @endforeach
                    @endif
                </div>
                <!-- End of Compare Description -->
                <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-reviews">
                    <div class="compare-col compare-field">Ratings &amp; Reviews</div>
                    @if(isset($products))
                    @foreach ($products as $product )
                    <div class="compare-col compare-rating">
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
                    </div>
                    @endforeach
                    @endif
                </div>
                <!-- End of Compare Reviews -->
                <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-category">
                    <div class="compare-col compare-field">Category</div>
                    @if(isset($products))
                    @foreach ($products as $product )
                    <div class="compare-col compare-value">{{ @$product->category->name }}</div>
                    @endforeach
                    @endif
                </div>
                <!-- End of Compare Category -->
                <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-meta">
                    <div class="compare-col compare-field">SKU</div>
                    @if(isset($products))
                    @foreach ($products as $product )
                    <div class="compare-col compare-value">MS46891344</div>
                    @endforeach
                    @endif
                </div>
                <!-- End of Compare Meta -->
                @if(isset($cat_attributes->attributes))
                @foreach ($cat_attributes->attributes as $attribute)
                    @if($attribute->name !== 'color')
                        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-size">
                            <div class="compare-col compare-field">{{ $attribute->name }}</div>
                            @foreach ($products as $product)
                           
                                <div class="compare-col compare-value">
                                    @foreach ($product->attributes as $attributeval)
                                    @if(isset($attributeval->main_attribute) && $attributeval->main_attribute->name == $attribute->name)
                                        {{ $attributeval->name }}&nbsp;{{-- Add a space here --}}
                                        
                                    @endif
                                    @endforeach
                                </div>
                            
                        @endforeach
                        
                        </div>
                    @else
                        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-color">
                            <div class="compare-col compare-field">{{ $attribute->name }}</div>
                            @foreach ($products as $product)
                                
                                        <div class="compare-col compare-value">
                                            @foreach ($product->attributes as $attributeval)
                                            @if(isset($attributeval->main_attribute) && $attributeval->main_attribute->name == $attribute->name)
                                            <span class="swatch" style="background-color: {{ $attributeval->name }}" title="{{ $attributeval->name }}"></span>
                                            @endif
                                            @endforeach
                                        </div>
                                  
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @endif
            
            
                <!-- End of Compare Color -->
              
                <!-- End of Compare Brand -->
            </div>
        </div>
        <!-- End of Compare Table -->
    </div>
    <!-- End of Page Content -->
</main>