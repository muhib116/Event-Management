@extends('emails.layout', [
    'title' => 'Promotion mail',
    'header' => 'Promotion mail'
])

@section('message')

<h4>Hey {{ $guest->firstName }},</h4>
{{ $organizer->first_name }} just create a new event you may interested.
Event date 
@php
    $start_at = \Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime("$event->start_date $event->start_time")));
    echo $start_at->format('d, D., M., Y H:s');
@endphp 
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
