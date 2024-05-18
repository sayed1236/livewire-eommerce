<div>
  
  
  
  	    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-0">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Orders</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
	
	
<div class="header-page bg-image head-company space-boxes">
        <div class="container">
            <div class="row">



                <div class="col-12">
                    <div class="box-header-text sprite">
                        <h2>
    you  must firstly complete
<br>

           all legal information
<br>

    before adding your  products
                        </h2>
                    </div>
                </div>

            </div>
        </div>
    </div>	
	
	
	
<div class="page-content vendor-sty">
	<div class="container">
  
    <div class="row justify-content-center">


 <div class="col-md-7 col-12">
 <div class="curve-white">


        <div class="indes-content">
            <div class="">
			
			
			
			


                <div class="">
				
							<h4 class="title title-underline ls-25 font-weight-bold"> company legal data</h4>


                    {{--  <form action="#" method="POST" class="addproduct-form ajax-contact">  --}}
                        <div class="row gx-24">

                            <div class="form-group col-md-12">
                                <input  type="text" class="form-control" name="name" id="name" placeholder="Company name as recorded in the commercial register" />
                                <i class="fal fa-layer-group"></i>
                            </div>

                            {{--  @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror  --}}


                            <div class="form-group col-md-6">
                                <input wire:model="taxes_licences" type="text" class="form-control" name="name" id="name"

                                placeholder=

                                @if ($errors->has('comerical_lines'))

                                @error('comerical_lines')
                                "{{ $message }}"
                                 @enderror

                                @else
                                "Tax identification number"
                                  @endif
                                  />

                                <i class="fal fa-layer-group"></i>
                            </div>



                            <div class="form-group col-md-6">
                                <i class="fal fa-file-image"></i>
                                <label class="uploadFile">
                                    <span class="filename">
                                        @if ($errors->has('taxes_licences_file'))

                                        @error('taxes_licences_file')
                                        {{ $message }}
                                         @enderror

                                        @else
                                        Tax card photo                                        @endif
                                         </span>
                                    <input wire:model="taxes_licences_file"  type="file" class="inputfile form-control" name="Tax-file" />
                                </label>
                            </div>





                            <div class="form-group col-md-6">
                                <input wire:model="comerical_lines" type="text" class="form-control" name="name" id="name" placeholder=
                                @if ($errors->has('comerical_lines'))

                                @error('comerical_lines')
                                "{{ $message }}"
                                 @enderror

                                @else
                                "Commercial Register Number"

                                  @endif



                                />
                                <i class="fal fa-layer-group"></i>
                            </div>



                            <div class="form-group col-md-6">
                                <i class="fal fa-file-image"></i>
                                <label class="uploadFile">
                                    <span class="filename">
                                        @if ($errors->has('comerical_lines_file'))

                                        @error('comerical_lines_file')
                                        {{ $message }}
                                         @enderror

                                        @else
                                        Commercial register file
                                        @endif
                                    </span>
                                    <input wire:model="comerical_lines_file" type="file" class="inputfile form-control" name="Commercial-file" />
                                </label>
                            </div>


                            <div class="form-group col-md-12 col-12">
                                <textarea wire:model="brief" name="brief" id="brief" cols="30" rows="3" class="form-control" placeholder="Brife"></textarea>
                                <i class="fal fa-comment-alt-edit"></i>
                            </div>


                            <div   class="form-group col-md-6">
                                <i class="fal fa-file-image"></i>
                                <label  class="uploadFile">
                                    <span class="filename">
                                        @if ($errors->has('company_profile'))

                                        @error('company_profile')
                                        {{ $message }}
                                         @enderror

                                        @else
                                        Profile img
                                        @endif
                                    </span>
                                    <input wire:model="company_profile"  type="file" class="inputfile form-control" name="Profile-img" />
                                </label>
                            </div>



                            <div class="form-group col-md-12">
                                <div class="form-checkbox">
                                    <input  wire:model="accept_terms_condition" type="checkbox" class="custom-checkbox" id="Conditions" name="Conditions" required="">
                                    <label for="Conditions">I Agree to Terms and Conditions</label>
                                </div>
                            </div>



                            <div class="form-btn col-12 mt-3"><button wire:click="saving"  class="btn btn-primary" type="submit" name="submitform">
                                    Send</button></div>
                        </div>
                        <p class="form-messages mb-0 mt-3">
                            @if (session()->has('success_message'))
                            <div class="alert alert-success alert-simple alert-inline show-code-action">
                                <h4 class="alert-title">Well done!</h4>
                                {{ session('success_message') }}
                            </div>
                            @elseif(session()->has('error_message'))
                            <div class="alert alert-success alert-simple alert-inline show-code-action">
                                <h4 class="alert-title"> opps!</h4>
                                {{ session('error_message') }}
                            </div>
                            @endif
                        </p>
                    {{--  </form>  --}}
                </div>
            </div>
        </div>



    </div>
    </div>
</div>
</div>


    <!--------- End company profile ----------->
</div>
