<div>
	    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-0">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Orders</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
<div class="page-content vendor-sty">
<div class="container">
    <div class="indes-content">

	<div class="">
        <div class="appointment-form-wrap curve-white">

    <div class="tab-pane" id="account-orders">

<h4 class="title title-underline ls-25 font-weight-bold"> Orders</h4>

        <table class="cust-table">
            <thead>
                <tr>
                    <th class="order-id">Order</th>
                    <th class="order-date">Date</th>
                    <th class="order-status">Status</th>
                    <th class="order-total">Total</th>
                    <th class="order-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($myorders)

             @forelse ($myorders as $myorder)
                <tr>
                    @switch($myorder->status)
                    @case('process')

                    $status='status-process';
                    @break
                    @case('rejected')
                    $status='status-rejected';

                    @break
                    @default
                    @php
                    $status='status-success';

                    @endphp

                    @endswitch
                    <td class="order-id">{{ @$myorder->order_num }}</td>
                    <td class="order-date">{{ @$myorder->created_at }}</td>
                    <td class="order-status {{ $status }}">{{ @$myorder->status }}</td>
                    <td class="order-total"><span class="order-price">{{ @$myorder->order_total_price }}</span>
                         {{--  for <span class="order-quantity"> 1</span> item</td>  --}}
                    <td class="order-action">
                        <a href="{{ url('/vendors/order-details',$myorder->id)}}" class="">View</a>


                    </td>
                </tr>
                @empty

                @endforelse
                @else
                <div>
                    <h5>                    your order will be here
                    </h5>
                </div>

                @endif



            </tbody>
        </table>

        {{--  <a href="shop-both-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Go Shop<i class="w-icon-long-arrow-right"></i></a>  --}}
    </div>
</div></div></div></div></div>
</div>