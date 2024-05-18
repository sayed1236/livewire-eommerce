<div>
    <!-- Modal -->
        <div  class="modal fade" wire:ignore.self  id="recordsModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center text-warning" id="exampleModalLabel">{{ __('ms_lang.show').' :'.@$result_one->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="card-body col-md-12">
                        <div class="row"  style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable1" style="margin-top: 13px !important">
                                <thead>
                                    <tr class="text-center bg-red-400">
                                        <th>{{ __('ms_lang.name_t') }}</th>
                                        <th>{{ __('ms_lang.category_t') }}</th>
                                        {{-- <th>{{ __('ms_lang.mobile') }}</th> --}}
                                        <th>{{ __('ms_lang.price') }}</th>
                                        <th>{{ __('ms_lang.discount') }}</th>
                                        <th>{{ __('ms_lang.color') }}</th>
                                        <th>{{ __('ms_lang.img_t') }}</th>
                                        <th>{{ __('ms_lang.imgs_t') }}</th>
                                        <th>{{ __('ms_lang.details_t') }}</th>
                                        <th>{{ __('ms_lang.sizes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ @$result_one->name}}</td>
                                        <td>
                                            {{ Auth::user()->user_lang=='ar' ? @$result->category->name : @$result->category->name_en }}
                                            /
                                            {{ Auth::user()->user_lang=='ar' ? @$result->category->parent->name : @$result->category->parent->name_en }}
                                        </td>
                                        <td>{{ @$result_one->price}}</td>
                                        <td>{{ @$result_one->discount}}</td>
                                        <td>{{ @$result_one->color->name}}</td>
                                        <td><img src="{{ img_chk_exist(@$result_one->img) }}" style="width: 70px; height: 60px" /></td>
                                        <td>
                                            @isset($result_one)
                                                @foreach (@$result_one->gallaries as $resu)
                                                    <img src="{{ img_chk_exist(@$resu->img) }}" style="width: 70px; height: 60px" />
                                                @endforeach
                                            @endisset
                                        </td>
                                        <td>{{ @$result_one->details}}</td>
                                        <td>
                                            @isset($result_one)
                                                @foreach ($result_one->product_attributes as $index=>$product_attribute)
                                                    {{ @$product_attribute->size->value }},
                                                @endforeach
                                            @endisset
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    
    @push('scripts')
    
    <script type="text/javascript">
        window.livewire.on('openRecordsModal', result_one => {
            $('#recordsModal').modal('show');
        });
        window.livewire.on('closeRecordsModal', () => {
            $('#recordsModal').modal('hide');
        });
    </script>
    
    @endpush
    