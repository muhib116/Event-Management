@extends('emails.layout', [
    'title' => 'Checkin notice',
    'header' => 'Event checkin email.'
])

@section('message') 
<span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
<h4>Hey {{ $guest->firstName }},</h4>
You are successfully checked in to <strong>{{ ucfirst($event->name) }}</strong> event
<div>
    <a 
        href="{{ route('event.details', $event->slug) }}"
        style="background:#172853;text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;"
    >
        View more details
    </a>
</div>
@endsection

@section('info')

@endsection
