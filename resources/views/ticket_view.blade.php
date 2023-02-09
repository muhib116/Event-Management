<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket</title>

    @php
        $site_settings = \App\Models\SiteSetting::where('name', 'footer_logo_image')->first();
    @endphp
    <style>
        @font-face {
            font-family: "Hero";
            src: url({{ asset('Hero/Commercial/TTF/Hero-Bold.ttf') }}),
                url({{ asset('Hero/Commercial/TTF/Hero-Light.ttf')}}),
                url({{ asset('Hero/Commercial/TTF/Hero-Regular.ttf')}});
        }
        html body#root__body *:not(i,.fa, .fa-regular,.fa-solid,.fa-brand,.fas,.far,.fab) {
            font-family: "Hero" !important;
        }
    </style>
</head>

<body id="root__body"> 
    <div class="container">
        @foreach ($ticketSales->ticket_number as $ticket_number)
            @php
                $get_img = QrCode::format('svg')
                    ->size(100)
                    ->generate(
                        json_encode([
                            'guest_name' => $ticketSales->guests->firstName,
                            'guest_id' => $ticketSales->guests->id,
                            'ticket_id' => $ticketSales->id,
                            'ticket_number' => $ticket_number->ticket_number,
                        ]),
                    );
                $image = 'data:image/svg+xml;base64,' . base64_encode($get_img);
                $logo = \App\Models\SiteSetting::where('name', 'logo_image')->first();
            @endphp
            <div class="ticket">
                <div class="ticket--center">
                    <div class="ticket--center--row">
                        <div class="ticket--center--col">
                            <span>Your ticket for</span>
                            <strong>{{ @$ticketSales->ticket->event->name }}</strong>
                        </div>
                    </div>
                    <div class="ticket--center--row">
                        <div class="ticket--center--col">
                            <span class="ticket--info--title">Date and time</span>
                            <span class="ticket--info--subtitle">{{ date('D., M., Y', strtotime($ticketSales->ticket->event->start_date)) }}</span>
                            <span class="ticket--info--content">{{ date('H:s', strtotime($ticketSales->ticket->event->start_time)) }}</span>
                        </div>
                        <div class="ticket--center--col">
                            <span class="ticket--info--title">Location</span>
                            <span class="ticket--info--subtitle">
                                {{ @$ticketSales->ticket->event->location }} <br>
                                {{ @$ticketSales->ticket->event->settings->streetName }}
                                @if (@$ticketSales->ticket->event->settings->houseNumber)
                                    <div>{{ @$ticketSales->ticket->event->settings->houseNumber }},</div>
                                @endif
                                {{ @$ticketSales->ticket->event->settings->postcode }}
                                @if (@$ticketSales->ticket->event->settings->city)
                                    <div>{{ @$ticketSales->ticket->event->settings->city }},</div>
                                @endif
                                {{ @$ticketSales->ticket->event->settings->country }}
                            </span> 
                        </div>
                    </div>
                    <div class="ticket--center--row">
                        <div class="ticket--center--col">
                            <span class="ticket--info--title">Ticket type</span>
                            <span class="ticket--info--content">{{ @$ticketSales->ticket->event->eventType }}</span>
                        </div>
                        <div class="ticket--center--col">
                            <span class="ticket--info--title">Order info</span>
                            <span class="ticket--info--content">
                                Ticket id {{ @$ticket_number->ticket_number }}. <br>
                                <div>
                                    Ordered By {{ $ticketSales->guests->lastName }}
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="ticket--end" style="position: relative;">
                    <img style="position: absolute;width:100%;height:100%;top:0;left:0;z-index:-1;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEoAAAAgCAYAAAC1v+5NAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABcSURBVGhD7dDBAAAgFECxLFLI5/uzFEIPYIcJbO0zlz9RkahIVCQqEhWJikRFoiJRkahIVCQqEhWJikRFoiJRkahIVCQqEhWJikRFoiJRkahIVCQqEhWJikQlcx+BuX4T2MaLzgAAAABJRU5ErkJggg==" alt="">
                    <div style="display: flex;justify-content: center;align-items: center;z-index:1;">
                    <img src="{{ $image }}">
                </div>
                
                
                <div><img width="150" src="{{ asset($site_settings->value) }}" title="logo" alt="logo"></div>
                </div>
            </div>
        @endforeach
    </div>
    
    <style>
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .ticket {
            display: flex;
            font-family: Roboto;
            margin: 16px;
            border: 1px solid #e0e0e0;
            position: relative;
        }

        .ticket:before {
            content: '';
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-top-color: transparent;
            border-left-color: transparent;
            position: absolute;
            transform: rotate(-45deg);
            left: -18px;
            top: 50%;
            margin-top: -16px;
            border-radius: 50%;
        }

        .ticket:after {
            content: '';
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-top-color: transparent;
            border-left-color: transparent;
            position: absolute;
            transform: rotate(135deg);
            right: -18px;
            top: 50%;
            margin-top: -16px;
            border-radius: 50%;
        }

        .ticket--start {
            position: relative;
            border-right: 1px dashed #e0e0e0;
        }

        .ticket--start:before {
            content: '';
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-top-color: transparent;
            border-left-color: transparent;
            border-right-color: transparent;
            position: absolute;
            transform: rotate(-45deg);
            left: -18px;
            top: -2px;
            margin-top: -16px;
            border-radius: 50%;
        }

        .ticket--start:after {
            content: '';
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-top-color: transparent;
            border-left-color: transparent;
            border-bottom-color: transparent;
            position: absolute;
            transform: rotate(-45deg);
            left: -18px;
            top: 100%;
            margin-top: -16px;
            border-radius: 50%;
        }

        .ticket--start>img {
            display: block;
            padding: 24px;
            height: 270px;
        }

        .ticket--center {
            padding: 24px;
            flex: 1;
        }

        .ticket--center--row {
            display: flex;
        }

        .ticket--center--row:not(:last-child) {
            padding-bottom: 48px;
        }

        .ticket--center--row:first-child span {
            color: #172853;
            text-transform: uppercase;
            line-height: 24px;
            font-size: 13px;
            font-weight: 500;
        }

        .ticket--center--row:first-child strong {
            font-size: 20px;
            font-weight: 400;
            text-transform: uppercase;
        }

        .ticket--center--col {
            display: flex;
            flex: 1;
            width: 50%;
            box-sizing: border-box;
            flex-direction: column;
        }

        .ticket--center--col:not(:last-child) {
            padding-right: 16px;
        }

        .ticket--end {
            padding: 24px;
            /* background: #172853; */
            /* background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGcAAAAlCAYAAABf0feeAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABtSURBVGhD7dExAQAgDMAw5KEHZXM4bOToEQU5983GVA6sHFg5sHJg5cDKgZUDKwdWDqwcWDmwcmDlwMqBlQMrB1YOrBxYObByYOXAyoGVAysHVg6sHFg5sHJg5cDKgZUDKwdWDqwcWDmwclizHydt4yl5rUkzAAAAAElFTkSuQmCC'); */
            display: grid;
            align-items: center;
            position: relative;
        }

        .ticket--end:before {
            content: '';
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            position: absolute;
            transform: rotate(-45deg);
            right: -18px;
            top: -2px;
            margin-top: -16px;
            border-radius: 50%;
        }

        .ticket--end:after {
            content: '';
            width: 32px;
            height: 32px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-right-color: transparent;
            border-left-color: transparent;
            border-bottom-color: transparent;
            position: absolute;
            transform: rotate(-45deg);
            right: -18px;
            top: 100%;
            margin-top: -16px;
            border-radius: 50%;
        }

        .ticket--end>div:first-child {
            flex: 1;
        }

        .ticket--end>div:first-child>img {
            width: 128px;
            padding: 4px;
            background-color: #fff;
        }

        .ticket--end>div:last-child>img {
            display: block;
            margin: 0 auto;
        }

        .ticket--info--title {
            text-transform: uppercase;
            color: #757575;
            font-size: 13px;
            line-height: 24px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ticket--info--subtitle {
            font-size: 16px;
            line-height: 24px;
            font-weight: 500;
            color: #172853;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ticket--info--content {
            font-size: 13px;
            line-height: 24px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
<script>
window.print();
</script>
</body>

</html>
