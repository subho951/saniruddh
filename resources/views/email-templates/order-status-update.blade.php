@extends('email-templates.layout')

@section('emailTitle', 'Order update '.$getOrder->order_no)
@section('preheader', strip_tags($mailHeader))

@section('content')
    <p style="color:#9b6a38;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Order update</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 12px;">Your order status has changed</h1>
    <p style="margin:0 0 22px;">{{ $mailHeader }}</p>
    @include('email-templates.partials.order-details', ['getOrder' => $getOrder])
@endsection
