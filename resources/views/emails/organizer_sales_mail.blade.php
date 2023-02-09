@extends('emails.layout', [
    'title' => 'Organizer sales notice',
    'header' => 'Sales notice email'
])

@section('message')

<h4>Hey {{ $organizer->firstName }},</h4> <br>
A guest name {{ $guest->firstName }}, email: {{ $guest->email }} <br>
has just bought ticket of <span style="color: #172853;">{{ $event->name }}</span> event.

@endsection

@section('info')

@endsection
