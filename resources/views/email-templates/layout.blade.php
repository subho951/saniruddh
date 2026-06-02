@php
    $generalSetting = $generalSetting ?? \App\Models\GeneralSetting::find(1);
    $siteName = data_get($generalSetting, 'site_name') ?: config('app.name', 'Saniruddh');
    $siteUrl = data_get($generalSetting, 'site_url') ?: url('/');
    $siteMail = data_get($generalSetting, 'site_mail');
    $sitePhone = data_get($generalSetting, 'site_phone');
    $logoFile = trim((string) data_get($generalSetting, 'site_logo'));
    $logoUrl = $logoFile !== ''
        ? asset('public/uploads/'.ltrim($logoFile, '/'))
        : asset('public/frontend/images/logo/logo.png');
    $emailTitle = trim($__env->yieldContent('emailTitle')) ?: $siteName;
    $preheader = trim($__env->yieldContent('preheader')) ?: 'A message from '.$siteName;
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>{{ $emailTitle }}</title>
    <style>
        @media only screen and (max-width: 640px) {
            .email-shell { width: 100% !important; }
            .email-body { padding: 30px 22px !important; }
            .email-header { padding: 28px 22px 24px !important; }
            .email-footer { padding: 22px !important; }
            .email-title { font-size: 27px !important; }
        }
    </style>
</head>
<body style="background:#f4efe7;margin:0;padding:0;">
    <div style="display:none;font-size:1px;color:#f4efe7;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;">{{ $preheader }}</div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f4efe7;border-collapse:collapse;width:100%;">
        <tr>
            <td align="center" style="padding:42px 16px;">
                <table role="presentation" class="email-shell" width="620" cellspacing="0" cellpadding="0" border="0" style="background:#ffffff;border:1px solid #eadfce;border-collapse:collapse;max-width:620px;width:620px;">
                    <tr>
                        <td style="background:#6f2634;height:6px;line-height:6px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="email-header" align="center" style="background:#fffdf9;border-bottom:1px solid #eadfce;padding:34px 34px 28px;">
                            <a href="{{ $siteUrl }}" style="text-decoration:none;">
                                <img src="{{ $logoUrl }}" alt="{{ $siteName }}" style="border:0;display:block;height:auto;margin:0 auto;max-height:74px;max-width:250px;width:auto;">
                            </a>
                            <p style="color:#9b6a38;font-family:Georgia,'Times New Roman',serif;font-size:11px;letter-spacing:3px;margin:18px 0 0;text-transform:uppercase;">Curated with care</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="email-body" style="color:#443b35;font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:1.75;padding:38px 42px;">
                            @yield('content')
                        </td>
                    </tr>
                    <tr>
                        <td class="email-footer" align="center" style="background:#332d2a;color:#eee2d3;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:1.7;padding:24px 34px;">
                            <p style="font-family:Georgia,'Times New Roman',serif;font-size:17px;margin:0 0 6px;">{{ $siteName }}</p>
                            @if($siteMail || $sitePhone)
                                <p style="margin:0 0 6px;">
                                    @if($siteMail)<a href="mailto:{{ $siteMail }}" style="color:#eee2d3;text-decoration:none;">{{ $siteMail }}</a>@endif
                                    @if($siteMail && $sitePhone)<span style="color:#a99076;"> &nbsp;|&nbsp; </span>@endif
                                    @if($sitePhone)<a href="tel:{{ $sitePhone }}" style="color:#eee2d3;text-decoration:none;">{{ $sitePhone }}</a>@endif
                                </p>
                            @endif
                            <p style="color:#c9b9a7;margin:0;">&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
