@extends('admin::admin.layouts.app')

@section('content')

<?php

/* /////////////////------->powered BY: ENG \ Mohamed saeed    <---------------\\\\\\\\\\\\\\\\\\\\\
 * /////////////////-------> tel : 00201117818079 -00201551451595        <---------------\\\\\\\\\\\\\\\\\\\
 * /////////////////------->  email: mohamedsaeed.mso11@gmail.com  <---------------\\\\\\\\\\\\\\\\\\\\\\\ */
?>
<div class="card card-custom">
	<div class="card-header flex-wrap py-5">
		<div class="card-title">
			<h3 class="card-label"><?php echo @$title_page; ?>

			<div class="text-muted pt-2 font-size-sm">


			</div></h3>
        </div>

		<div class="card-toolbar">
            <a  href="{{route('static_pages.create')}}">
                <button type="button" class="btn btn-lg btn btn-primary">
                    <i class="glyphicon glyphicon-pencil glyphicon-white"></i>
                </button>
            </a>
        </div>


    </div>

    <div class="card-body" style="overflow-x: auto;">
            <div class="col-md-6 offset-3" >
@include('admin::includes.messages')
            </div>

<?php
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
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
