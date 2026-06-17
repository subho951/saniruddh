@php
    $orderDate = trim(
        ($getOrder->order_date ? date('d M Y', strtotime($getOrder->order_date)) : '')
        .' '
        .($getOrder->order_time ? date('h:i A', strtotime($getOrder->order_time)) : '')
    );
    $paymentLabel = (int) $getOrder->payment_status === 1
        ? 'Paid'
        : ($getOrder->payment_mode === 'COD' ? 'Cash on delivery' : 'Pending');
    $billingAddress = e(trim($getOrder->b_fname.' '.$getOrder->b_lname))
        .'<br>'.e($getOrder->b_email)
        .'<br>'.e($getOrder->b_phone)
        .'<br>'.e(trim($getOrder->b_street.', '.$getOrder->b_suburb.', '.$getOrder->b_state.' '.$getOrder->b_postcode.', '.$getOrder->b_country, ' ,'));
    $shippingAddress = e(trim($getOrder->s_fname.' '.$getOrder->s_lname))
        .'<br>'.e($getOrder->s_email)
        .'<br>'.e($getOrder->s_phone)
        .'<br>'.e(trim($getOrder->s_street.', '.$getOrder->s_suburb.', '.$getOrder->s_state.' '.$getOrder->s_postcode.', '.$getOrder->s_country, ' ,'));
    $orderItems = \App\Models\OrderDetail::where('order_id', '=', $getOrder->id)->get();
    $orderProducts = \App\Models\Product::whereIn('id', $orderItems->pluck('product_id')->filter()->unique())->get()->keyBy('id');
@endphp
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fffaf3;border:1px solid #eee1cf;border-collapse:collapse;width:100%;">
    @include('email-templates.partials.detail-row', ['label' => 'Order number', 'value' => e($getOrder->order_no)])
    @include('email-templates.partials.detail-row', ['label' => 'Placed on', 'value' => e($orderDate)])
    @include('email-templates.partials.detail-row', ['label' => 'Order total', 'value' => '&#8377; '.number_format((float) $getOrder->net_amt, 2)])
    @include('email-templates.partials.detail-row', ['label' => 'Payment', 'value' => e($getOrder->payment_mode ?: 'Pending').' &middot; '.e($paymentLabel)])
    @include('email-templates.partials.detail-row', ['label' => 'Billing address', 'value' => $billingAddress])
    @include('email-templates.partials.detail-row', ['label' => 'Shipping address', 'value' => $shippingAddress])
    @if(!empty($getOrder->tracking_number))
        @include('email-templates.partials.detail-row', ['label' => 'Tracking', 'value' => e($getOrder->tracking_number)])
    @endif
</table>

@if($orderItems->isNotEmpty())
    <h2 style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:20px;font-weight:normal;line-height:1.25;margin:26px 0 12px;">Order items</h2>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #eee1cf;border-collapse:collapse;width:100%;">
        <thead>
            <tr>
                <th align="left" style="background:#6f2634;color:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:11px;letter-spacing:.6px;padding:10px 9px;text-transform:uppercase;">Product</th>
                <th align="left" style="background:#6f2634;color:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:11px;letter-spacing:.6px;padding:10px 9px;text-transform:uppercase;">Size</th>
                <th align="right" style="background:#6f2634;color:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:11px;letter-spacing:.6px;padding:10px 9px;text-transform:uppercase;">Qty</th>
                <th align="right" style="background:#6f2634;color:#ffffff;font-family:Arial,Helvetica,sans-serif;font-size:11px;letter-spacing:.6px;padding:10px 9px;text-transform:uppercase;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderItems as $orderItem)
                @php
                    $orderProduct = $orderProducts->get($orderItem->product_id);
                    $orderItemSize = \App\Helpers\Helper::orderItemVariationText($orderItem, 'Standard', false);
                    $lineAmount = (float) ($orderItem->subtotal ?? $orderItem->total);
                @endphp
                <tr>
                    <td style="border-bottom:1px solid #eee4d7;color:#443b35;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:1.55;padding:11px 9px;">
                        {{ data_get($orderProduct, 'name', 'Product') }}
                        @if(data_get($orderProduct, 'color'))
                            <br><span style="color:#806f62;font-size:12px;">Color: {{ data_get($orderProduct, 'color') }}</span>
                        @endif
                    </td>
                    <td style="border-bottom:1px solid #eee4d7;color:#806f62;font-family:Arial,Helvetica,sans-serif;font-size:13px;padding:11px 9px;">{{ $orderItemSize }}</td>
                    <td align="right" style="border-bottom:1px solid #eee4d7;color:#443b35;font-family:Arial,Helvetica,sans-serif;font-size:13px;padding:11px 9px;">{{ $orderItem->qty }}</td>
                    <td align="right" style="border-bottom:1px solid #eee4d7;color:#443b35;font-family:Arial,Helvetica,sans-serif;font-size:13px;padding:11px 9px;">&#8377; {{ number_format($lineAmount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
