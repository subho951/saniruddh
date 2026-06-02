@php
    $productImage = !empty($getProduct->cover_image)
        ? rtrim((string) env('UPLOADS_URL', asset('public/uploads')), '/').'/product/'.$getProduct->cover_image
        : asset('public/uploads/no-image.jpg');
@endphp
@extends('email-templates.layout')

@section('emailTitle', 'Wishlist updated')
@section('preheader', strip_tags($mailHeader))

@section('content')
    <p style="color:#9b6a38;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Wishlist update</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 12px;">Your wishlist has been updated</h1>
    <p style="margin:0 0 22px;">{{ $mailHeader }}</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fffaf3;border:1px solid #eee1cf;border-collapse:collapse;width:100%;">
        <tr>
            <td align="center" style="border-bottom:1px solid #eee4d7;padding:18px;">
                <img src="{{ $productImage }}" alt="{{ $getProduct->name }}" style="display:block;height:auto;max-height:180px;max-width:180px;width:auto;">
            </td>
        </tr>
        @include('email-templates.partials.detail-row', ['label' => 'Product', 'value' => e($getProduct->name)])
        @include('email-templates.partials.detail-row', ['label' => 'Price', 'value' => '&#8377; '.number_format((float) $getProduct->discounted_price, 2)])
        @include('email-templates.partials.detail-row', ['label' => 'SKU', 'value' => e($getProduct->product_sku ?: 'N/A')])
    </table>
@endsection
