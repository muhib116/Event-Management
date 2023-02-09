@extends('emails.layout', [
    'title' => 'Ticket mail',
    'header' => 'Ticket mail'
])

@section('message')
Congratulation! Your ticket is ready to download.

@endsection

@section('info')
    <p>
        <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
    </p>
    @foreach ($tickets as $item)
    <a target="_blank" 
        href="{{ route('ticket_view', $item->sales_id) }}" 
        style="background:#172853;text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">
        Download ticket</a>
    @endforeach 

@endsection
