<div>
        
           
                <h4 class="title title-password ls-25 font-weight-bold">Account Details</h4>
        
      
        {{--  @dd($name)  --}}
        {{--  <form class="form account-details-form" >  --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">First Name *</label>
                        <input type="text" id="firstname" name="firstname" placeholder="{{ @$name }}"
                            class="form-control form-control-md">
                    </div>
                </div>
                {{--  <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Last name *</label>
                        <input type="text" id="lastname" name="lastname" placeholder="{{ @$name  }}"
                            class="form-control form-control-md">
                    </div>
                </div>  --}}
            </div>

            {{--  <div class="form-group mb-3">
                <label for="display-name">Display name *</label>
                <input type="text" id="display-name" name="display_name" placeholder="{{ @$name }}{{  @$name}}"
                    class="form-control form-control-md mb-0">
                <p>This will be how your name will be displayed in the account section and in reviews</p>
            </div>  --}}

            <div class="form-group mb-6">
                <label for="email_1">Email address *</label>
                <input type="email" id="email_1" name="email_1"
                placeholder="{{ @$email }}"
                    class="form-control form-control-md">
            </div>

            <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
            <div class="form-group">
                <label class="text-dark" for="cur-password">Current Password leave blank to leave unchanged</label>
                <input wire:model="old_password" type="password" class="form-control form-control-md"
                    id="cur-password" name="cur_password">
                    @if (session('old_pass'))
                <div class="alert alert-danger" role="alert">
                    {{ session('old_pass') }}
                    @endif
            </div>
            <div class="form-group">
                <label class="text-dark" for="new-password">New Password leave blank to leave unchanged</label>
                <input wire:model="new_password" type="password" class="form-control form-control-md"
                    id="newPasswordInput" name="new_password_confirmation">
                    @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-10">
                <label class="text-dark" for="confirmNewPasswordInput">Confirm Password</label>
                <input wire:model="confirm_pass" type="password" class="form-control form-control-md"
                    id="confirmNewPasswordInput" name="new_password_confirmation">
                    @error('confirm_pass')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @if (session('confirm'))
                <div class="alert alert-danger" role="alert">
                    {{ session('confirm') }}
                    @endif
            </div>
            <button  wire:click='updatePassword' class="btn btn-dark btn-rounded btn-sm mb-4">Save new password</button>
        {{--  </form>  --}}
    </div>
