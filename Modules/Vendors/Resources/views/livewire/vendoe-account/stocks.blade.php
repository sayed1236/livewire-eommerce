<div>
    <div class="indes-content">
    <div class="">
        <div class="">

        <div class="icon-box icon-box-side icon-box-light">
           {{-- <span class="icon-box-icon icon-account mr-2">
                  <i class="w-icon-user"></i> 
            </span> --}}
            <div class="icon-box-content">
                <h4 class="title title-underline ls-25 font-weight-bold">Add Warehouse</h4>
            </div>
        </div>
        {{--  @dd($name)  --}}
        {{--  <form class="form account-details-form" action="#" method="get">  --}}
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                   
                    <input wire:model="name" type="text"  id="firstname" name="firstname" placeholder="Name  *"
                        class="form-control form-control-md">
                </div>
                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    
                    <input type="text" wire:model='id_number' id="firstname" name="firstname" placeholder="Id Number *"
                        class="form-control form-control-md">
                </div>
                @error('id_number') <span class="text-danger error">{{ $message }}</span>@enderror

            </div>
            <div class="col-md-6">
                <div class="form-group">
                   
                    <input type="text" wire:model='address' id="lastname" name="lastname" placeholder="Address *"
                        class="form-control form-control-md">
                </div>
                @error('address') <span class="text-danger error">{{ $message }}</span>@enderror

            </div>
            <div class="col-md-6">
                <div class="form-group">
                  
                    <input type="text" wire:model="notes" id="lastname" name="lastname" placeholder="Notes *"
                        class="form-control form-control-md">
                </div>
                @error('notes') <span class="text-danger error">{{ $message }}</span>@enderror

            </div>

        </div>

        <button type="submit"  wire:click='add_stock' class="btn btn-primary">add Warehouse</button>
        <div class="row">
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
    </div>
    </div>
    {{--  </form>  --}}
   <div>
    <div class="mt-4">
        <div class="">
            <div class="icon-box-content">
                <h4 class="title title-underline ls-25 font-weight-bold">My Warehouses</h4>
            </div>
      <table class="cust-table">
        <thead>
          <tr>
            <th class="num-th">#</th>
            <th class="atr-th">Warehouse Id number</th>
            <th class="atr-th">Name</th>
            <th class="atr-th">Warehouse address</th>
            <th class="atr-th">Warehouse notes</th>
            <th class="atr-th">Action</th>
          </tr>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @if ($stocks)

          @foreach ($stocks as $stock)
          <tr>
            <td>{{ $i }}</th>
            <td>{{ $stock->stock_id_num }}</td>
            <td>{{ $stock->stock_name	 }}</td>
            <td>{{ $stock->address }}</td>
            <td>{{ $stock->notes }}</td>
            <td>
                <div class="dropdown">
                    <button class="btn-dots dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button wire:click="activation({{ $stock->id }})" class="view-action dropdown-item"><i class="fal fa-edit"></i>
                                @if ($stock->is_active =='y')
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
          </tr>
          @php
          $i++;

          @endphp
          @endforeach
          @endif


        </tbody>
      </table>
     </div>
    </div>
   </div>


</div>
