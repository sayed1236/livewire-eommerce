<div>
    <div class="card card-custom">
        <div class="card-body" style="overflow-x: auto;">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('ms_lang.name_t') }}</th>
                    <th >{{ trans('ms_lang.quantity') }}</th>
                    <th>{{ trans('ms_lang.action_t') }}</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($sizess))
                        @foreach ($sizess as $index=>$prod)
                        <tr>
                            <td>{{ $index }}</td>
                            <td><p>{{ @$prod['size']['value'] }}</p></td>
                            <td><p>{{ @$prod['amount'] }}</p></td>
                            <td> 
                                <button type="submite"  class="btn btn-default " style="background-color: rgb(10, 214, 10);color:white" data-toggle="modal" data-target="#exampleModal" wire:click.prevent='edit_get_countity({{  @$prod['id'] }})'>edit</button>
                                {{-- <button type="submite"  class="btn btn-default " style="background-color: red;color:white" wire:click.prevent='remove_exist({{  @$prod['id'] }})'>delete</button> --}}
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
<!-- Modal-->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form wire:click.prevent='store'>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل الكميه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="text" wire:model.lazy='amount' class="form-controler">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">غلق</button>
                    <button type="button" class="btn btn-primary font-weight-bold">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.livewire.on('remove_model', () => {
        $('#exampleModal').modal('hide')
    });
</script>
@endpush
</div>