@section('header')
<link rel="stylesheet" type="text/css" href="{{ url('site/css/style.min.css') }}">
@endsection
<main class="main login-page">
    <!-- Start of Page Header -->
   
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>My account</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    <div class="page-content">
        <div class="container">
            <div class="login-popup">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    @if (session()->has('error'))
                    <div class="alert alert-icon alert-warning alert-bg alert-inline ">
                        <h4 class="alert-title">
                            <i class="w-icon-exclamation-triangle"></i>Warning!</h4>
                            {{ session('error') }}
                    </div>
                       
                   
                    @elseif (session()->has('success'))
                    <div class="alert alert-success alert-simple alert-inline ">
                        <h4 class="alert-title">
                            <i class="fas fa-check"></i>Well done!</h4> you are registered successfully..
                    </div>
                    @elseif(auth()->guard('trader')->check())
                        you are already logged in
                    
                @endif
            
                    <ul class="nav nav-tabs text-uppercase" role="tablist">

                        <li class="nav-item">
                            <a href="" wire:click="active_login" class="nav-link @if($sign_in) active @endif">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a href="#sign-up" wire:click="active_signup" class="nav-link @if(!$sign_in) active @endif">Sign Up</a>
                        </li>
                    </ul>
                    <main class="main login-page">
                        
                        <div class="tab-content">
                            @if($sign_in)
                            <div class="tab-pane @if($sign_in) active @endif" id="sign-in" >
                                <a href="{{ url('vendors/login') }}" class="d-block mb-5 text-primary">Login as a seller?</a>

                                <form wire:submit="login">
                                    <div class="form-group">
                                        <label>mobile or email address *</label>
                                        <input type="text" class="form-control" wire:model="username" id="username" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" wire:model="passwordlogin" id="password" required>
                                    </div>
                                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox"  class="custom-checkbox" id="remember1" wire:model="remember_me" >
                                        <label for="remember1">Remember me</label>
                                        <a href="#">forget your password?</a>
                                    </div>

                                    <button type="submit" class="btn btn-primary" wire:loading>Sign In</button>
                                </form>
                            </div>
                            @else
                            <div class="tab-pane @if(!$sign_in) active @endif" id="sign-up">
                                <a href="{{ url('vendors/login') }}" class="d-block mb-5 text-primary">Signup as a seller?</a>

                                <form wire:submit.prevent="register">
                        
                                    <div class="form-group mb-5">
                                        <label>Name *</label>
                                        <input type="text" class="form-control"  wire:model="name" id="first-name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Your email address *</label>
                                        <input type="email" class="form-control" wire:model="email" id="email_1">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" wire:model="password" id="">
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5">
                                        <label>Password_confirmation *</label>
                                        <input type="password" class="form-control" wire:model="password_confirmation" id="">
                                        @error('password_confirmation')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                        
                        
                                   
                                    <div class="form-group mb-5">
                                        <label>Phone Number *</label>
                                        <input type="text" class="form-control" wire:model="mobile" id="phone-number">
                                        @error('mobile')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                        
                        
                                    <p>Your personal data will be used to support your experience
                                        throughout this website, to manage access to your account,
                                        and for other purposes described in our .</p>
                                    <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                        <input type="checkbox" class="custom-checkbox" id="remember" wire:model="remember" >
                                      
                                        <label for="remember" class="font-size-md">I agree to the <a href="{{ route('trader.privacy','privacy') }}"
                                                class="text-primary font-size-md">privacy policy</a></label>
                                    </div>
                                    @error('remember')
                                    <div class="alert alert-danger">The privacy check is required.
                                    </div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary" >Sign up</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </main>
                    <p class="text-center">Sign in with social account</p>
                    <div class="social-icons social-icon-border-color d-flex justify-content-center">
                        <a href="#" class="social-icon social-facebook">Facebook Account</a>
                       
                        <a href="#" class="social-icon social-google">Google Account</a>
                    </div>
                    {{--  <p class="text-center">Sign in with social account</p>
                    <div class="social-icons social-icon-border-color d-flex justify-content-center">
                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                        <a href="#" class="social-icon social-google fab fa-google"></a>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
</main>