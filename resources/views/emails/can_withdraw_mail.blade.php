@extends('emails.layout', [
    'title' => 'Event withdraw notice',
    'header' => 'Event withdraw email.'
])

@section('message')
<h4>Hey {{ $organizer->firstName }},</h4>
Your event <span style="color: #172853;">{{ $event->name }}</span> is closed.
You can withdraw after {{ \Carbon\Carbon::parse($event->end_date)->addDays(7)->format('D., d., M., Y') }}
<div>
    <a href="{{ route('event.details', $event->slug) }}">View more details</a>
</div>
@endsection

@section('info')

@endsection
