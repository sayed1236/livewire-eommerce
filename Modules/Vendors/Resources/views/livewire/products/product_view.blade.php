<div>
    <div class="modal modal-am fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-overlay"></div>

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Details To <span class="deo-color">Sticky Pencil</span></h4>

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

                    {{--  <form action="" class="tab-wizard wizard-circle">  --}}
                        <!-- Step 1 -->

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="stock" class="form-label">stock id </label>

                                          <div class="select-box">
                                 <select wire:model="stock_id" id="stock" name="stock_id">
                                    <option value="0">choose</option>
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
                    {{--  </form>  --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="page-content">
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
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title"><span>All Categories</span></h3>
                                <ul class="widget-body filter-items search-ul">
                                    <li><a href="#">Accessories</a></li>
                                    <li><a href="#">Babies</a></li>
                                    <li><a href="#">Beauty</a></li>
                                    <li><a href="#">Decoration</a></li>
                                    <li><a href="#">Electronics</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Food</a></li>
                                    <li><a href="#">Furniture</a></li>
                                    <li><a href="#">Kitchen</a></li>
                                    <li><a href="#">Medical</a></li>
                                    <li><a href="#">Sports</a></li>
                                    <li><a href="#">Watches</a></li>
                                </ul>
                            </div>
                            <!-- End of Collapsible Widget -->
                        </div>
                        <!-- End of Sidebar Content -->
                    </div>
                    <!-- End of Sidebar Content -->
                </aside>
                <!-- End of Shop Sidebar -->

                <!-- Start of Shop Main Content -->
                <div class="main-content">
                    {{--  <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <div class="toolbox-left">
                            <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle
                                btn-icon-left d-block d-lg-none"><i
                                    class="w-icon-category"></i><span>Filters</span></a>
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
                                <a href="vendor-wc-store-product-grid.html"
                                    class="icon-mode-grid btn-layout active">
                                    <i class="w-icon-grid"></i>
                                </a>
                                <a href="vendor-wc-store-product-list.html" class="icon-mode-list btn-layout">
                                    <i class="w-icon-list"></i>
                                </a>
                            </div>
                        </div>
                    </nav>  --}}
                    <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">
            @foreach ($my_products as $my_product)
            <div class="product-wrap">
                <div class="product product-simple text-center">
                    <figure class="product-media">
                        <a href="product-default.html">
                            <img src="{{img_chk_exist($my_product->img)}}" alt="Product" width="300"
                                height="338" />
                            <img src="{{url('site/images/shop/2-2.jpg')}}" alt="Product" width="300"
                                height="338" />
                        </a>
                        {{--  <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                title="Add to wishlist"></a>
                            <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                title="Add to Compare"></a>
                        </div>  --}}
                        <div wire:click="get_prod_id({{ $my_product->id }})" class="product-action">

                            <a href="#" class="btn-product modal-toggle" data-bs-toggle="modal" data-bs-target="#myModal_1"> Add new amount</a>


                        </div>
                    </figure>
                    <div class="product-details">
                        <h4 class="product-name"><a href="">
                                {{ $my_product->name }}</a></h4>
                        <div class="product-pa-wrapper">
                            {{--  <div class="product-price">
                                <ins class="new-price">$30.00</ins><del
                                    class="old-price">$60.00</del>
                            </div>  --}}
                            {{--  <div class="product-action">
                                <a href="#"
                                    class="btn-cart btn-product btn btn-icon-right btn-link btn-underline">Add amount
                                    To stock</a>
                            </div>  --}}
                        </div>
                        {{--  <div class="sold-by">
                            Sold By:
                            <a href="#">{{ $company->name }}</a>
                        </div>  --}}
                    </div>
                </div>
            </div>
            @endforeach


                    </div>
                </div>
                <!-- End of Shop Main Content -->
            </div>
            <!-- End of Shop Content -->
        </div>
    </div>
</div>
