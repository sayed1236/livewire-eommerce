<div>
    <div class="indes-content">
        <div class="">
            {{-- <div class="modal modal-delete fade">
        <div class="modal-overlay"></div>

        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fal fa-times"></i>
                    </div>
                    @if (session()->has('delete_message'))
                    <div class="alert alert-success alert-simple alert-inline show-code-action">
                        <h4 class="alert-title">Well done!</h4>
                        {{ session('delete_message') }}
        </div>

        @endif
        <h4 class="modal-title w-100">Are you sure ?</h4>
        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <p>Do you really want to delete these product? This process cannot be undone.</p>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
        @if ($hide!=1)
        <button wire:click="delete_product" type="button" class="btn btn-danger">Delete</button>
        @endif

    </div>
</div>
</div>

</div> --}}


<div class="sao-carts">
    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item flex-fill as-done"  title="Step 1">
            <a class="nav-link active  mx-auto d-flex align-items-center justify-content-center" href="" id="step1-tab">
                
				<div class="sp-num">1</div>
                <strong>Product</strong>
            </a>
        </li>
        <li class="nav-item flex-fill" title="Step 2">
            <a class="nav-link  mx-auto d-flex align-items-center justify-content-center" href="" id="step2-tab" title="Step 2">
                
				<div class="sp-num">2</div>
                <strong>Details</strong>
            </a>
        </li>
        <li class="nav-item flex-fill" title="Step 3">
            <a class="nav-link  mx-auto d-flex align-items-center justify-content-center" href="" id="step3-tab" title="Step 3">
                
				<div class="sp-num">3</div>
                <strong>amounts</strong>
            </a>
        </li>
        <li class="nav-item flex-fill" title="Step 4">
            <a class="nav-link  mx-auto d-flex align-items-center justify-content-center" href="" id="step4-tab" title="Step 4">
                
				<div class="sp-num">4</div>
                <strong>Finish</strong>
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{ $show_active }}" role="tabpanel" id="step1" aria-labelledby="step1-tab">

            <div class="form-card">


                <div class="indes-content">
                    <div class="">
                        <div class="appointment-form-wrap">



                            <div class="row">
                                <div class="col-7">
                                    <h4 class="title title-underline ls-25 font-weight-bold">Add product</h4>
                                    @if (session()->has('success_message_product'))

                                    <div class="alert alert-success alert-simple alert-inline ">
                                        <h3> {{ session('success_message_product') }}</h3>
                                    </div>
                                    @endif
                                    @if (session()->has('error_message'))
                                    <div class="alert alert-danger">
                                        {{ session('error_message') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 4</h2>
                                </div>
                            </div>


                            <div class="row gx-24">

                                <div class="form-group col-md-6">

                                    <input wire:model="name" type="text" class="form-control" name="name" id="name" placeholder="Name">

                                    <i class="fal fa-comment-alt-edit"></i>
                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->
                                    @if ($errors->has('name'))
                                    @error('name')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                    @endif

                                </div>

                                <div class="form-group col-md-6 col-12">
                                   
                                        <i class="fal fa-comment-alt-edit"></i>
                                        <input wire:model="min_amount_to_buy" type="text" required="required" class="form-control" name="M.O.Q" placeholder="min. order quantity 'M.O.Q' " id="M.O.Q">
                                   
                                    @if ($errors->has('min_amount_to_buy'))
                                    @error('min_amount_to_buy')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                    @endif
                                </div>

                                <div class="form-group col-md-6 col-12">
                                    <i class="fal fa-cog"></i>
                                    <select  wire:model.change="category_id" name="category_id" class="form-select111">
                                        {{-- <option value="" disabled="disabled"></option> --}}
                                        <option value="0">select category</option>
                                        @foreach ($categories as $categorie)
                                        <optgroup label="{{ $categorie->name }} ">
                                            @foreach ($categorie->sub_category as $sub)
                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                            @endforeach
                                        </optgroup>

                                        @endforeach


                                    </select>
                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->
                                    @if ($errors->has('category_id'))
                                    @error('category_id')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                    @endif
                                </div>





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
                                        <input wire:model="image" type="file" class="inputfile form-control" name="file">
                                    </label>
                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->
                                    @if ($errors->has('image'))
                                    @error('image')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                    @endif
                                </div>


                                <div class="form-group col-md-12 col-12">
                                    <textarea wire:model="description" name="description" id="description" cols="30" rows="3" class="form-control" placeholder="description"></textarea>
                                    <i class="fal fa-comment-alt-edit"></i>
                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->
                                    @if ($errors->has('description'))
                                    @error('description')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                    @endif
                                </div>


                            </div>

                            {{--  <div>
                                <button wire:click.prevent='add_product' class="btn btn-primary">Save Product</button>
                            </div>  --}}
                            <div class="d-flex justify-content-end">
                                <a  wire:click.prevent='add_product' class="btn btn-primary">add product and next</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="tab-pane fade {{ $show_active2 }}" role="tabpanel" id="step2" aria-labelledby="step2-tab">

            <div class="appointment-form-wrap">
                <div class="row">
                    <div class="col-7">
                        <h4 class="title title-underline ls-25 font-weight-bold">Add product Details</h4>
                        @if (session()->has('success_message_attribute'))

                        <div class="alert alert-success alert-simple alert-inline ">
                            <h3> {{ session('success_message_attribute') }}</h3>
                        </div>
                        @endif
                        @if (session()->has('error_message'))
                        <div class="alert alert-danger">
                            {{ session('error_message') }}
                        </div>
                        @endif
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 2 - 4</h2>
                    </div>
                </div>
                <div class="row">
                    @if (session()->has('null_message_attribute'))
                    <div class="alert alert-danger">
                        {{ session('null_message_attribute') }}
                    </div>
                    @endif
                    @php
                    $i=0;
                    @endphp
                    @if ($all_attributes)
                    {{-- @dd($all_attributes)  --}}
                    @foreach ($all_attributes as $attribute)
                    {{-- @dd($all_attribute)  --}}

                    {{-- @foreach ($all_attribute->attribute as $attribute)  --}}
                    {{-- @dd($attribute->attribute)  --}}
                    <div wire:model="main_att.{{ $i }}" class="form-group col-md-6 col-6">
                        <i class="fal fa-cog"></i>
                        <select name="sizes" id="subject" class="form-select">
                            <option value="" disabled="disabled" selected="selected" hidden="">{{ $attribute->attribute->name  }} *</option>
                            @foreach ($attribute->attribute->attr_values as $value)
                            <option value="{{$value->id}}">{{ $value->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    @php
                    $i++;
                    @endphp
                    {{-- @endforeach  --}}
                    @endforeach
                    {{--  <div class="form-btn col-12"><button wire:click.prevent='add_product_attribute' class="btn btn-primary">add attribute</button></div>  --}}
                    @else
                    <div>
                        <h6>you must add the product firstely </h6>
                    </div>
                    @endif


                    {{-- <div class="col-md-6 col-6">
                                    <div class="form-group">

                                        <i class="fal fa-cog"></i>

                                        <select id="stock" name="stock_id">
                                            <option value="">Stock Id</option>
                                            <option value="4">Fashion</option>
                                            <option value="5">Furniture</option>
                                            <option value="6">Shoes</option>
                                            <option value="7">Sports</option>
                                            <option value="8">Games</option>
                                            <option value="9">Computers</option>
                                            <option value="10">Electronics</option>
                                            <option value="11">Kitchen</option>
                                            <option value="12">Clothing</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-comment-alt-edit"></i>
                                        <input type="text" required="required" class="form-control" name="amount" placeholder="amount" id="Amount" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-comment-alt-edit"></i>
                                        <input type="text" required="required" class="form-control" name="purchasing_price" placeholder="purchasing price" id="Purchasing" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-comment-alt-edit"></i>
                                        <input type="text" required="required" class="form-control" name="selling_price" placeholder="selling_price" id="Selling" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">

                                        <i class="fal fa-calendar-alt"></i>
                                        <input type="date" required="required" class="form-control" name="date_expire" id="expire" placeholder="date_expire" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-calendar-alt"></i>
                                        <input type="date" required="required" class="form-control" name="date_enter" id="enter" />
                                    </div>
                                </div>  --}}
                    {{-- active and out  of stock ckeck  box  --}}
                    {{-- <div class="col-md-12 col-12">

                                    <div class="form-checkbox">
                                        <input type="checkbox" class="custom-checkbox" id="Conditions" name="Active" required="">
                                        <label for="Conditions">Active</label>
                                    </div>




                                    <div class="form-checkbox">
                                        <input type="checkbox" class="custom-checkbox" id="Conditions" name="out-stock" required="">
                                        <label for="Conditions">Out Of stock</label>
                                    </div>




                                </div>  --}}
                </div>
                {{-- <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-cog"></i>

                                        <select id="stock" name="stock_id">
                                            <option value="">Stock Id</option>
                                            <option value="4">Fashion</option>
                                            <option value="5">Furniture</option>
                                            <option value="6">Shoes</option>
                                            <option value="7">Sports</option>
                                            <option value="8">Games</option>
                                            <option value="9">Computers</option>
                                            <option value="10">Electronics</option>
                                            <option value="11">Kitchen</option>
                                            <option value="12">Clothing</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-comment-alt-edit"></i>
                                        <input type="text" required="required" class="form-control" name="amount" placeholder="amount" id="Amount" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-comment-alt-edit"></i>
                                        <input type="text" required="required" class="form-control" name="purchasing_price" placeholder="purchasing price" id="Purchasing" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-comment-alt-edit"></i>
                                        <input type="text" required="required" class="form-control" name="selling_price" placeholder="selling_price" id="Selling" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-calendar-alt"></i>
                                        <input type="date" required="required" class="form-control" name="date_expire" id="expire" placeholder="date_expire" />
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <i class="fal fa-calendar-alt"></i>
                                        <input type="date" required="required" class="form-control" name="date_enter" id="enter" />
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-checkbox">
                                        <input type="checkbox" class="custom-checkbox" id="Conditions" name="Active" required="" />
                                        <label for="Conditions">Active</label>
                                    </div>

                                    <div class="form-checkbox">
                                        <input type="checkbox" class="custom-checkbox" id="Conditions" name="out-stock" required="" />
                                        <label for="Conditions">Out Of stock</label>
                                    </div>
                                </div>
                            </div>  --}}


                <div class="d-flex justify-content-between">
                    {{--  <a href="#step1" class="btn btn-dark previous link-to-tab"> Back</a>  --}}
                    <a wire:click.prevent='add_product_attribute' class="btn btn-primary"> Add and Next</a>
                </div>

            </div>
        </div>



        <div class="tab-pane fade {{ $show_active3 }}" role="tabpanel" id="step3" aria-labelledby="step3-tab">


            <div class="appointment-form-wrap">

                <div class="row">
                    <div class="col-7">
                        <h4 class="title title-underline ls-25 font-weight-bold">amount</h4>
                    </div>
                    @if (session()->has('success_amount'))

                    <div class="alert alert-success alert-simple alert-inline ">
                        <h3> {{ session('success_amount') }}</h3>
                    </div>
                    @endif
                    @if (session()->has('error_message'))
                    <div class="alert alert-danger">
                        {{ session('error_message') }}
                    </div>
                    @endif
                    <div class="col-5">
                        <h2 class="steps">Step 3 - 4</h2>
                    </div>
                </div>





                <div class="row">
                    <!--[if BLOCK]><![endif]-->
                    <!--[if ENDBLOCK]><![endif]-->
                    <!--[if BLOCK]><![endif]-->
                    <!--[if ENDBLOCK]><![endif]-->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-6">

                                <div class="form-group">

                                    @if (session()->has('error_logic'))
                                    <div class="alert alert-danger">
                                        {{ session('error_logic') }}
                                    </div>
                                    @endif
                                    <div class="select-box">
                                        <select wire:model="stock_id" id="stock" name="stock_id">
                                            <option value="" disabled="disabled" selected="selected" hidden="">
                                            </option>
                                            <option value="0">Warehouse </option>
                                            @forelse ($my_stocks as $my_stock)
                                            <option value="{{ $my_stock->id }}">{{ $my_stock->stock_name }} </option>

                                            @empty

                                            @endforelse

                                            <!--[if BLOCK]><![endif]-->
                                            <!--[if BLOCK]><![endif]-->
                                            <!--[if ENDBLOCK]><![endif]-->
                                            <!--[if ENDBLOCK]><![endif]-->

                                        </select>
                                    </div>
                                    @if ($errors->has('stock_id'))
                                    @error('stock_id')
                                    <span class="alert alert-danger">you must enter the Warehouse</span>
                                    @enderror
                                    @endif
                                </div>
                            </div>



                            <div class="col-md-6 col-6">
                                <div class="form-group">

                                    <input wire:model="quantity" type="text" required="required" class="form-control" name="amount" placeholder="amount" id="Amount">
                                </div>
                                @if ($errors->has('quantity'))
                                @error('quantity')
                                <span class="alert alert-danger">you must enter the quantity</span>
                                @enderror
                                @endif
                            </div>



                            <div class="col-md-6 col-6">
                                <div class="form-group">

                                    <input wire:model="buing_price" type="text" required="required" class="form-control" name="purchasing_price" placeholder="Purchasing price" id="Purchasing">
                                </div>
                                @if ($errors->has('buing_price'))
                                @error('buing_price')
                                <span class="alert alert-danger">you must enter the buying price</span>
                                @enderror
                                @endif
                            </div>

                            <div class="col-md-6 col-6">
                                <div class="form-group">

                                    <input wire:model="selling_price" type="text" required="required" class="form-control" name="selling_price" placeholder="Selling price" id="Selling">
                                </div>
                                @if ($errors->has('selling_price'))
                                @error('selling_price')
                                <span class="alert alert-danger">you must enter the selling price</span>
                                @enderror
                                @endif
                            </div>


                            <div class="col-md-6 col-6">
                                <div wire:model="date_of_enter" class="form-group">
                                    <label for="enter" class="form-label">Date of enter </label>
                                    <input type="date" required="required" class="form-control" name="date_enter" id="enter">
                                </div>
                                @if ($errors->has('date_of_enter'))
                                @error('date_of_enter')
                                <span class="alert alert-danger">you must enter the date of enter</span>
                                @enderror
                                @endif
                            </div>

                            <div class="col-md-6 col-6">
                                <div class="form-group">
                                    <label for="expire" class="form-label">Date of expire </label>
                                    <input wire:model="date_of_expire" type="date" required="required" class="form-control" name="date_expire" id="expire">
                                </div>
                                @if ($errors->has('date_of_expire'))
                                @error('date_of_expire')
                                <span class="alert alert-danger">you must enter the date of expire</span>
                                @enderror
                                @endif
                            </div>




                        </div>
                        {{--  <div class="form-btn col-12"><button wire:click='add_new_amount' class="btn btn-primary">add attribute</button></div>  --}}


                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    {{--  <a href="#step2" class="btn btn-dark previous link-to-tab"> Back</a>  --}}
                    <a wire:click='add_new_amount' class="btn btn-primary">add amount and next</a>
                </div>


            </div>


        </div>
        <div class="tab-pane fade {{ $show_active4 }}" role="tabpanel" id="step4" aria-labelledby="step4-tab">

            <div class="appointment-form-wrap">
                <div class="form-card suc-te">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="fs-title">Finish:</h2>
                        </div>
                        <div class="col-5">
                            <h2 class="steps">Step 4 - 4</h2>
                        </div>
                    </div>


                    <h2 class="purple-text text-center">SUCCESS !</h2>

                    <h3 class="purple-text text-center">now you can add discount to this product </h3>
                    <h2 class="purple-text text-center">add now ?? </h2>


                    <div class="row justify-content-center">
                        <div class="col-3">
                            <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"></div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-7 text-center">
                            <h5 class="purple-text text-center">You Have Successfully upload Product</h5>
                        </div>
                    </div>


                    <div class="d-flex justify-content-between">
                        <a href="#step3" class="btn btn-dark previous link-to-tab"> Back</a>
                        <a href="{{ url('vendors/stocks-products') }}" class="btn btn-secondary next link-to-tab">go to product view -> </a>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

</div>
</div>
</div>

