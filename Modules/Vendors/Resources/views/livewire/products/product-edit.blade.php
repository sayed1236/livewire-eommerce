<div>
    <div class="modal modal-edit fade">
        <div class="modal-overlay"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">edit To <span class="deo-color">Sticky Pencil</span></h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="indes-content">
                        <form action="" method="post" class="tab-wizard wizard-circle">
                            <!-- Step 1 -->

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-12"></div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name" class="form-label">product name </label>
                                            <input wire:model="product_name" type="text" required="required" class="form-control" name="name" placeholder="Sticky Pencil" id="name" />
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">product img </label>

                                            <label class="uploadFile">
                                                <i class="fal fa-file-image"></i>
                                                <span class="filename">product img </span>
                                                <input type="file" class="inputfile form-control" name="Profile-img" />
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">category </label>

                                            <div class="select-box">
                                                <select id="stock" name="stock_id" class="select2">
                                                    <option value="">All Categories</option>
                                                   {{--  @forelse ($categories as $category)  --}}
                                                   {{--  <option value="{{ $category->id }}">{{ $category->name }}</option>  --}}

                                                   {{--  @empty  --}}
                                                   <option value="4">Fashion</option>
                                                   <option value="5" selected>Furniture</option>
                                                   <option value="6">Shoes</option>
                                                   <option value="7">Sports</option>
                                                   <option value="8">Games</option>
                                                   <option value="9">Computers</option>
                                                   <option value="10">Electronics</option>
                                                   <option value="11">Kitchen</option>
                                                   <option value="12">Clothing</option>
                                                   {{--  @endforelse  --}}

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  <div class="col-md-6 col-6">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">stock id </label>

                                            <div class="select-box">
                                                <select id="stock" name="stock_id" class="select2">
                                                    <option value="">All Categories</option>
                                                    <option value="4">Fashion</option>
                                                    <option value="5" selected>Furniture</option>
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
                                    </div>  --}}



                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="enter" class="form-label">description </label>
                                            <textarea  wire:model="product_description" required="required" class="form-control" name="description" placeholder="description description description description"></textarea>
                                        </div>
                                    </div>
 {{--
                                    <div class="col-md-12 col-12 mb-4">
                                        <div class="ch-chk">
                                            <label class="coer">
                                                Active
                                                <input type="checkbox" checked="checked" />
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                        <div class="ch-chk">
                                            <label class="coer">
                                                Out Of stock
                                                <input type="checkbox" />
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>  --}}



                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
                        <button wire:click="editproduct" type="button" class="btn btn-danger">save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
