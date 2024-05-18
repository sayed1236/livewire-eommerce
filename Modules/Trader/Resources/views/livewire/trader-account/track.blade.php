<main class="main">
		
			
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
                        <h2>Track</h2>

            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Track</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Pgae Contetn -->
    <div class="page-content track-section mb-8">
        
<div class="container px-1 px-md-4 py-5 mx-auto">
<div class="card">


<div class="row px-3 top">
<div class="ord-details">
    <div class="d-flex flex-column text-sm-right">
        <h5>order address :  <span class="text-primary font-weight-bold">{{ @$track->address->state }} - {{ @$track->address->country }}</span></h5>

    </div>
    
</div>
 
<!-- Add class 'active' to progress -->

<div class="col-md-12 col-3">
<div class="row d-flex justify-content-center">
    <div class="col-12">
    <ul id="progressbar" class="text-center">
        <li class="active step0"></li>
        <li class=" step0"></li>
        <li class=" step0"></li>
        <li class="step0"></li>
    </ul>
    </div>
</div>
</div>

<div class="col-md-12 col-9">
<div class="row justify-content-between">
    <div class="col-md-3 col-12 icon-content">
        <img class="icon" src="{{ url('site/images/dc1.png') }}">
        <div class="d-flex flex-column">
            <p class="font-weight-bold">Order<br>Processed</p>
        </div>
    </div>
    <div class="col-md-3 col-12 icon-content">
        <img class="icon" src="{{ url('site/images/dc2.png') }}">
        <div class="d-flex flex-column">
            <p class="font-weight-bold">Order<br>Shipped</p>
        </div>
    </div>
    <div class="col-md-3 col-12 icon-content">
        <img class="icon" src="{{ url('site/images/dc3.png') }}">
        <div class="d-flex flex-column">
            <p class="font-weight-bold">Order<br>En Route</p>
        </div>
    </div>
    <div class="col-md-3 col-12 icon-content">
        <img class="icon" src="{{ url('site/images/dc4.png') }}">
        <div class="d-flex flex-column">
            <p class="font-weight-bold">Order<br>Arrived</p>
        </div>
    </div>
</div>
</div>
</div>
</div>


<a href="{{ route('trader.newarrival') }}" class="btn btn-dark btn-rounded btn-icon-right">Go
                            Shop<i class="w-icon-long-arrow-right"></i></a>
                            
                            
                            
</div>


       
    </div>
    <!-- End of Page Content -->
</main>