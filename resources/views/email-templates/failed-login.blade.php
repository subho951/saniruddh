@extends('email-templates.layout')

@section('emailTitle', 'Sign-in alert')
@section('preheader', 'A sign-in attempt could not be completed.')

@section('content')
    <p style="color:#a24b4b;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">Security notice</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 16px;">Sign-in attempt unsuccessful</h1>
    <p style="margin:0 0 22px;">A recent sign-in attempt could not be completed. If this was you, please check your credentials and try again.</p>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#fffaf3;border:1px solid #eee1cf;border-collapse:collapse;width:100%;">
        @include('email-templates.partials.detail-row', ['label' => 'Email', 'value' => e($email)])
    </table>
@endsection
