@if ($paginator->hasPages())
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="kt_datatable_info" role="status" aria-live="polite">
            Showing 1 to 10 of 15 entries (filtered from 50 total entries)
            عرض
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_full_numbers" id="kt_datatable_paginate">
            <ul class="pagination">
                <li class="paginate_button page-item first disabled" id="kt_datatable_first">
                    <a href="#" aria-controls="kt_datatable" data-dt-idx="0" tabindex="0" class="page-link">
                        <i class="ki ki-double-arrow-back"></i>
                    </a>
                </li>
                <li class="paginate_button page-item previous disabled" id="kt_datatable_previous">
                    <a href="#" aria-controls="kt_datatable" data-dt-idx="1" tabindex="0" class="page-link">
                        <i class="ki ki-arrow-back"></i>
                    </a>
                </li>
                <li class="paginate_button page-item active">
                    <a href="#" aria-controls="kt_datatable" data-dt-idx="2" tabindex="0" class="page-link">1</a>
                </li>
                <li class="paginate_button page-item ">
                    <a href="#" aria-controls="kt_datatable" data-dt-idx="3" tabindex="0" class="page-link">2</a>
                </li>
                <li class="paginate_button page-item next" id="kt_datatable_next">
                    <a href="#" aria-controls="kt_datatable" data-dt-idx="4" tabindex="0" class="page-link">
                        <i class="ki ki-arrow-next"></i>
                    </a>
                </li>
                <li class="paginate_button page-item last" id="kt_datatable_last">
                    <a href="#" aria-controls="kt_datatable" data-dt-idx="5" tabindex="0" class="page-link">
                        <i class="ki ki-double-arrow-next"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif
