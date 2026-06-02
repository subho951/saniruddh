@extends('email-templates.layout')

@section('emailTitle', 'Welcome to our store')
@section('preheader', 'Your account registration is complete.')

@section('content')
    <p style="color:#9b6a38;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Welcome</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 16px;">Your account is ready</h1>
    <p style="margin:0 0 22px;">Hello {{ $name }}, thank you for joining us. Your registration has been completed successfully.</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fffaf3;border:1px solid #eee1cf;border-collapse:collapse;width:100%;">
        @include('email-templates.partials.detail-row', ['label' => 'Name', 'value' => e($name)])
        @include('email-templates.partials.detail-row', ['label' => 'Email', 'value' => e($email)])
    </table>
@endsection
