@include('front.elements.user-page-title', ['userPageTitle' => 'Order '.$getOrderDetail->order_no, 'userPageCopy' => 'Placed on '.date('d M, Y', strtotime($getOrderDetail->order_date)).'.'])

<div class="row">
    <div class="col-lg-7">
        @include('front.elements.order-summary', [
            'summaryItems' => $orderItems,
            'summaryProducts' => $orderProducts,
            'summaryTotals' => [
                'subtotal' => $getOrderDetail->subtotal,
                'discount' => $getOrderDetail->disc_amount,
                'amount_after_discount' => $getOrderDetail->amount_after_disc,
                'shipping' => $getOrderDetail->shipping_amt,
                'tax' => $getOrderDetail->tax_amt,
                'net' => $getOrderDetail->net_amt,
            ],
            'summaryTitle' => 'Order Summary',
        ])
    </div>
    <div class="col-lg-5">
        <div class="storefront-user-section">
            <h2>Delivery Address</h2>
            <p>{{ $getOrderDetail->s_fname }} {{ $getOrderDetail->s_lname }}<br>{{ $getOrderDetail->s_street }}<br>{{ $getOrderDetail->s_suburb }}, {{ $getOrderDetail->s_state }} {{ $getOrderDetail->s_postcode }}<br>{{ $getOrderDetail->s_country }}<br>{{ $getOrderDetail->s_phone }}</p>
            <p><strong>Payment:</strong> {{ $getOrderDetail->payment_mode ?: 'Pending' }}</p>
            @if($getOrderDetail->tracking_number)<p><strong>Tracking:</strong> {{ $getOrderDetail->tracking_number }}</p>@endif
            <a class="btn btn-outline-dark rounded-pill" target="_blank" href="{{ url('user/print-invoice/'.\App\Helpers\Helper::encoded($getOrderDetail->id)) }}">Print Invoice</a>
        </div>
        @if(! $getOrderDetail->is_cancel_request && in_array($getOrderDetail->status, [1, 2]))
            <div class="storefront-form-card mt-4">
                <h3>Request Cancellation</h3>
                <form action="{{ url('user/order-details/'.\App\Helpers\Helper::encoded($getOrderDetail->id)) }}" method="post">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $getOrderDetail->id }}">
                    <input type="hidden" name="page_name" value="{{ \App\Helpers\Helper::encoded('user/order-list') }}">
                    <div class="single-form"><label>Reason *</label><select name="cancel_order_reason" class="form-select" required><option value="">Choose a reason</option>@foreach($cancelOrderReasons as $reason)<option value="{{ $reason->name }}">{{ $reason->name }}</option>@endforeach<option value="Other">Other</option></select></div>
                    <div class="single-form"><label>Details</label><textarea name="cancel_order_description"></textarea></div>
                    <button class="btn btn-outline-dark rounded-pill" type="submit">Submit Request</button>
                </form>
            </div>
        @endif
    </div>
</div>
