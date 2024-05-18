<div>
    <main class="main login-page" >
        <!-- Start of Page Header -->
        {{--  <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">My Account</h1>
            </div>
        </div>  --}}
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        {{--  <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="demo1.html">Home</a></li>
                    <li>My account</li>
                </ul>
            </div>
        </nav>  --}}
        <!-- End of Breadcrumb -->
        <div class="row" >
            <div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('error_message'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

            </div>
        </div>
        <div class="page-content" >

               @if ($is_sign_up)
                <div class="container">
             <form >
               <div class="login-popup"  >
                 <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="#"class="nav-link " >
                             <buttonclass= "nav-link "  style="    border: none;" wire:click="change_view_to_signin"> sign In</button>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"class="nav-link active  ">
                           <buttonclass= "nav-link "  style="    border: none;" wire:click="change_view_to_signup"> sign Up</button>
                        </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        {{--  <div class="tab-pane "
                        id="sign-in">
                            <div class="form-group">
                                <label>Username or email address *</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="form-group mb-0">
                                <label>Password *</label>
                                <input type="text" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="form-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1" required="">
                                <label for="remember1">Remember me</label>
                                <a href="#">Last your password?</a>
                            </div>
                            <a href="#" class="btn btn-primary">Sign In</a>
                        </div>  --}}
                         <div class=  "tab-pane active"
                          id="sign-up">
                          <a href="{{ url('trader/showlogin

                          ') }}" class="d-block mb-5 text-primary">Signup as a Buyer?</a>
                            <div class="form-group">
                                <label>Your email address *</label>
                                <input type="text" wire:model="email1" class="form-control" name="email_1" id="email_1" required>
                                @error('email1') <span class="text-danger error">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-group mb-5">
                                <label>Password *</label>
                                <input type="password" wire:model="password1" class="form-control" name="password_1" id="password_1" required>
                                @error('password1') <span class="text-danger error">the pass word must be letters one of them capital and numbers at least 6</span>@enderror

                            </div>
                            <div class="">
                                <div class="form-group mb-5">
                                    <label>Company Name *</label>
                                    <input type="text" wire:model="name" class="form-control" name="first-name" id="first-name" required>
                                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror

                                </div>
                                {{--  <div class="form-group mb-5">
                                    <label>Last Name *</label>
                                    <input type="text" wire:model="last_name" class="form-control" name="last-name" id="last-name" required>
                                    @error('last_name') <span class="text-danger error">{{ $message }}</span>@enderror

                                </div>  --}}
                                {{--  <div class="form-group mb-5">
                                    <label>Shop Name *</label>
                                    <input type="text" wire:model="shop_name" class="form-control" name="shop-name" id="shop-name" required>
                                    @error('shop_name') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>  --}}
                                {{--  <div class="form-group mb-5">
                                    <label>Shop URL *</label>
                                    <input type="text" wire:model="shop_url" class="form-control" name="shop-url" id="shop-url" required>
                                    @error('shop_url') <span class="text-danger error">{{ $message }}</span>@enderror
                                    <small>https://d-themes.com/wordpress/wolmart/demo-1/store/</small>
                                </div>  --}}
                                <div class="form-group mb-5">
                                    <label>Phone Number *</label>
                                    <input type="text" wire:model="mobile"class="form-control" name="phone-number" id="phone-number" required>
                                    @error('mobile')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{--  <div class="form-checkbox user-checkbox mt-0">
                                <input type="checkbox" class="custom-checkbox checkbox-round active" id="check-customer" name="check-customer" required="">
                                <label for="check-customer" class="check-customer mb-1">I am a customer</label>
                                <br>
                                <input type="checkbox" class="custom-checkbox checkbox-round" id="check-seller" name="check-seller" required="">
                                <label for="check-seller" class="check-seller">I am a vendor</label>
                            </div>  --}}
                            <p>Your personal data will be used to support your experience
                                throughout this website, to manage access to your account,
                                and for other purposes described in our <a href="#" class="text-primary">privacy policy</a>.</p>
                            <a href="#" class="d-block mb-5 text-primary">Signup as a Seller ?</a>
                            <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                <input wire:model="privacy_policy" type="checkbox" class="custom-checkbox" id="remember" name="remember" required="">
                                <label for="remember" class="font-size-md">I agree to the <a  href="#" class="text-primary font-size-md">privacy policy</a></label>
                                @if (session()->has('privacy_policy'))
                                <div class="alert alert-danger">
                                    {{ session('privacy_policy') }}
                                </div>
                                @endif
                            </div>
                            {{--  <button class="btn btn-primary">  --}}
                                <div wire:click='register' class="btn btn-primary">
                               Sign UP
                                </div>
                            {{--  </button>  --}}
                         </div>

                    </div>
                    {{--  <p class="text-center">Sign in with social account</p>
                    <div class="social-icons social-icon-border-color d-flex justify-content-center">
                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                        <a href="#" class="social-icon social-google fab fa-google"></a>
                    </div>  --}}
                </div>
            </form>
            </div>
               @else

               <div class="login-popup"  >
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="#"class="nav-link active  " >
                             <buttonclass= "nav-link "  style="    border: none;" wire:click="change_view_to_signin"> sign In</button>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"class="nav-link  ">
                           <buttonclass= "nav-link "  style="    border: none;" wire:click="change_view_to_signup"> sign Up</button>
                        </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active"
                        id="sign-in">
                        <a href="{{ url('trader/showlogin

                        ') }}" class="d-block mb-5 text-primary">Sign in as a Buyer ?</a>
                            <div class="form-group">
                                <label>Email address *</label>
                                <input type="email" wire:model="email" class="form-control" name="username" id="username" required>
                                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                                {{--  @if($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif  --}}

                            </div>
                            <div class="form-group mb-0">
                                <label>Password *</label>
                                <input type="password" wire:model="password" class="form-control" name="password" id="password" required>
                                @error('password') <span class="text-danger error">{{ $message }}</span>@enderror

                            </div>
                            <div class="form-checkbox d-flex align-items-center justify-content-between">
                                <input wire:model="remember_me" type="checkbox" class="custom-checkbox" id="remember1" name="remember1" required="">
                                <label for="remember1">Remember me</label>
                                <a href="#">Lost your password?</a>

                            </div>
                            <div wire:click='login' class="btn btn-primary">Sign In</div>
                        </div>
                        @if(Session::has('error'))
                        <p class="alert alert-info">{{ Session::get('error') }}</p>
                        @endif
                         {{--  <div class=  "tab-pane "
                          id="sign-up">
                            <div class="form-group">
                                <label>Your email address *</label>
                                <input type="text" class="form-control" name="email_1" id="email_1" required>
                            </div>
                            <div class="form-group mb-5">
                                <label>Password *</label>
                                <input type="text" class="form-control" name="password_1" id="password_1" required>
                            </div>
                            <div class="checkbox-content login-vendor">
                                <div class="form-group mb-5">
                                    <label>First Name *</label>
                                    <input type="text" class="form-control" name="first-name" id="first-name" required>
                                </div>
                                <div class="form-group mb-5">
                                    <label>Last Name *</label>
                                    <input type="text" class="form-control" name="last-name" id="last-name" required>
                                </div>
                                <div class="form-group mb-5">
                                    <label>Shop Name *</label>
                                    <input type="text" class="form-control" name="shop-name" id="shop-name" required>
                                </div>
                                <div class="form-group mb-5">
                                    <label>Shop URL *</label>
                                    <input type="text" class="form-control" name="shop-url" id="shop-url" required>
                                    <small>https://d-themes.com/wordpress/wolmart/demo-1/store/</small>
                                </div>
                                <div class="form-group mb-5">
                                    <label>Phone Number *</label>
                                    <input type="text" class="form-control" name="phone-number" id="phone-number" required>
                                </div>
                            </div>
                            <div class="form-checkbox user-checkbox mt-0">
                                <input type="checkbox" class="custom-checkbox checkbox-round active" id="check-customer" name="check-customer" required="">
                                <label for="check-customer" class="check-customer mb-1">I am a customer</label>
                                <br>
                                <input type="checkbox" class="custom-checkbox checkbox-round" id="check-seller" name="check-seller" required="">
                                <label for="check-seller" class="check-seller">I am a trader</label>
                            </div>
                            <p>Your personal data will be used to support your experience
                                throughout this website, to manage access to your account,
                                and for other purposes described in our <a href="#" class="text-primary">privacy policy</a>.</p>
                            <a href="{{ url('trader/showlogin

                            ') }}" class="d-block mb-5 text-primary">Signup as a trader?</a>



                    </div>
                    {{--  <p class="text-center">Sign in with social account</p>
                    <div class="social-icons social-icon-border-color d-flex justify-content-center">
                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                        <a href="#" class="social-icon social-google fab fa-google"></a>
                    </div>  --}}
                </div>
            </div>
               @endif


            </div>
        </div>
    </main></div>
