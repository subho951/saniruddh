@extends('email-templates.layout')

@section('emailTitle', 'Password updated')
@section('preheader', 'Your account password has been updated successfully.')

@section('content')
    <p style="color:#9b6a38;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Account security</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 16px;">Your password has been updated</h1>
    <p style="margin:0 0 22px;">Hello {{ $name }}, your password was changed successfully. You can continue shopping with your updated credentials.</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fffaf3;border:1px solid #eee1cf;border-collapse:collapse;width:100%;">
        @include('email-templates.partials.detail-row', ['label' => 'Name', 'value' => e($name)])
        @include('email-templates.partials.detail-row', ['label' => 'Email', 'value' => e($email)])
        @include('email-templates.partials.detail-row', ['label' => 'Password', 'value' => '********'])
    </table>
    <p style="background:#f7f0e5;border-left:3px solid #9b6a38;color:#6d5a47;font-size:13px;margin:24px 0 0;padding:13px 15px;">If you did not make this change, please contact us promptly.</p>
@endsection
