<div class="tab-pane active in" id="account-details">
    <div class="icon-box icon-box-side icon-box-light">
        <span class="icon-box-icon icon-account mr-2">
            <i class="w-icon-user"></i>
        </span>
        <div class="icon-box-content">
            <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
        </div>
    </div>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <form class="form account-details-form" wire:submit="edit_details">
        <div class="row">
            {{--  @if($photo)
            <div style="width: 200px">
            <img src="{{ img_chk_exist($is_photo->img) }}" width="100px">
            </div>
            @endif  --}}
            <div class="">
                <div class="form-group">
                    <label>Img </label>
                    <input type="file"  wire:model.live="photo"
                         class="form-control form-control-md">
                    @error('photo')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="">
                <div class="form-group">
                    <label>Full name *</label>
                    <input type="text" id="firstname" wire:model="fullname"
                        placeholder="{{ auth()->guard('trader')->user()->name }}" class="form-control form-control-md">
                    @error('fullname')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>



     <div class="form-group mb-6">
            <label >Email address *</label>
            <input type="email" placeholder="{{ auth()->guard('trader')->user()->email }}" wire:model="email" class="form-control form-control-md">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
        <div class="form-group">
            <label class="text-dark" >change your password</label>
            <input type="password" placeholder="" class="form-control form-control-md"  wire:model="cur_password">
            @error('cur_password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      
       
        <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
    </form>
</div>  
