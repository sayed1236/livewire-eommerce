<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
    @include('includes.status_online')
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?>

			<div class="text-muted pt-2 font-size-sm">

			</div></h3>
        </div>

		<div class="card-toolbar">
            <!--begin::Button-->
			{{-- <a href="javascript:void(0);" wire:click="edit_form" class="btn btn-primary font-weight-bolder">
			  <span class="svg-icon svg-icon-md"> {!!$btn_kwrd !!}
            </a> --}}
			<!--end::Button-->
        </div>


    </div>

    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
                @include('includes.messages')
            </div>
<form wire:submit.prevent="edit">
            <div class="form-group">
                <label>ال seo:-</label>
                <div class="radio-inline">
                    <label class="radio">
                    <input type="radio" name="radios2" wire:model.defer='seo' value="1" {{ ($results->seo == 1) ? 'checked' : ''}}/>
                    <span></span>website</label>
                    <label class="radio">
                    <input type="radio" name="radios2" wire:model.defer='seo' value="2" {{ ($results->seo == 2) ? 'checked' : ''}} />
                    <span></span>mobile app</label>
                    <label class="radio">
                    <input type="radio" name="radios2" wire:model.defer='seo' value="0" {{ ($results->seo == 0) ? 'checked' : ''}}/>
                    <span></span>all</label>
                </div>
                {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
            </div>
            <div class="form-group">
                <label>ال lang:-</label>
                <div class="radio-inline">
                    <label class="radio">
                    <input type="radio" name="radios3" wire:model.defer='lang' value="N" {{ ($results->lang == 'N') ? 'checked' : ''}}/>
                    <span></span>arabic</label>
                    <label class="radio">
                    <input type="radio" name="radios3" wire:model.defer='lang' value="Y" {{ ($results->lang == 'Y') ? 'checked' : ''}}/>
                    <span></span>multi lang</label>

                </div>
                {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
            </div>
            <div class="form-group">
                <label>ال dashboard color:-</label><br>
                <input type="color" wire:model='color'>
            </div>
            <button type="submit" class="btn btn-primary btn-sm"> {{ __('ms_lang.btn_edit')}}</button>
</form>
    </div>
</div>

