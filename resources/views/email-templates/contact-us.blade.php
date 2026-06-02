@extends('email-templates.layout')

@section('emailTitle', 'New customer enquiry')
@section('preheader', 'A new customer enquiry has been received.')

@section('content')
    <p style="color:#9b6a38;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Customer care</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 16px;">New customer enquiry</h1>
    <p style="margin:0 0 22px;">A visitor submitted the following message through the storefront contact form.</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fffaf3;border:1px solid #eee1cf;border-collapse:collapse;width:100%;">
        @include('email-templates.partials.detail-row', ['label' => 'Full name', 'value' => e($name)])
        @include('email-templates.partials.detail-row', ['label' => 'Email', 'value' => e($email)])
        @include('email-templates.partials.detail-row', ['label' => 'Phone', 'value' => e($phone)])
        @include('email-templates.partials.detail-row', ['label' => 'Subject', 'value' => e($subject)])
        @include('email-templates.partials.detail-row', ['label' => 'Message', 'value' => nl2br(e($description))])
    </table>
@endsection
