@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
@if (count($result))
            <div class="box-header">
                <h3 class="box-title" style="text-decoration: underline;color:brown">
                    <?php echo 'عرض تفاصيل الطلب'; ?> 
                </h3>
                <div class="pull-right box-tools">
                <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <a href="{{ route('user_orders.t',['type'=>$result->type , 'status'=>$result->status ]) }}">
                    <button class="btn btn-instagram btn-sm" onclick="history.back();"  data-toggle="tooltip" title="Back">رجوع<i class="fa fa-fw fa-mail-reply-all"></i></button>
                </a>
              </div>
            </div>
            <div class="box-body pad">
                <table class="table table-striped table-bordered bootstrap-datatable">
                    <thead>
                        <tr>
                            <th style="width: 25% !important;"><strong>رقم الطلب</strong></th>
                            <th style="width: 30% !important;">{{@$result->order_num}}</th>
                        
                            <td style="width: 10% !important;"><strong>رقم شحنة ارامكس</strong></td>
                            <td style="width: 35% !important;"><a href="{{@$result->aramex_moving_pdf}}" target="_blank">{{$result->aramex_moving_order_id}}</a></td>
                        </tr>
                        <tr>
                            <th style="width: 25% !important;"><strong>الاسم</strong></th>
                            <th style="width: 30% !important;">{{@$result->name.' '.@$result->l_name}}</th>
                        
                            <td style="width: 10% !important;"><strong>الهاتف</strong></td>
                            <td style="width: 35% !important;text-align:right;" dir="ltr">+966-{{$result->userMobile}}</td>
                        </tr>
                        <tr>
                            <td><strong>الايميل</strong></td>
                            <td>{{$result->userEmail}}</td>
                        
                            <td><strong>تليفون  الطلب</strong></td>
                            <td>{{$result->telephone}}</td>
                        </tr>
                        <tr>
                            <td><strong>موبايل الطلب</strong></td>
                            <td style="text-align:right;" dir="ltr">+966-{{$result->mobile}}</td>
                        
                            <td><strong>عنوان الطلب</strong></td>
                            <td>
<?php 
echo 'المدينة: <b style="color:red">'.@$result->city.'</b> &nbsp; - المنطقة: <b style="color:red">'.@$result->region.'</b> &nbsp; - الشارع: <b style="color:red">'.@$result->road; 
echo '</b><br/> البناية رقم: (<b style="color:red">'.@$result->building.'</b>) &nbsp;  &nbsp; - شقة رقم: (<b style="color:red">'.@$result->apartment.'</b>)'; 
//- الطابق  رقم: (<b style="color:red">'.@$result->floor_num.'</b>)
?>
                            </td>
                        </tr>
                        
                    </thead>   
                    <tbody>
                        
                        <tr>
                            <td><strong>نوع الدفع</strong></td>
                            <td>@if($result->payment_type == 1) كريدت كارد @else كاش @endif </td>
                        
                            <td><strong>السعر</strong></td>
                            <td>{{$result->order_total_price}} ريال</td>
                        </tr>
                        <tr>
                            <td><strong>سعر التوصيل</strong></td>
                            <td>{{$result->price_move}} ريال 
                            </td>
                        
                            <td><strong>التاريخ</strong></td>
                            <td>{{$result->created_at}}</td>
                        </tr>
                        <tr>
                          <td colspan="4" style="background-color: purple; color: white;font-size: 22px"><center><strong>الطلبات</strong></center></td>
                        </tr>
@if(!is_null($result->products))
    @foreach ($result->products AS $product)

                            <td  style="text-align: center; font-size: 22px;padding: 40px">
                              <strong>{{$product->name}}</strong>
                            </td>
                            <td colspan="3">
                                
                              <table class="table table-striped table-bordered">
                                <tr>
                                  <td>اجمالى السعر للقطعة</td>
                                  <td>{{$product->total_price}} ريال</td>
                                  <td>  الخصم</td>
                                  <td>{{$product->discount}} ٪</td>
                                </tr>  
                                <tr>
                                  <td>عدد القطع</td>
                                  <td>{{$product->count}}</td>
                                  <td></td>
                                  <td></td>
                                </tr>  
                                <tr>                            
