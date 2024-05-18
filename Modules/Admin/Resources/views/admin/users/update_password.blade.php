@extends('admin.layouts.app')

@section('content')

<section class="content">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box box-info">
            <div class="box-header">
    
                    <h3 class="box-title" style="text-decoration: underline;color:brown">
                        Change password
                    </h3>
                <!-- alert msg-->
                
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <!--button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button-->
              </div>
            </div>

            <div class="box-body pad">
                @include('includes.messages')
                <form action="{{route('update-pass') }}" method="post" >
                    @csrf

                   <div class="form-group col-md-12">
                        <label for="ord">{{ __('password') }}</label>
                        <input type="password" name="password"  class="form-control" id="password" />
                    </div>
                    <div class="form-group col-md-12">
                        <label for="ord"> {{ __('re-password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="" >
                    </div>
                    <div class="box-footer col-md-12">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="{{ __('ms_lang.btn_save') }}" />
                            
                    </div><!-- /.box-footer -->  
                    </form>     
</div>
          </div>
        </div>
      </div>
</section>
@endsection
