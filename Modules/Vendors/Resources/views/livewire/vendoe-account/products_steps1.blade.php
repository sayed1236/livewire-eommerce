<div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="">
                <div class="card px-0 pb-0 mt-3 mb-3">



                    <div class="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="Product"><strong>Product</strong></li>
                            <li id="Details"><strong>Details</strong></li>
                            <li id="Discount"><strong>amounts</strong></li>
                            <li id="confirm"><strong>Finish</strong></li>

                        </ul>
                        {{--  <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>  --}}
                        <br />
                        <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">


                                <div class="indes-content">
                                    <div class="">
                                        <div class="appointment-form-wrap">



                                            <div class="row">
                                                <div class="col-7">
                                                    <h4 class="title title-underline ls-25 font-weight-bold">Add product</h4>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 1 - 4</h2>
                                                </div>
                                            </div>


                                            <div class="row gx-24">

                                                <div class="form-group col-md-6">

                                                    <input wire:model='name' type="text" class="form-control" name="name" id="name" placeholder="Name" />

                                                    <i class="fal fa-comment-alt-edit"></i>
                                                    @if ($errors->has('name'))
                                                    @error('name')
                                                    <span class="alert alert-danger">{{ $message }}</span>
                                                    @enderror
                                                    @endif

                                                </div>

                                                <div class="form-group col-md-6 col-12">
                                                    <div class="form-group">
                                                        <i class="fal fa-comment-alt-edit"></i>
                                                        <input wire:model="min_amount_to_buy" type="text" required="required" class="form-control" name="M.O.Q" placeholder="M.O.Q" id="M.O.Q" />
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6 col-12">
                                                    <i class="fal fa-cog"></i>
                                                    <select wire:model='category_id' name="category" id="subject" class="form-select">
                                                        <option value="" disabled="disabled" selected="selected" hidden="">
                                                        </option>
                                                        <option selected value="0">Choose...</option>
                                                        <option selected value="1">test...</option>
                                                    </select>
                                                    @if ($errors->has('category_id'))
                                                    @error('category_id')
                                                    <span class="alert alert-danger">{{ $message }}</span>
                                                    @enderror
                                                    @endif
                                                </div>


                                                {{-- <div class="form-group col-md-6 col-12">
                                                    <i class="fal fa-cog"></i>
                                                    <select name="sizes" id="subject" class="form-select">
                                                        <option value="" disabled="disabled" selected="selected" hidden="">sizes</option>

                                                        <option value="s900">s900</option>
                                                        <option value="S1100">S1100</option>
                                                        <option value="s2800">s2800</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-12">
                                                    <i class="fal fa-cog"></i>
                                                    <select name="colour" id="subject" class="form-select">
                                                        <option value="" disabled="disabled" selected="selected" hidden="">colour</option>

                                                        <option value="s900">s900</option>
                                                        <option value="S1100">S1100</option>
                                                        <option value="s2800">s2800</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-12">
                                                    <i class="fal fa-cog"></i>
                                                    <select name="product" id="subject" class="form-select">
                                                        <option value="" disabled="disabled" selected="selected" hidden="">Select Subject</option>

                                                        <option value="s900">s900</option>
                                                        <option value="S1100">S1100</option>
                                                        <option value="s2800">s2800</option>
                                                    </select>
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
                                                    @if ($errors->has('image'))
                                                    @error('image')
                                                    <span class="alert alert-danger">{{ $message }}</span>
                                                    @enderror
                                                    @endif
                                                </div>


                                                <div class="form-group col-md-12 col-12">
                                                    <textarea wire:model='description' name="description" id="description" cols="30" rows="3" class="form-control" placeholder="description"></textarea>
                                                    <i class="fal fa-comment-alt-edit"></i>
                                                    @if ($errors->has('description'))
                                                    @error('description')
                                                    <span class="alert alert-danger">{{ $message }}</span>
                                                    @enderror
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button wire:click='add_product' class="btn btn-primary">Save Product</button>
                            </div>

                            <input  type="button" name="next" class="next action-button" value="Next" />


                        </fieldset>

                        <fieldset>
                            <div class="form-card">


                                <div class="indes-content">
                                    <div class="">
                                        <div class="appointment-form-wrap">


                                            <div class="row">
                                              {{--  @if (session()->has('success_message_product'))

                                              <div class="alert alert-success alert-simple alert-inline ">
                                                  <h3> {{ session('success_message_product') }}</h3>
                                              </div>
                                              @endif
                                              @if (session()->has('error_message'))
                                              <div class="alert alert-danger">
                                                  {{ session('error_message') }}
                                              </div>
                                              @endif  --}}
                                              <div class="col-7">

                                                    <h4 class="title title-underline ls-25 font-weight-bold">Add product Details</h4>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 2 - 4</h2>
                                                </div>
                                            </div>




                                            <div class="row">

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
                                                    <select name="sizes" id="subject" class="form-select select2">
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
                                                @endif
                                                {{--  <div class="form-btn col-12"><button wire:click='add_product_attribute' class="btn btn-primary">add attribute</button></div>  --}}

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
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="indes-content mt-3">
                                    <div class="">
                                        <div class="appointment-form-wrap">
                                            <h4 class="title title-underline ls-25 font-weight-bold">Add product attribute</h4>

                                            <div class="row gx-24">
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" />
                                                    <i class="fal fa-comment-alt-edit"></i>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="value" id="value" placeholder="value" />
                                                    <i class="fal fa-comment-alt-edit"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  --}}
                            </div>
                            <input  type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>

                        <fieldset>
                            <div class="form-card">

                                <div class="indes-content">
                                    <div class="">
                                        <div class="appointment-form-wrap">

                                            <div class="row">
                                                <div class="col-7">
                                                    <h4 class="title title-underline ls-25 font-weight-bold">amount & discount</h4>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 3 - 4</h2>
                                                </div>
                                            </div>





                                            <div class="row">
                                                @if (session()->has('message'))
                                                <div class="alert alert-success alert-simple alert-inline show-code-action">
                                                    <h4 class="alert-title">Well done!</h4>
                                                    {{ session('message') }}
                                                </div>

                                                @endif
                                                @if (session()->has('error'))

                                                <div class="alert alert-error alert-simple alert-inline show-code-action">
                                                    <h4 class="alert-title">Oh snap!</h4>
                                                    {{ session('error') }}
                                                </div>
                                                @endif
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-6 col-6">

                                                            <div class="form-group">
                                                                {{--  <label for="stock" class="form-label">stock id </label>  --}}

                                                                <div class="select-box">
                                                                    <select wire:model="stock_id" id="stock" name="stock_id">
                                                                        <option value="" disabled="disabled" selected="selected" hidden="">
                                                                        </option>
                                                                        <option value="0">stock </option>
                                                                        @if ($my_stocks)
                                                                        @foreach ($my_stocks as $my_stock)
                                                                        <option value="{{$my_stock->id}}">{{ $my_stock->stock_name }}</option>

                                                                        @endforeach
                                                                        @endif

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                {{--  <label for="Amount" class="form-label">Amount </label>  --}}
                                                                <input wire:model='quantity' type="text" required="required" class="form-control" name="amount" placeholder="amount" id="Amount" />
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                {{--  <label for="Purchasing" class="form-label">Purchasing price </label>  --}}
                                                                <input wire:model='buing_price' type="text" required="required" class="form-control" name="purchasing_price" placeholder="Purchasing price" id="Purchasing" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                {{--  <label for="Selling" class="form-label">Selling price </label>  --}}
                                                                <input wire:model="selling_price" type="text" required="required" class="form-control" name="selling_price" placeholder="Selling price" id="Selling" />
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6 col-6">
                                                            <div class="form-group">
                                                                <label for="expire" class="form-label">Date of expire </label>
                                                                <input wire:model='date_of_expire' type="date" required="required" class="form-control" name="date_expire" id="expire" />
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6 col-6">
                                                            <div wire:model='date_of_enter' class="form-group">
                                                                <label for="enter" class="form-label">Date of enter </label>
                                                                <input  type="date" required="required" class="form-control" name="date_enter" id="enter" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{--  <div class="te-done">
                                                        <button wire:click="add_new_amount" class="btn btn-primary">Done</button>
                                                    </div>  --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input  type="button" name="next" class="next action-button" value="Finish" />
                            <input type="button" name="previous" class="previous action-button-previous" value="previous" />

                        </fieldset>

                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Finish:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 4 - 4</h2>
                                    </div>
                                </div>
                                <br />
                                <br />
                                <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2>
                                <br />
                                <h3 class="purple-text text-center"><strong> now you can add discount to this product </strong></h3>

                                <div class="row justify-content-center">
                                    <div class="col-3">
                                        <img src="https://i.imgur.com/GwStPmg.png" class="fit-image" /></div>
                                </div>
                                <br />
                                <br />
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="purple-text text-center">You Have Successfully upload Product</h5>
                                    </div>
                                </div>
                            </div>


                            <input wire:click="add_new_amount"  type="button" name="next" class="next action-button" value="New Product" />
                            <input type="button" name="previous" class="previous action-button-previous" value="previous" />


                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
