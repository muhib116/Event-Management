@extends('emails.layout', [
    'title' => 'Event end email.',
    'header' => 'Event end email.'
])

@section('message')
<h4>Hey,</h4>
<p>Event <strong>{{ $event->name }}</strong> is over</p>

@endsection

@section('info')
<span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
<div>
    <h5>Summery:</h5>
    <p>Organizer: <strong>{{ $organizer->first_name }}</strong></p>
    <p>Commission: <strong>{{ $summery['commission'] }}</strong></p>
    <p>Attendees: <strong>{{ $summery['total_attendees'] }}</strong></p>
    <p>Total sales: <strong>{{ $summery['total_sales_amount'] }}</strong></p>
</div>
@endsection
