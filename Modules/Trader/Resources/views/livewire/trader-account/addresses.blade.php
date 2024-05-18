<div class="tab-pane active in" id="account-addresses">
    <div class="icon-box icon-box-side icon-box-light">
        <span class="icon-box-icon icon-map-marker">
            <i class="w-icon-map-marker"></i>
        </span>
        <div class="icon-box-content">
            <h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
        </div>
    </div>
    <p>The following addresses will be used on the checkout page by default.</p>
    @if($edit)
    <div class="row">
        <div class="col-sm-6 mb-6">
            <div class="ecommerce-address billing-address pr-lg-8">
                <h4 class="title title-underline ls-25 font-weight-bold">Billing Address</h4>
                <address class="mb-4">
                    <table class="address-table" >
                        <tbody wire:poll>
                            <tr>
                                <th>Name:</th>
                                <td>{{ auth('trader')->user()->name }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ auth('trader')->user()->address }}</td>
                            </tr>
                            <tr>
                                <th>Country:</th>
                                <td>{{ auth('trader')->user()->country }}</td>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <td>{{ auth('trader')->user()->state }}</td>
                            </tr>                            
                            <tr>
                                <th>Phone:</th>
                                <td>{{ auth('trader')->user()->mobile }}</td>
                            </tr>
                        </tbody>
                    </table>
                </address>
                <a wire:click="add_address" style="cursor:pointer" class="btn btn-primary btn-icon-right">Edit your billing address<i class="w-icon-long-arrow-right"></i></a>
            </div>
        </div>
     
    </div>
@else
    <div class="indes-content">
        <div class="bg-smoke">
            <div class="appointment-form-wrap">
                <form wire:submit="save" class="contact-form">
                    <div class="row gx-24">
                        <div class="form-group col-md-12"><input value="{{ @$name }}" type="text" class="form-control" wire:model="name" id="name" placeholder="Enter Your Name" /> <i class="fal fa-user"></i></div>
                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                        <div class="form-group col-md-12"><input value="{{ @$email }}" type="email" class="form-control" wire:model="email" id="email" placeholder="Email Address" /> <i class="fal fa-envelope"></i></div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        <div class="form-group col-md-12"><input value="{{ @$mobile }}" type="text" class="form-control" wire:model="mobile" placeholder="mobile" /> <i class="fal fa-phone"></i></div>
                        @error('mobile')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                        <div class="form-group col-md-12"><input value="{{ @$state }}" type="text" class="form-control" wire:model="state" placeholder="state" /> <i class="fal fa-map-marker-check"></i></div>
                        @error('state')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                        <div class="form-group col-md-12"><input value="{{ @$country }}" type="text" class="form-control" wire:model="country" placeholder="country" /> <i class="fal fa-map-marker-check"></i></div>
                        @error('country')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                     

                        <div class="form-group col-md-12"><input value="{{ @$address }}" type="text" class="form-control" wire:model="address" placeholder="address" /> <i class="fal fa-map-marker-check"></i></div>
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                        {{--  <div class="form-group col-12"><textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Message"></textarea> <i class="fal fa-comment"></i></div>  --}}

                        {{--  <div class="form-btn col-12"><button class="btn btn-primary" type="submit" name="submitform">Send</button></div>  --}}
                    </div>
                    <button type="submit"  class="btn btn-dark btn-block btn-rounded">
                        save</button>
                </form>
            </div>
        </div>
    </div>
@endif
   
</div>