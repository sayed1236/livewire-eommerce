<div>
    <div class="modal modal-am fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-overlay"></div>

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add new amount to <span class="deo-color"> this product
                            </span></h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @if (session()->has('message'))
                        <div class="alert alert-success alert-simple alert-inline show-code-action">
                            <h4 class="alert-title">Well done!</h4>
                            {{ session('message') }}
                        </div>

                        @endif
                        @if (session()->has('error'))

                        <div class="alert alert-error alert-simple alert-inline show-code-action">
                            <h4 class="alert-title">Oh snap!</h4>
                            {{ session('error') }}
                        </div>
                        @endif



                    </div>

                    {{-- <form action="" class="tab-wizard wizard-circle"> --}}
                    <!-- Step 1 -->

                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="stock" class="form-label">stock id </label>

                                    <div class="select-box">
                                        <select wire:model="stock_id" id="stock" name="stock_id">
                                            <option value="0">choose</option>
                                            {{--  <option value="1">general</option>  --}}
                                            @if ($my_stocks)
                                            @foreach ($my_stocks as $my_stock)
                                            <option value="{{$my_stock->id}}">{{ $my_stock->stock_name }}</option>

                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="Amount" class="form-label">Amount </label>
                                    <input wire:model='quantity' type="text" required="required" class="form-control" name="amount" placeholder="---" id="Amount" />
                                </div>
                            </div>



                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="Purchasing" class="form-label">Purchasing price </label>
                                    <input wire:model='buing_price' type="text" required="required" class="form-control" name="purchasing_price" placeholder="---" id="Purchasing" />
                                </div>
                            </div>

                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="Selling" class="form-label">Selling price </label>
                                    <input wire:model="selling_price" type="text" required="required" class="form-control" name="selling_price" placeholder="---" id="Selling" />
                                </div>
                            </div>


                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="expire" class="form-label">Date of expire </label>
                                    <input wire:model='date_of_expire' type="date" required="required" class="form-control" name="date_expire" id="expire" />
                                </div>
                            </div>


                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="enter" class="form-label">Date of enter </label>
                                    <input wire:model='date_of_enter' type="date" required="required" class="form-control" name="date_enter" id="enter" />
                                </div>
                            </div>
                        </div>

                        <div class="te-done">
                            <button wire:click="add_new_amount" class="btn btn-primary">Done</button>
                        </div>
                    </div>
                    {{--
                    </form> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.modal -->
    <div class="modal modal-discount fade">
        <div class="modal-overlay"></div>

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add discount <span class="deo-color"></span></h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @if (session()->has('message'))
                        <div class="alert alert-success alert-simple alert-inline show-code-action">
                            <h4 class="alert-title">Well done!</h4>
                            {{ session('message') }}
                        </div>

                        @endif
                        @if (session()->has('error'))

                        <div class="alert alert-error alert-simple alert-inline show-code-action">
                            <h4 class="alert-title">Oh snap!</h4>
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>

                    {{-- <form action="" method="post" class="tab-wizard wizard-circle">  --}}
                    <!-- Step 1 -->

                    <div class="container">
                        <div class="row">




                            <div class="col-md-4 col-4">
                                <div class="form-group">
                                    <label for="minimum" class="form-label">min Number </label>
                                    <input wire:model="minimum" type="text" required="required" class="form-control" name="minimum" placeholder="---" id="minimum" />
                                </div>
                            </div>

                            <div class="col-md-4 col-4">
                                <div class="form-group">
                                    <label for="maximum" class="form-label">max Number</label>
                                    <input wire:model="maximum" type="text" required="required" class="form-control" name="maximum" placeholder="---" id="maximum" />
                                </div>
                            </div>

                            <div class="col-md-4 col-4">
                                <div class="form-group">
                                    <label for="Discount-value" class="form-label">Discount value </label>
                                    <input wire:model="discount" type="text" required="required" class="form-control" name="Discount-value" placeholder="--- %" id="Discount-value" />
                                </div>
                            </div>

                        </div>

                        <div class="te-done">
                            <button wire:click="add_discount" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                    {{-- </form>  --}}


                    <div class="container">
                        <div class="appointment-form-wrap pl-0 pr-0">
                            @if ($my_discounts)
                            <h4 class="title title-underline ls-25 font-weight-bold">discount table</h4>
                            <table class="cust-table">
                                <tbody>
                                    <tr>
                                        <th class="num-th">#</th>
                                        <th class="atr-th">quantity</th>
                                        <th class="vlu-th">discount value</th>
                                        <th class="act-th">action</th>
                                    </tr>
                                    @php
                                    $i=1;
                                    @endphp

                                    @foreach ($my_discounts as $my_discount)




                                    <tr>
                                        <td>{{ $i }}</td>

                                        @php

                                        $i++;
                                        @endphp
                                        <td>{{ $my_discount->quantity_from }} - {{ $my_discount->quantity_to }}</td>
                                        <td>{{ $my_discount->discount_percent }}%</td>

                                        <td>
                                            <div class="dropdown">
                                                {{--  <button class="btn-dots dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="ُ#" class="view-action dropdown-item"><i class="fal fa-edit"></i>Edit</a>
                                                    </li>

                                                    <li>
                                                        <a href="#" class="delete-action dropdown-item"><i class="fal fa-trash-alt"></i> Delete</a>
                                                    </li>
                                                </ul>  --}}
                                                <li wire:click="delete_discount({{ $my_discount->id  }})">
                                                    <a href="#" class="delete-action dropdown-item"><i class="fal fa-trash-alt"></i> Delete</a>
                                                </li>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            @endif

                        </div>

                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{--  <livewire:vendors::products.product-edit />  --}}

    <div class="modal modal-edit fade">
        <div class="modal-overlay"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">edit  <span class="deo-color"> this @production

                    @endproduction</span></h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="indes-content">
                        @if (session()->has('update_message'))
                        <div class="alert alert-success alert-simple alert-inline show-code-action">
                            <h4 class="alert-title">Well done!</h4>
                            {{ session('update_message') }}
                        </div>

                        @endif
                        <form action="" method="post" class="tab-wizard wizard-circle">
                            <!-- Step 1 -->

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-12"></div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name" class="form-label">product name </label>
                                            <input wire:model="product_name" type="text" required="required" class="form-control" name="name" placeholder="Sticky Pencil" id="name" />
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">product img </label>

                                            <label class="uploadFile">
                                                <i class="fal fa-file-image"></i>
                                                <span class="filename">product img </span>
                                                <input wire:model="img" type="file" class="inputfile form-control" name="Profile-img" />
                                            </label>
                                        </div>
                                    </div>

                                    {{--  <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">category </label>

                                            <div class="select-box">
                                                <select id="stock" name="stock_id">
                                                    <option value="">All Categories</option>

                                                   @foreach ($categories as $categorie)
                                                   <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>

                                                   @endforeach


                                                </select>
                                            </div>
                                        </div>
                                    </div>  --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="m_o_q" class="form-label"> min amount quantity </label>
                                            <input wire:model="m_o_q" type="text" required="required" class="form-control" name="m_o_q" placeholder="Sticky Pencil" id="m_o_q" />
                                        </div>
                                    </div>

                                    {{--  <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">stock id </label>

                                            <div class="select-box">
                                                <select id="stock" name="stock_id">
                                                    <option value="">All Categories</option>
                                                    <option value="4">Fashion</option>
                                                    <option value="5" selected>Furniture</option>
                                                    <option value="6">Shoes</option>
                                                    <option value="7">Sports</option>
                                                    <option value="8">Games</option>
                                                    <option value="9">Computers</option>
                                                    <option value="10">Electronics</option>
                                                    <option value="11">Kitchen</option>
                                                    <option value="12">Clothing</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>  --}}



                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="enter" class="form-label">description </label>
                                            <textarea  wire:model="product_description" required="required" class="form-control" name="description" placeholder="description description description description"></textarea>
                                        </div>
                                    </div>
 {{--
                                    <div class="col-md-12 col-12 mb-4">
                                        <div class="ch-chk">
                                            <label class="coer">
                                                Active
                                                <input type="checkbox" checked="checked" />
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                        <div class="ch-chk">
                                            <label class="coer">
                                                Out Of stock
                                                <input type="checkbox" />
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>  --}}



                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
                        <button wire:click="editproduct" type="button" class="btn btn-danger">save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-delete fade">
        <div class="modal-overlay"></div>

        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fal fa-times"></i>
                    </div>
                    @if (session()->has('delete_message'))
                    <div class="alert alert-success alert-simple alert-inline show-code-action">
                        <h4 class="alert-title">Well done!</h4>
                        {{ session('delete_message') }}
                    </div>

                    @endif
                    <h4 class="modal-title w-100">Are you sure   ?</h4>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these product? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
                   @if ($hide!=1)
                   <button wire:click="delete_product" type="button" class="btn btn-danger">Delete</button>
                   @endif

                </div>
            </div>
        </div>

    </div>

    <div class="page-content vendor-sty">
        <div class="container">
            <!-- Start of Shop Content -->
            <div class="shop-content row gutter-lg mb-10">
                <!-- Start of Sidebar, Shop Sidebar -->
                <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                    <!-- Start of Sidebar Overlay -->
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                    <!-- Start of Sidebar Content -->
                    <div class="sidebar-content scrollable">
                        <!-- Start of Sticky Sidebar -->
                        <div class="sticky-sidebar">
						
						@foreach ($all_categories as $all_categorie)
                            <div class="widget widget-collapsible">
                                

                                <h3 class="widget-title collapsed"><span>{{ $all_categorie->name }}</span></h3>
                                <ul class="widget-body filter-items search-ul" style="display: none;">
@foreach ($all_categorie->sub_category as $item)
<li><a href="#">{{ $item->name }}</a></li>

@endforeach

                                </ul>
                                

                            </div>
							@endforeach
                            <!-- End of Collapsible Widget -->
                        </div>
                        <!-- End of Sidebar Content -->
                    </div>
                    <!-- End of Sidebar Content -->
                </aside>
                <!-- End of Shop Sidebar -->

                <!-- Start of Shop Main Content -->
                <div class="main-content">
                   {{-- <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <div class="toolbox-left">
                            <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle
                                btn-icon-left d-block d-lg-none"><i class="w-icon-category"></i><span>Filters</span></a>
                             <div class="toolbox-item toolbox-sort select-box text-dark">
                                <label>Sort By :</label>
                                <select name="orderby" class="form-control">
                                    <option value="default" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by latest</option>
                                    <option value="price-low">Sort by pric: low to high</option>
                                    <option value="price-high">Sort by price: high to low</option>
                                </select>
                            </div> 
                        </div>
                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show select-box">
                                <select name="count" class="form-control">
                                    <option value="9">Show 9</option>
                                    <option value="12" selected="selected">Show 12</option>
                                    <option value="24">Show 24</option>
                                    <option value="36">Show 36</option>
                                </select>
                            </div>
                            <div class="toolbox-item toolbox-layout">
                                <a href="vendor-wc-store-product-grid.html" class="icon-mode-grid btn-layout active">
                                    <i class="w-icon-grid"></i>
                                </a>
                                <a href="vendor-wc-store-product-list.html" class="icon-mode-list btn-layout">
                                    <i class="w-icon-list"></i>
                                </a>
                            </div>
                        </div> 
                    </nav>--}}
                    <div class="product-wrapper row cols-md-1 cols-xs-2 cols-1">


                        {{-- <div class="product-wrap">
                            <div class="product product-simple text-center">
                                <figure class="product-media">
                                    <a href="">
                                        <img src="{{img_chk_exist($stock_products->product->img)}}" alt="Product" width="300"
                        height="338" />
                        <img src="{{img_chk_exist($stock_products->product->img)}}" alt="Product" width="300" height="338" />
                        </a>
                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                            <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Add to Compare"></a>
                        </div>
                        <div wire:click="get_prod_id({{ $my_stocks_product->id }})" class="product-action">

                            <a href="#" class="btn-product modal-toggle" data-bs-toggle="modal" data-bs-target="#myModal_1"> Add new amount</a>


                        </div>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-name"><a href="">
                                    {{ $stock_products->product->name }}</a></h4>
                            <div class="product-pa-wrapper">
                                <div class="product-price">
                                    <ins class="new-price">$30.00</ins><del class="old-price">$60.00</del>
                                </div>
                                <div class="product-action">
                                    <a href="#" class="btn-cart btn-product btn btn-icon-right btn-link btn-underline">Add
                                        amount
                                        To stock</a>
                                </div>
                            </div>
                            <div class="sold-by">
                                Exists in:
                                <a href="#">{{ $my_stocks_product->stock_name }}</a>
                            </div>
                        </div>
                    </div>
                </div> --}}


            </div>




            <div class="product-wrapper idi-boxs row cols-xl-1 cols-sm-1 cols-xs-1 cols-1">
                @foreach ($my_products as $product)

                {{-- @foreach ($my_stocks_product->stock_products as $stock_products)  --}}
                <div class="product product-list product-select">
                    <figure class="product-media">
                        <a href="{{ url('/vendors/product-details/'.$product->id) }}">
                            <img src="{{img_chk_exist($product->img)}}" alt="Product" width="330" height="338" />
                        </a>
                        {{--  <div class="product-action-vertical">
                            <a href="{{ url('/vendors/product-details/'.$product->id) }}" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a>
                        </div>  --}}
                    </figure>
                    <div class="product-details">
                        <div class="product-cat">
                            <a href="#"> {{ @$product->category->name }}</a>
                        </div>
                        <h4 class="product-name">
                            <a href="{{ url('/vendors/product-details/'.$product->id) }}">{{ $product->name }}</a>
                        </h4>
                        {{-- <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top">5.00</span>
                                        </div>
                                        <a href="{{ url('/vendors/product-details/'.$product->id) }}" class="rating-reviews">(3 Reviews)</a>
                                    </div>  --}}
                        {{-- <div class="product-price">${{ $stock_products->buing_price }} - ${{
                                        $stock_products->selling_price }}
                    </div> --}}

                    <div class="product-action">


                        <a wire:click="get_prod_id({{ $product->id}})" href="#" class="btn-product modal-toggle"> Add amount</a>

                        <a wire:click="get_prod_and_stock_id({{ $product->id }})" href="#" class="btn-product toggle-disc"> Add discount</a>
                        {{-- <a href="#" class="btn-product"> Reviews</a>  --}}

                        {{-- <a href="#" class="btn-product"> Requests </a>  --}}



                        <div class="dropdown">
                            <button class="btn-dots dropdown-toggle btn-product" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Export File <i class="fal fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">


                                <li>
                                    <a class="dropdown-item" href="#"><i class="fal fa-file-word"></i> Export Word</a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#"><i class="fal fa-file-pdf"></i> Export PDF</a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#"><i class="fal fa-file-excel"></i> Export Excel</a>
                                </li>


                            </ul>
                        </div>



                        <div class="dropdown">
                            <button class="btn-dots dropdown-toggle btn-product" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                More <i class="fal fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">

                                <li wire:click="getproduct({{ $product->id }})">
                                    {{--  <a href="ُ#" class="edit-action dropdown-item"><i class="fal fa-edit"></i> Edit</a>  --}}
                                    <a href="#" class="edit-action dropdown-item"><i class="fal fa-edit"></i>
                                        edit
                                    </a>
                                </li>

                                <li  wire:click="getproduct({{ $product->id }})">
                                    <a href="#" class="delete-action dropdown-item"><i class="fal fa-trash-alt"></i> Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endforeach  --}}
            @endforeach
        </div>
    </div>
    <!-- End of Shop Main Content -->
</div>
<!-- End of Shop Content -->
</div>
</div>
</div>
