@extends('admin::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <label style="width: 90%!important;text-align: center"> 
                    <b style="float:right;font-size: 18px ">
                    <?php //echo $title; ?>
                    
    <?php //$parent_g=$this->Cat_M->get($p_id,true);
    //if(count($parent_g)) echo '( اضف فـ <em style="color: red;">'.$parent_g->name.'</em>)'; ?>
                    </b>
<?php //echo site_url(ADMIN_SITE.'Cat/Edit/'.$p_id.'/'.$t); ?>
                    <a  href="{{route('cat.create')}}">
                        <button type="button" class="btn btn-lg btn btn-primary">أضــافة جديد
                            <i class="glyphicon glyphicon-pencil glyphicon-white"></i>
                        </button>
                    </a>
                </label>

            <!-- alert msg
            <div class="alert alert-<?php echo @$alert_clas; ?> alert-dismissable" style="width: 40%;margin-left: 30%;display:<?php //echo $dis_alert; ?> ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?php //echo @$alert_msg; ?></h4>
            </div>-->
        <!--end alert msg-->
            </div><!-- /.box-header -->
            <div class="box-body">
    <?php
    /*
    if($t ==1){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($t ==2){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($t ==3){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($t ==4){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($t ==5){
        $dis_det='hidden';
        $dis_img='hidden';
    }elseif($t ==6){
        $dis_det='hidden';
        $dis_img='hidden';
    }else{
        $dis_det='';
        $dis_img='';
    }
    if($p_id > 0){
        $dis_det='';
        $dis_img='';
    }*/
    ?>
@if (count($results))
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th># </th>
                    <th>الاسم</th>
                    <th>EN Name</th>
                    <th class="<?php //echo $dis_img; ?>">IMG/الصورة</th>
                    <th class="<?php //echo $dis_det; ?>">details/التفاصيل</th>
                    <th>التاريح</th>
                    <th>Action/الاجراء</th>
                </tr>
                </thead>
                <tbody>
    @foreach ($results as $result)
        
    
                    <tr>
                        <!--td><?php //echo $record->id;  ?> </td-->
                        <td><?php // echo $record->ord;  ?></td>
    <?php /*
    if($record->type ==1 && $record->parent_id==0)
    {
        $go_url='href="'.site_url(ADMIN_SITE.'Cat/Index/'.$record->id.'/'.$record->type).'"';
        $btn_ad='    &nbsp;&nbsp;<button>اضف </button>&nbsp;&nbsp;&nbsp;';
    }
    else
    {
        $p_id=$record->parent_id;$btn_ad='';
    } */
    ?>
                        <td><a <?php // echo @$go_url; ?> >{{ $result->name}}</a></td>
                        <td>{{ $result->name_en}}</td>
                        <td class="<?php //echo $dis_img; ?>"><img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" /></td>
                        <td class="<?php //echo $dis_det; ?>">{{ cut_arabic_text($result->details , 350) }}</td>
                        <td>{{ $result->created_at }}</td>
                        <td style="padding: 1px;width: 22%">
                        <a href=""><button class="btn btn-info" style="padding: 7px 0;"> منيوهات القسم</button></a>
                        <!---------- active & Dis active Button --->
                        <form id="active_ms-form-{{ $result->id }}" action="{{ route('cat.active_ms', $result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('PUT')
                        </form>
<?php if($result->is_active ==1){ $styl='success';$act_w='نشـــــط'; }else{$styl='warning'; $act_w='غيرنشط';} ?>

                        <a href="{{route('cat.index')}}" onclick="event.preventDefault();
                                    document.getElementById('active_ms-form-{{ $result->id }}').submit(); " 
                        class="btn btn-{{ $styl }}" style="padding: 7px 1px;font-weight: bolder">&nbsp;{{ $act_w }}&nbsp;</a>
                        <!---------- edit Button --->
                        <a href="{{ route('cat.edit',$result->id) }}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil glyphicon-white"></i></a>
                        <!---------- delete Button --->
                        <form id="delete-form-{{ $result->id }}" action="{{ route('cat.destroy',$result->id)}}" method="post" style="display:none">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="{{route('cat.index')}}" onclick="
                                                            if(confirm('هل انت متأكد من الحذف؟')){
                                                                event.preventDefault();
                                                                document.getElementById('delete-form-{{ $result->id }}').submit();
                                                            }else{ event.preventDefault(); }
                        
                        " class="btn btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i></a>
                            <!---------- active & Dis active Button--->
                            <?php //echo btn_ative(ADMIN_SITE.'Cat/active_v/'.$record->id,$record->is_active); ?>
                            <!---------- edit Button --->
                            <?php //echo btn_edit(ADMIN_SITE.'Cat/Edit/'.$record->parent_id.'/'.$record->type.'/'.$record->id); ?>
                            <!---------- delete Button --->
                            <?php //echo btn_delete(ADMIN_SITE.'Cat/Delete/'.$record->id); ?>
                        </td>
                    </tr>
    @endforeach
                </tfoot>
            </table>
@else
                <h2 style="width: 19%;margin-right: 38%;margin-left: 41%;"><center class="alert-warning" style="border-radius: 5px">لا يوجد نتائج</center></h2>
    
@endif
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection