<main class="main">
		
			
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
                        <h2>Seller</h2>

            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Seller</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Pgae Contetn -->
    <div class="page-content mb-8">
        <div class="container">
        
            <div class="row gutter-lg">
                <aside class="sidebar vendor-sidebar sticky-sidebar-wrapper left-sidebar sidebar-fixed">
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                    <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-right"></i></a>
                    <div class="sidebar-content">
                        <div class="sticky-sidebar">
                            
                            <!-- End of Widget -->

                           
                            <!-- End of Widget -->

                            <div class="widget widget-filter">
                                <h4 class="widget-title">Filter By Location</h4>
                                <div class="widget-body">
                                    <form class="select-box">
                                        <select name="orderby" class="form-control">
                                            <option value="choose" selected="selected">Choose Location ...</option>
                                            <option value="afghanistan">Afghanistan</option>
                                            <option value="aland">Aland Islands</option>
                                            <option value="albania">Albania</option>
                                            <option value="algeria">Algeria</option>
                                            <option value="bahamas">Bahamas</option>
                                            <option value="cuba">Cuba</option>
                                            <option value="greece">Greece</option>
                                        </select>
                                    </form>
                                    <form class="select-box">
                                        <select name="orderby" class="form-control">
                                            <option value="choose" selected="selected">Choose State</option>
                                        </select>
                                    </form>
                                   
                                </div>
                            </div>
                            <!-- End of Widget -->
                        </div>
                        <!-- End of Sticky Sidebar -->
                    </div>
                    <!-- End of Sidebar Content -->
                </aside>
                <!-- End of Sidebar -->

                <div class="main-content">
                    <div class="toolbox wcfm-toolbox">
                        {{--  <div class="toolbox-left">
                            <form class="select-box toolbox-item">
                                <select name="orderby" class="form-control">
                                    <option value="old-new" selected="selected">Sort by newness: old to new</option>
                                    <option value="new-old">Sort by newness: new to old</option>
                                    <option value="low-high">Sort by average rating: low to high</option>
                                    <option value="high-low">Sort by average rating: high to low</option>
                                    <option value="old-new">Sort Alphabetical: A to Z</option>
                                    <option value="old-new">Sort Alphabetical: Z to A</option>
                                </select>
                            </form>
                        </div>  --}}
                        {{--  <div class="toolbox-right">
                            <div class="toolbox-item">
                                {{ $vendors->firstItem() }} - {{ $vendors->lastItem() }} of {{ $vendors->total() }}
                            </div>
                        </div>  --}}
                    </div>
                    <!-- End of Toolbox -->

                    <div class="row cols-lg-3" styl="margin-bottom:20px">
                        @foreach ($vendors as $vendor )
                        <div class="store-wrap mb-4">
                            <div class="store store-grid store-wcfm">
                                <div class="store-header">
                                    <figure class="store-banner">
                                        <img src="{{ img_chk_exist($vendor->img) }}" alt="Vendor" width="400" height="194" style="background-color: #40475E">
                                    </figure>
                                </div>
                                <!-- End of Store Header -->
                                <div class="store-content">
                                    <h4 class="store-title">
                                        <a href="vendor-dokan-store.html">{{ $vendor->name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                    <ul class="seller-info-list list-style-none">
                                        <li class="store-email">
                                            <a href="email:#">
                                                <i class="far fa-envelope"></i>
                                                {{ $vendor->email }}
                                            </a>
                                        </li>
                                        <li class="store-phone">
                                            <a href="tel:123456789">
                                                <i class="w-icon-phone"></i>
                                                {{ $vendor->mobile }}

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End of Store Content -->
                                <div class="store-footer">
                                    <figure class="seller-brand">
                                        <img src="{{ img_chk_exist($vendor->logo) }}" alt="Brand" width="80" height="80">
                                    </figure>
                                    
                                    <a href="shop-both-sidebar.html" class="btn btn-rounded btn-visit">Visit</a>
                                </div>
                                <!-- End of Store Footer -->
                            </div>
                            <!-- End of Store -->
                        </div>
                        @endforeach
                       

                 
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</main>