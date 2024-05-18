@if(count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissable" >
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>{{ $error}}</h4>
            </div>
        @endforeach

@endif

@if(Session::has('flash_message'))
    <div class="alert alert-success col-md-6 col-md-offset-3 offset-3  alert-dismissable">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
        <span class="glyphicon glyphicon-ok"></span>   <em> {!! session('flash_message') !!}</em>
    </div>
@endif

@if(Session::has('success_message'))
<div class="alert alert-success col-md-6 col-md-offset-3 offset-3  alert-dismissable">
    <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
    <span class="glyphicon glyphicon-ok"></span>   <em> {!! session('success_message') !!}</em>
</div>
    @endif
@if(Session::has('error_message'))
    <div class="alert alert-danger col-md-6 col-md-offset-3 offset-3  alert-dismissable">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
        <span class="glyphicon glyphicon-ok"></span>   <em> {!! session('error_message') !!}</em>
    </div>
    @endif
