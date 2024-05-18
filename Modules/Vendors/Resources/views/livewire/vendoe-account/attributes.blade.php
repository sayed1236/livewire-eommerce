<div>
    <div>
        {{--  @include('sweetalert::alert')  --}}

            <div class="indes-content">
                <div class="">
                    <div class="">
                        <h4 class="title title-underline ls-25 font-weight-bold">Add product attribute</h4>

                        {{--  <form action="#" method="POST" class="addproduct-form ajax-contact">  --}}
                            <div class="row gx-24">
                                <div class="form-group col-md-6">
                                    <input wire:model='name_o_a' type="text" class="form-control" name="name" id="name" placeholder="Name" />
                                    <i class="fal fa-layer-group"></i>
                                </div>
                                @error('name_o_a') <span class="text-danger error">{{ $message }}</span>@enderror

                                <div wire:model="category_id_for_att" class="form-group col-md-6 col-12">
                                    <i class="fal fa-cog"></i>
                                    <select   name="category" id="subject" class="form-select">
                                        <option value="" disabled="disabled" selected="selected" hidden="">attribute category</option>

                                        <option value="0">category</option>
                                        @foreach ($all_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror
                                <div class="form-btn col-12"><button wire:click='add_attribute' class="btn btn-primary" type="submit" name="submitform">add attribute</button></div>
                            </div>
                            <p class="form-messages mb-0 mt-3"></p>
                        {{--  </form>  --}}
                    </div>
                    <div class="col-md-12">
                        @if (session()->has('success_message'))
                        {{--  @dd(session('success_message'))  --}}

                        <div class="alert alert-success alert-simple alert-inline ">
                          <h3>  {{ session('success_message') }}</h3>
                            </div>
                        @endif
                        @if (session()->has('error_message'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <div>


                <div class="indes-content">
                    @if ($all_attributes)
                    <div class="">

                        <div class="">
                            @if (session()->has('success_message_for_att_val'))

                        <div class="alert alert-success alert-simple alert-inline ">
                          <h3>  {{ session('success_message_for_att_val') }}</h3>
                            </div>
                        @endif
                            <h4 class="title title-underline ls-25 font-weight-bold"> products attributes</h4>

                            {{--  <form action="#" method="POST" class="addproduct-form ajax-contact">  --}}
                                <table class="cust-table">
                                    <tr>
                                        <th class="num-th">#</th>
                                        <th class="atr-th">attribute</th>
                                        <th class="vlu-th">values</th>
                                        <th class="new-th">new value</th>
                                        <th class="act-th">action</th>
                                    </tr>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach ($all_attributes as $all_attribute)

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $all_attribute->name}}</td>
                                        <td>  @foreach ($all_attribute->attr_values as $value)
                                            <span>{{ $value->value }}</span>,
                                        @endforeach</td>
                                        <td>
                                            <div class="form-group">
                                                <input wire:key="{{ $i }}"  wire:model.live='value2.{{$all_attribute->id}}'type="text" class="form-control" name="value" id="value" placeholder="Enter New value" />
                                            </div>
                                            @error('value2') <span class="text-danger error">{{ $message }}</span>@enderror
                                    @if (session()->has('err_Att'))
                                    <div class="alert alert-success alert-simple alert-inline ">
                                        <p>  {{ session('err_Att') }}</p>
                                        </div>
                                    @endif

                                        </td>

                                        <td>
                                            <div class="form-btn"><button
                                                {{--  wire:loading='value2.{{$all_attribute->id}}'  --}}
                                                wire:click="add_attribute_value( {{ $all_attribute->id }})" class="btn btn-primary" type="submit" name="submitform">add</button></div>
                                        </td>
                                    </tr>
                                    @php
                                    $i++;

                                    @endphp
                                 @endforeach

                                </table>

                                <p class="form-messages mb-0 mt-3"></p>
                            {{--  </form>  --}}
                        </div>
                    </div>
                    @endif
     </div>
            </div>
        {{--  </form>  --}}
    </div>

</div>
