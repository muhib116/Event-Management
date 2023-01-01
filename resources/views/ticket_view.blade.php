<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
</head>

<body>
    
    <div class="container"> 
        @foreach ($ticketSales->ticket_number as $ticket_number) 
            @php
                $get_img = QrCode::format('svg')->size(100)->generate(json_encode([
                    'guest_name' => $ticketSales->guests->firstName,
                    'guest_id' => $ticketSales->guests->id,
                    'ticket_id' => $ticketSales->id,
                    'ticket_number' => $ticket_number->ticket_number,
                ]));
                $image = "data:image/svg+xml;base64," . base64_encode($get_img);
                $logo = \App\Models\SiteSetting::where('name', 'logo_image')->first();
            @endphp
            <div class="item">
                {{-- <img class="water_mark_image" src="{{ asset($logo->value) }}" alt=""> --}}
                <div class="item-left">
                    <div class="icent">
                        <h2 class="day">{{ date('d', strtotime($ticketSales->ticket->event->start_date)) }}</h2>
                        <p class="month">{{ date('M', strtotime($ticketSales->ticket->event->start_date)) }}</p>
                        <p>{{ date('Y', strtotime($ticketSales->ticket->event->start_date)) }}</p>
                    </div>
                </div> <!-- end item-right -->

                <div class="item-right">
                    {{-- <div>
                        <p class="event">{{ $ticketSales->ticket->ticket_name }}</p> - <h2 class="title">{{ $ticketSales->ticket->event->name }}</h2>
                    </div> --}}
                    <table>
                        <tr>
                            <th>Event name:</th>
                            <td>{{ $ticketSales->ticket->event->name }}</td>
                        </tr>
                        <tr>
                            <th>Ticket Name:</th>
                            <td>{{ $ticketSales->ticket->ticket_name }}</td>
                        </tr>
                        <tr>
                            <th>Start from:</th>
                            <td>{{ date('M d Y', strtotime($ticketSales->ticket->event->start_date)) }} At 
                            {{ date('H:s:i a', strtotime($ticketSales->ticket->event->start_time)) }}</td>
                        </tr>
                        <tr>
                            <th>End at:</th>
                            <td>
                                {{ date('M d Y', strtotime($ticketSales->ticket->event->end_date)) }} At
                                {{ date('H:s:i a', strtotime($ticketSales->ticket->event->end_time)) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Location:</th>
                            <td>
                                {{ $ticketSales->ticket->event->location }}
                            </td>
                        </tr>
                        <tr>
                            <th>Guest:</th>
                            <td>
                                {{ $ticketSales->guests->lastName }}
                            </td>
                        </tr>
                        <tr>
                            <th>Ticket number:</th>
                            <td>
                                {{ $ticket_number->ticket_number }}
                            </td>
                        </tr>
                    </table>
                    <img class="abs_img" src="{{ $image }}">
                </div>
            </div>
        @endforeach 
    </div>

    <style>
        *, ::before, ::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #ffffff;
            font-family: 'Inknut Antiqua', serif;
            font-family: 'Ravi Prakash', cursive;
            font-family: 'Lora', serif;
            font-family: 'Indie Flower', cursive;
            font-family: 'Cabin', sans-serif;
        }

        
        .container {
            padding: 20px;
            margin: 80px auto;
        }
        .event,
        .title {
            display: inline-block;
            margin-right: 10px;
            margin: 0;
            vertical-align: middle;
        }
        .title {
            /* margin: 10px 0; */
            font-weight: 500;
            font-size: 20px;
            /* margin-left: 20px; */
        }
        .container .item {
            /* padding: 100px; */
            background: #fff;
            display: flex;
            gap: 10px;
            padding: 30px;
            border: 1px dashed #0008;
            height: 200px;
            margin-bottom: 50px;
            position: relative;
        }
        .water_mark_image {
            position: absolute;
            display: block;
            width: 600px;
            top: 50%;
            left: 50%;
            opacity: 0.1;
            pointer-events: none;
            transform: translate(-50%, -50%) rotate(-8deg);
        }
        .item::after,
        .container .item-right {
            content: '';
            display: block;
            clear: both;
        }
        .container .item-left {
            float: left;
            width: 20%;
            border-right: 1px dashed #0005;
            height: 100%;
            text-align: center;
            position: relative;
        }
        .container .icent {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .container .item-right {
            float: right;
            width: 75%;
            position: relative;
        }
        .item-right .abs_img {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
        }
        .container .day {
            font-size: 60px;
        }
        .container .month {
            font-size: 30px;
        }
        th {
            text-align: right;
        }
        table, th, td {
            border: 1px solid #fff;
        }
        table {
            border-collapse: collapse;
        }
        table td {
            padding: 3px 5px;
        }
        @media print {
            .item {
                page-break-after: always;
            }
        }

    </style>
</body>

</html>
