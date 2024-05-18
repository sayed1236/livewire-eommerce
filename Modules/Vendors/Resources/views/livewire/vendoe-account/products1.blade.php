<div>
    <div class="indes-content">
        <div class="">
            <div class="">

    <div class="icon-box icon-box-side icon-box-light">
        {{-- <span class="icon-box-icon icon-account mr-2">
             <i class="w-icon-user"></i>  
        </span>--}}
        <div class="icon-box-content">
            <h3 class="title title-underline ls-25 font-weight-bold">Add product</h3>
        </div>
    </div>
    {{--  @dd($name)  --}}
    {{--  <form class="form account-details-form">  --}}
        <div class="row gx-24">
                {{--  <div class="form-group">
                    <label for="firstname">name  *</label>
                    <input wire:model='name' type="text" id="firstname" name="firstname" placeholder=""
                        class="form-control form-control-md">
                </div>  --}}
                <div class="form-group col-md-6">
                    <input  wire:model='name' type="text" class="form-control" name="name" id="name" placeholder="Name" />
                    <i class="fal fa-layer-group"></i>
                </div>
                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror

                {{--  <div class="form-group">
                    <label for="lastname"> description *</label>
                    <input wire:model='description' type="text" id="lastname" name="lastname" placeholder=""
                        class="form-control form-control-md">
                </div>  --}}
                <div class="form-group col-md-6 col-12">
                    <textarea  wire:model='description' name="description" id="description" cols="30" rows="3" class="form-control" placeholder="description"></textarea>
                    <i class="fal fa-comment-alt-edit"></i>
                </div>
                @error('description') <span class="text-danger error">{{ $message }}</span>@enderror

            {{--  <div class="col-md-4">
                <div class="form-group">
                    <label for=""> Product Category *</label>

                        <select  wire:model='category_id' class="form-control form-control-md" id="" >
                            <option selected value="0">Choose...</option>
                            <option selected value="1">test...</option>
                           @foreach ($all_categories as $category)
                           <option value="$category->id">{{ $category->name }}</option>
                           @endforeach

                          </select>
                </div>
                @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror

            </div>  --}}
            <div wire:model="category_id" class="form-group col-md-6 col-12">
                <i class="fal fa-cog"></i>
                <select   name="category" id="subject" class="form-select">
                    <option value="" disabled="disabled" selected="selected" hidden="">product category</option>

                    <option value="0">general</option>
                    <option value="1">test</option>
                    @foreach ($all_categories as $category)
                    <option value="$category->id">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror
            {{--  <div class="col-md-4">
                <div class="form-group">
                    @php
                    $i=0;

                    @endphp
                    @foreach ($all_attributes as $attribute)

                    <label for="">{{ $attribute->name  }} *</label>

                        <select  wire:model='main_att.{{ $i }}' class="form-control form-control-md" id="" >
                            <option selected value="0">Choose...</option>
                            @foreach ($attribute->attr_values as $value)
                            <option  value="{{$value->id}}">{{ $value->value }}</option>
                            @endforeach
                        @php
                        $i++;
                        @endphp

                          </select>

                          @endforeach

                </div>
                @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror

            </div>  --}}
                @php
                $i=0;
                @endphp
                @if ($all_attributes)

            @foreach ($all_attributes as $attribute)

            <div wire:model="main_att.{{ $i }}" class="form-group col-md-6 col-12">
                <i class="fal fa-cog"></i>
                <select  name="sizes" id="subject" class="form-select" >
                    <option value="" disabled="disabled" selected="selected" hidden="">{{ $attribute->name  }} *</option>
                    @foreach ($attribute->attr_values as $value)
                    <option  value="{{$value->id}}">{{ $value->value }}</option>
                    @endforeach
                </select>
            </div>
                @php
                $i++;
                @endphp
            @endforeach
            @endif



            {{--  <div class="col-md-4">
                <div class="form-group">
                    <label for="">  value *</label>

                        <select  wire:model='att_val' class="form-control form-control-md" id="" >
                            <option selected value="0">Choose...</option>
                          @if ($values)
                          @foreach ($values as $value)
                          <option value="$value->id">{{ $value->value }}</option>
                          @endforeach
                          @endif


                          </select>
                </div>
                @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror

            </div>  --}}
            {{--  <div class="col-md-6">
                <div class="form-group">

                    <label for="formFileMultiple"> Image *</label>
                    <input wire:model='image' class="form-control" type="file" id="formFileMultiple"
                    class="form-control form-control-md" >
                </div>

                @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                @if ($image)
                Photo Preview:
                    <img src="{{ $image->temporaryUrl() }}">
                @endif
            </div>  --}}
            <div class="form-group col-md-6">
                <!--
                <label for="file-img">
                <input  type="file" class="form-control" name="name" id="file-img" placeholder="file img" />
                <i class="fal fa-img"></i>
                </label>
                -->
                <i class="fal fa-file-image"></i>
                <label class="uploadFile">
                    <span class="filename">Upload Image</span>
                    <input wire:model='image' type="file" class="inputfile form-control" name="file" />
                </label>
            </div>
            @error('image') <span class="text-danger error">{{ $message }}</span>@enderror

        </div>

        <button   wire:click='add_product' class="btn btn-primary">Save Product</button>
        <div class="col-md-12">
            @if (session()->has('success_message_product'))
            {{--  @dd(session('success_message'))  --}}

            <div class="alert alert-success alert-simple alert-inline ">
              <h3>  {{ session('success_message_product') }}</h3>
                </div>
            @endif
            @if (session()->has('error_message'))
                <div class="alert alert-danger">
                    {{ session('error_message') }}
                </div>
            @endif

        </div>
    </div>
    </div>
    </div>
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

                                    <option value="0">general</option>
                                    <option value="1">test</option>
                                    @foreach ($all_categories as $category)
                                    <option value="$category->id">{{ $category->name }}</option>
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
                                        {{ $value->value }} ,
                                    @endforeach</td>
                                    <td>
                                        <div class="form-group">
                                            <input wire:key="{{ $i }}"  wire:model='value2.{{$all_attribute->id}}'type="text" class="form-control" name="value" id="value" placeholder="Enter New value" />
                                        </div>
                                        @error('value2') <span class="text-danger error">{{ $message }}</span>@enderror
                                @if (session()->has('err_Att'))
                                <div class="alert alert-success alert-simple alert-inline ">
                                    <h3>  {{ session('err_Att') }}</h3>
                                    </div>
                                @endif

                                    </td>

                                    <td>
                                        <div class="form-btn"><button wire:click="add_attribute_value( {{ $all_attribute->id }})" class="btn btn-primary" type="submit" name="submitform">add</button></div>
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
