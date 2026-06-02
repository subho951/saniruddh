@extends('email-templates.layout')

@section('emailTitle', 'A note from our store')
@section('preheader', 'A message from our store')

@section('content')
    <div style="color:#443b35;font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:1.75;">
        {!! $configuredBody !!}
    </div>
@endsection
