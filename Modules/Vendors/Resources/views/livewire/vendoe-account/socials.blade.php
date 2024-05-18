<div>
    <div class="">
        <div class="">
    <div class="icon-box icon-box-side icon-box-light">
        <div class="icon-box-content">
            <h4 class="title title-underline ls-25 font-weight-bold">Add new social contact</h4>
        </div>
    </div>
    {{--  @dd($name)  --}}
    {{--  <form class="form account-details-form">  --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""> social type *</label>

                        <select  wire:model='social_id' class="form-control form-control-md" id="" >
                            <option selected>Choose...</option>
                            @foreach ($socials as $social)
                            <option value="{{ $social->id }}">{{ $social->name }}</option>

                            @endforeach
                          </select>
                </div>
                @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lastname"> address & url *</label>
                    <input wire:model='value' type="text" id="lastname" name="lastname" placeholder=""
                        class="form-control form-control-md">
                </div>
                @error('description') <span class="text-danger error">{{ $message }}</span>@enderror

            </div>
            {{--  <div class="col-md-6">
                <div class="form-group">
                    <label for=""> Product Category *</label>

                        <select  wire:model='category_id' class="form-control form-control-md" id="" >
                            <option selected>Choose...</option>
                            <option value="1">home</option>
                            <option value="2">art</option>
                            <option value="3">wishing</option>
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
        </div>

        <button   wire:click='add_product' class="btn btn-primary">Save Changes</button>
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


    {{--  </form>  --}}
    <div >

        @if ($company_socials)
        <div class="mt-4">
            <div class="">
                <div class="icon-box-content">
                    <h4 class="title title-underline ls-25 font-weight-bold">My Socials</h4>
                </div>
        <table class="cust-table">
          <thead>
            <tr>
              <th scope="num-th">#</th>
              <th scope="num-th">Type</th>
              <th scope="num-th">Name</th>
              <th scope="num-th">action</th>
              {{--  <th scope="col">Stock address</th>
              <th scope="col">Stock notes</th>  --}}
            </tr>
          </thead>
          <tbody>
              @php
                  $i=1;
              @endphp


            @foreach ($company_socials as $company_social)
            <tr>
              <td>{{ $i }} </th>
              <td> {{ $company_social->social->name }}</td>
              <td>{{ $company_social->social_path	 }}</td>
              <td>
                <div class="dropdown">
                    <button class="btn-dots dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button wire:click="activation({{ $company_social->id }})" class="view-action dropdown-item"><i class="fal fa-edit"></i>
                                @if ($company_social->is_active =='Y')
                                    dis active
                                @else
                                active
                                @endif

                            </button>
                        </li>

                        {{--  <li>
                            <a href="#" class="delete-action dropdown-item"><i class="fal fa-trash-alt"></i> Delete</a>
                        </li>  --}}
                    </ul>
                </div>
            </td>
              {{--  <td>{{ $company_social->address }}</td>
              <td>{{ $company_social->notes }}</td>  --}}
            </tr>
            @php
            $i++;

            @endphp
            @endforeach


          </tbody>
        </table>
        @endif
            </div>
        </div>

     </div>
</div>
