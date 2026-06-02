@extends('email-templates.layout')

@section('emailTitle', 'Order confirmation '.$getOrder->order_no)
@section('preheader', 'Your order '.$getOrder->order_no.' has been placed successfully.')

@section('content')
    <p style="color:#4f7a5c;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Order confirmed</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 12px;">Thank you for your order</h1>
    <p style="margin:0 0 22px;">Your order has been placed successfully. We will keep you informed as it moves through fulfilment.</p>
    @include('email-templates.partials.order-details', ['getOrder' => $getOrder])
@endsection