<?php
if(!empty($product->attributes))
{
    $product_attributes= explode('},{',$product->attributes);
?>
<?php
    $ir=1;
    $data_paid_addtion=array();$data_paid_addtion_array=array();
    foreach ($product_attributes AS $product_attribute)
    {
        $product_attribute=explode(',',str_ireplace(array('{','}'), '', $product_attribute));
        foreach($product_attribute as $product_attribute1)
        {
            $product_attribute1_v= explode('-',$product_attribute1);
            echo '<td> <b>'.$product_attribute1_v[1].'</b></td>';
            if($product_attribute1_v[1] == 'Colors')
            {
                echo '<td style="width: 30% !important;" dir="ltr"> <input type="color" name="value" value="'.$product_attribute1_v[2].'" class="form-control" style="width:100%" readonly="" disabled=""> code: '.$product_attribute1_v[2].'</td>';
            }
            else
            {
                echo '<td style="width: 30% !important;" > '.$product_attribute1_v[2].'</td>';
            }
            if($ir>1)
            {
                echo '</tr><tr>';
            }
            $ir++;
        }
        //$product_attribute_id= explode(':',$product_attribute[0]);
        //$product_attribute_name= @explode(':',$product_attribute[1];
        //$product_attribute_value= @explode(':',$product_attribute[2];
        //$meal_name_addtion1= $this->Restaurant_Supplements_Meals_M->get($id_addtion[1],TRUE);
        
    }
}

?>
                                  
                                </tr>
                              </table>
                            
                            </td>
                        </tr>
    @endforeach
@endif

                            
                    </tbody>
                    <tfoot>
                      <tr  style="text-align: center; font-size: 22px;padding: 40px">
                        <td>حالة الطلب <br/>
<?php
if($result->status== '' || $result->status=='new'){
    echo '<b style="font-size: 22px;color: green;">&nbsp;طلب جديــــد<i class="fa fa-fw fa-cart-plus"></i></b>';
}elseif($result->status=='working'){
    echo '<b style="font-size: 22px;color: #00c0ef;">جارى التحضير<i class="fa fa-fw fa-spinner"></i></b>';
}elseif($result->status=='delivering'){
    echo '<b style="font-size: 22px;color: #f39c12;">تم التحضير وجارى توصيلة<i class="fa fa-fw fa-truck"></i></b>';
}elseif($result->status == 'finished'){
    echo '<b style="font-size: 22px;color: #dd4b39;">تم التوصيل واغلاق الاودر  <i class="fa fa-fw fa-close"></i></b>';
}else{
    echo "&nbsp;تــــــم توصيلة";
}
?>
                        </td>
                        <td colspan="3">
                            <a href="?step=working">
                              <button class="btn btn-info btn-sm"   style="font-size: 22px">جارى التحضير<i class="fa fa-fw fa-spinner"></i></button>
                            </a>
                            <a href="?step=delivering">
                              <button class="btn btn-warning btn-sm"  style="font-size: 22px">تم التحضير وجارى توصيلة  <i class="fa fa-fw fa-truck"></i></button>
                            </a>
                            <a href="?step=finished" >
                              <button class="btn btn-flickr btn-sm" style="font-size: 22px" >تم التوصيل واغلاق الاودر <i class="fa fa-fw fa-close"></i></button>
                            </a>
                            
                        </td>
                      </tr>
                    </tfoot>
                </table> 
              <a href="{{ route('user_orders.t',['type'=>$result->type , 'status'=>$result->status ]) }}" style="float: left;">
                <button class="btn btn-instagram btn-sm"    data-toggle="tooltip" title="Back" style="font-size: 22px">رجوع<i class="fa fa-fw fa-mail-reply-all"></i></button>
              </a>
          </div>
        </div>
    </div>
</div>
@else
                <h2 style="width: 19%;margin-right: 38%;margin-left: 41%;"><center class="alert-warning" style="border-radius: 5px">لا يوجد نتائج</center></h2>
    
@endif
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection