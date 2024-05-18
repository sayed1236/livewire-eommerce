@extends('admin.layouts.app')

@section('content')


<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
    <?php
if (isset($result->type) && $result->type>0 ){ $type=$result->type; }
    if($type ==1){
        $dis_det='hidden';
        $dis_img='';
        $require_img='required';
    }elseif($type ==2){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='';
    }elseif($type ==3){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='required';
    }elseif($type ==4){
        $dis_det='hidden';
        $dis_img='hidden';
        $require_img='required';
    }else{
        $dis_det='';
        $dis_img='';
        $require_img='required';
    }
    if(isset($result->type)) $require_img='';
    ?>

                    <h3 class="box-title" style="text-decoration: underline;color:brown">
    <?php 
    /*if (!empty($cat->id))
    {
        echo '<strong>تعديل</strong> :<b style="color:blueviolet">'.$cat->name.'</b>';
        $btn_kw='تعديــــــل';
    }else
    {
        echo 'اضــــــافة جديد/ '.$title;
        $btn_kw='اضافة جديد';
    }*/
    ?>
                    </h3>
                <!-- alert msg-->
                @include('includes.messages')
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <!--button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button-->
              </div>
            </div>
            <div class="box-body pad">
                <form @if (isset($result->id))
                        action="{{route('advertising.update', $result->id ) }}"
                    @else
                        action="{{route('advertising.store') }}"
                    @endif
                
                 method="post" enctype="multipart/form-data" >
                    @csrf
                    @if (isset($result->id))
                        @method('PUT')
                    @else
                        
                    @endif
                    
@if (isset($result->id) && !empty($result->img))
                    <div class="form-group <?php //echo $dis_img; ?>">
                        <label for="ord">الصورة</label>
                        <img src="{{ img_chk_exist($result->img)}}" style="width: 70px; height: 60px" />
                    </div>
@endif
@if (isset($type))
    <input type="hidden" name="type" value="{{$type}}" />
@else
    <input type="hidden" name="type" value="{{@$result->type}}" />
@endif
                                
                        <input type="hidden" name="parent_id" value="{{ @$result->parent_id}}" /> 
                    <div class="form-group col-md-6">
                        <label for="Name">الاسم</label>
                        <input type="text" name="name" value="{{ @$result->name }}" class="form-control" id="name" placeholder=""  />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name_en">Name EN</label>
                        <input type="text" name="name_en" value="{{ @$result->name_en }}" class="form-control" id="name_en" placeholder=""  />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="ord">Ord/الترتيب</label>
                        <input type="text" name="ord" value="{{ @$result->ord }}" class="form-control" id="ord" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="img">img</label>
                        <input type="file" name="img"  class="form-control" id="img" {{$require_img}} />
                    </div>
                    <div class="form-group col-md-6">
                    <label for="name_en"> المنتج</label>
                    <select  name="with_id" class="form-control select2" dir="rtl" >
                        <option value="0">    اختر    </option>
@if(!is_null($products)):
    @foreach($products as $product):
                      
<?php
        if($result->with_id == $product->id)
        {
            $sel_l1='selected=""';
        }else{ $sel_l1='';}
?>
                    <option value="{{ $product->id }}" {{$sel_l1}}>{{ $product->name }}</option>    
    @endforeach;
@endif;
                    </select>                      
                    </div>
                    <div class="form-group col-md-12 ">
                        <label for="details">الرابط  </label>
                        <input type="url" name="url_l" value="{{ @$result->url_l }}" class="form-control" />
                    </div>
                        
                    <div class="form-group col-md-12 hidden">
                        <label for="details">google_adv </label>
                        <textarea name="google_adv" class="form-control " rows="3"  placeholder="اضف ...">{{ @$result->google_adv }}</textarea>
                    </div>
                      
                    <div class="box-footer col-md-12">
                            <input type="submit" name="insert" class="btn btn-info pull-center" value="<?php //echo $btn_kw; ?>حفظ" />
    <?php 
    /*if (empty($cat->id))
    {
        echo '<button type="reset" class="btn btn-default">مسح</button>';
    }*/
    ?> 
                            
                            <button type="button" onclick="history.go(-1);" class="btn btn-default">رجوع</button>
                            
                    </div><!-- /.box-footer -->  
                    </form>     
</div>
          </div>
        </div>
      </div>
</section>
@endsection
