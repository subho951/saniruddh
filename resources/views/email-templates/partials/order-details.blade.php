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
