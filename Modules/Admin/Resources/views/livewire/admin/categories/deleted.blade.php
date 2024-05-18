<div>
    <?php
if(count($results)):
?>
          <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
            <thead>
              <tr>
                <th>#</th>
                <th>IMG/الصورة</th>
                <th>الاسم<br/>EN Name</th>
                <th>وسائل الاتصال </th>
                <th>Action/الاجراء</th>
              </tr>
            </thead>
            <tbody>
<?php
$i=1;
foreach ($results as $result):

?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td style="padding: 0px;">
                      <img src="{{ img_chk_exist($result->img) }}" style="width: 70px; height: 60px" />
                    </td>
                    <td class="text-primery" dir="rtl"><?php echo $result->name;  ?></td>
                    <td><?php echo $result->name_en;  ?></td>
                    <td style="padding: 0px;width: 15%;">
                        <!---------- active & Dis active Button --->
                        {!! add_btn_undelete('javascript:void(0);',' wire:click="un_delete('.$result->id.')"') !!}
                        {!! add_btn_fulldelete('javascript:void(0);',' wire:click="full_delete('.$result->id.')"') !!}
                    </td>
                </tr>
<?php $i++; endforeach; ?>
            </tbody>
          </table>
<?php  else: ?>
            <h2 style="width: 17%;margin-right: 40%;margin-left: 40%;"><center class="alert-warning" style="border-radius: 15px">لا يوجد نتائج</center></h2>
<?php endif; ?>
        <!--end: Datatable-->

</div>
