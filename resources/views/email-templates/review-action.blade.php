@extends('email-templates.layout')

@section('emailTitle', 'Review status updated')
@section('preheader', strip_tags($mailHeader))

@section('content')
    <p style="color:{{ (int) $status === 1 ? '#4f7a5c' : '#a24b4b' }};font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Review update</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 12px;">Your review status has changed</h1>
    <p style="margin:0 0 22px;">{{ $mailHeader }}</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fffaf3;border:1px solid #eee1cf;border-collapse:collapse;width:100%;">
        @include('email-templates.partials.detail-row', ['label' => 'Product', 'value' => e($getProduct->name)])
        @include('email-templates.partials.detail-row', ['label' => 'SKU', 'value' => e($getProduct->product_sku ?: 'N/A')])
        @include('email-templates.partials.detail-row', ['label' => 'Rating', 'value' => e($getReview->rating).'/5'])
        @include('email-templates.partials.detail-row', ['label' => 'Title', 'value' => e($getReview->title)])
        @include('email-templates.partials.detail-row', ['label' => 'Comments', 'value' => nl2br(e($getReview->comment))])
    </table>
@endsection
