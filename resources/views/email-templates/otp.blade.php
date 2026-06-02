@extends('email-templates.layout')

@section('emailTitle', 'Your verification code')
@section('preheader', 'Use your one-time verification code to continue.')

@section('content')
    <p style="color:#9b6a38;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Verification</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 16px;">Your one-time code</h1>
    <p style="margin:0 0 18px;">Enter this code to continue. For your security, do not share it with anyone.</p>
    <div style="background:#fffaf3;border:1px solid #e4d3ba;color:#6f2634;font-family:Georgia,'Times New Roman',serif;font-size:32px;letter-spacing:10px;padding:18px 20px;text-align:center;">{{ $otp }}</div>
    <p style="color:#7b6b5d;font-size:13px;margin:18px 0 0;">If you did not request this code, no action is required.</p>
@endsection
