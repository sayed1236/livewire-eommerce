<main class="main">

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <h2>My Account</h2>

            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>My account</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content pt-2 my-account">
        <div class="container">
            <div class="tab tab-vertical">
                <ul class="nav nav-tabs mb-6" role="tablist">


                    <div class="profile-top text-center">
                        <div class="profile-image mb-1" wire:poll>
                            <img class=" " src="{{ img_chk_exist(@$is_photo->img) }}" alt="user"
                                width="130">
                        </div>
                        <div class="profile-detail">
                            <h3 class="mb-0">{{auth()->guard('trader')->user()->name}}</h3>
                            <p class="text-muted">{{ auth()->guard('trader')->user()->email }}</p>
                        </div>
                    </div>
                    <li class="nav-item">
                        <a style="cursor:pointer" wire:click="show_dashboard"
                            class="nav-link @if($dashboard) active @endif">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a style="cursor:pointer" wire:click="show_orders"
                            class="nav-link @if($orders) active @endif">Orders</a>
                    </li>
                    
                    <li class="nav-item">
                        <a style="cursor:pointer" wire:click="show_addresses"
                            class="nav-link @if($addresses) active @endif">Addresses</a>
                    </li>
                    <li class="nav-item">
                        <a style="cursor:pointer" wire:click="show_details"
                            class="nav-link @if($details) active @endif">Account details</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a style="cursor:pointer" wire:click="show_socials"
                            class="nav-link @if($socials) active @endif">Socials</a>
                    </li> --}}
                    <li class="link-item">
                        <a href="{{ route('trader.wishlist') }}">Wishlist</a>
                    </li>
                    <li class="link-item">
                        <a style="cursor:pointer" wire:click="logout">Logout</a>
                    </li>
                </ul>

                <div class="tab-content">
                    @if($dashboard)
                    <div class="tab-pane active in" id="account-dashboard">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a wire:click="show_orders" style="cursor:pointer" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-orders">
                                            <i class="w-icon-orders"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p wire:click="show_orders" class="text-uppercase mb-0">Orders</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                           
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a wire:click="show_addresses" style="cursor: pointer" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-address">
                                            <i class="w-icon-map-marker"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p  class="text-uppercase mb-0">Addresses</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a wire:click="show_details" style="cursor: pointer" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-account">
                                            <i class="w-icon-user"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p  class="text-uppercase mb-0">Account Details</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="{{ route('trader.wishlist') }}" class="link-to-tab">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-wishlist">
                                            <i class="w-icon-heart"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p  class="text-uppercase mb-0">Wishlist</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a wire:click="logout" style="cursor:poiter">
                                    <div class="icon-box text-center">
                                        <span class="icon-box-icon icon-logout">
                                            <i class="w-icon-logout"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Logout</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($orders)
                    <div class="tab-pane  active in " id="account-orders">
                        <div class="icon-box icon-box-side icon-box-light">
                            <span class="icon-box-icon icon-orders">
                                <i class="w-icon-orders"></i>
                            </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                            </div>
                        </div>
                    
                        <table class="shop-table account-orders-table mb-6">
                            <thead>
                                <tr>
                                    <th class="order-id">Order</th>
                                    <th class="order-date">Date</th>
                                    <th class="order-status">Status</th>
                                    <th class="order-total">Total</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($orderproducts as $orderprod )
                                <tr>
                                    <td class="order-id">#{{ @$orderprod->id }}</td>
                                    <td class="order-date">{{ @$orderprod->created_at }}</td>
                                    <td class="order-status status-success">{{ $orderprod->status }}</td>
                                    <td class="order-total">
                                        <span class="order-price">${{ @$orderprod->order_total_price }}</span> for
                                        <span class="order-quantity"> {{ count(@$orderprod->orderproducts) }}</span> item
                                    </td>
                                    <td class="order-action">
                                        <a wire:click="show_order({{ $orderprod->id }})" style="cursor: pointer;"
                                            class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                    
                                        <a wire:click="show_track({{ $orderprod->id }})" class="btn btn-outline btn-default btn-block btn-sm btn-rounded">track
                                            order</a>
                    
                                    </td>
                                </tr>
                               
                                @endforeach
                    
                    
                            </tbody>
                        </table>
                    
                        <a href="{{ route('trader.newarrival') }}" class="btn btn-dark btn-rounded btn-icon-right">Go
                            Shop<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                    @endif
                  
                    @if($addresses)

                    <livewire:trader::trader-account.addresses />

                    @endif
                    @if($details)
                    {{-- <div class="tab-pane  active in " id="account-details"> --}}
                        <livewire:trader::trader-account.details />
                        {{--
                    </div> --}}
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>