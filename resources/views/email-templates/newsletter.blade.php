@extends('email-templates.layout')

@section('emailTitle', $title)
@section('preheader', \Illuminate\Support\Str::limit(strip_tags($description), 110))

@section('content')
    <p style="color:#9b6a38;font-size:11px;font-weight:bold;letter-spacing:2px;margin:0 0 10px;text-transform:uppercase;">From our journal</p>
    <h1 class="email-title" style="color:#382f2b;font-family:Georgia,'Times New Roman',serif;font-size:32px;font-weight:normal;line-height:1.2;margin:0 0 18px;">{{ $title }}</h1>
    <div style="color:#51463f;font-size:15px;line-height:1.8;">
        {!! $description !!}
    </div>
    @if(!empty($attachment))
        <p style="background:#f7f0e5;border-left:3px solid #9b6a38;color:#6d5a47;font-size:13px;margin:24px 0 0;padding:13px 15px;">A related attachment is included with this email.</p>
    @endif
@endsection
