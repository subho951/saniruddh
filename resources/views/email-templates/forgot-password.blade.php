@extends('email-templates.layout')

@section('emailTitle', 'Password reset code')
@section('preheader', 'Use your one-time code to reset your password.')

@section('content')
    <p style="color:#9b6a38;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Password reset</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 16px;">Your verification code</h1>
    <p style="margin:0 0 18px;">Hello {{ $name }}, use this one-time code to continue resetting your password:</p>
    <div style="background:#fffaf3;border:1px solid #e4d3ba;color:#6f2634;font-family:Georgia,'Times New Roman',serif;font-size:32px;letter-spacing:10px;padding:18px 20px;text-align:center;">{{ $remember_token }}</div>
    <p style="color:#7b6b5d;font-size:13px;margin:18px 0 0;">If you did not request a password reset, you can ignore this email.</p>
@endsection
