<!-- Modal -->
<div wire:ignore.self class="modal fade" id="getOrderData" tabindex="-1" role="dialog" aria-labelledby="getOrderDataTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">تفاصيل الطلب</h5>
          <h5 class="modal-title" id="exampleModalLongTitle">اجمالي سعر الطلب : <span style="color: blue; font-weight:bold;"> {{ @$user_order->order_total_price }} </span></h5>
          <h5 class="modal-title" id="exampleModalLongTitle">اجمالي عدد المنتجات : <span style="color: green; font-weight:bold;"> {{ (isset($user_order) ? count(@$user_order->user_order_detail) : '') }} </span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="">بيانات الطالب</label>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr style="background-color: #eee">
                <th>رقم الطلب</th>
                <th >اسم طالب المنتج</th>
                <th>البريد الالكروني</th>
                <th>رقم الهاتف</th>
                <th> المحافظه</th>
                <th> المدينه </th>
                <th> الحي </th>
              </tr>
            </thead>
            <tbody>
              @if (isset($user_order))
                <tr>
                  <td>{{ @$user_order->order_num }}</td>
                  <td>{{ @$user_order->user->name }}</td>
                  <td>{{ @$user_order->user->email }}</td>
                  <td>{{ @$user_order->user_order_adress->mobile }}</td>
                  <td>{{ @$user_order->user_order_adress->governorate->name }}</td>
                  <td>{{ @$user_order->user_order_adress->city->name }}</td>
                  <td>{{ @$user_order->user_order_adress->street }}</td>
                </tr>
              @endif
            </tbody>
          </table>
  
          <label for="">بيانات الطلب</label>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr style="background-color: #eee">
                <th >اسم المنتج</th>
                <th>المقاس</th>
                <th>اللون</th>
                <th> الكميه</th>
                <th> الصوره </th>
                <th> اجمالي سعر المنتج </th>
              </tr>
            </thead>
            <tbody>
              @if (isset($user_order))
              @foreach ($user_order->user_order_detail as $user_order_detail)
                <tr>
                  <td>{{ @$user_order_detail->product->name }}</td>
                  <td>{{ @$user_order_detail->size->name }}</td>
                  <td>{{ @$user_order_detail->color->name }}</td>
                  <td>{{ @$user_order_detail->count }}</td>
                  <td> 
                    <img src="{{ img_chk_exist(@$user_order_detail->product->img) }}" style="width: 70px; height: 60px" alt="">
                  </td>
                  <td>{{ @$user_order_detail->total_price }}</td>
                </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>
  <!--End Modal -->