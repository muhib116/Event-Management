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
            @endphp
            <div class="item">
                <div class="item-left">
                    <div class="icent">
                        <h2 class="day">{{ date('d', strtotime($ticketSales->ticket->event->start_date)) }}</h2>
                        <p class="month">{{ date('M', strtotime($ticketSales->ticket->event->start_date)) }}</p>
                        <p>{{ date('Y', strtotime($ticketSales->ticket->event->start_date)) }}</p>
                    </div>
                </div> <!-- end item-right -->

                <div class="item-right">
                    <p class="event">{{ $ticketSales->ticket->ticket_name }}</p>
                    <h2 class="title">{{ $ticketSales->ticket->event->name }}</h2>
                    <table>
                        <tr>
                            <td>Start from:</td>
                            <td>{{ date('M d Y', strtotime($ticketSales->ticket->event->start_date)) }} At 
                            {{ date('H:s:i a', strtotime($ticketSales->ticket->event->start_time)) }}</td>
                        </tr>
                        <tr>
                            <td>End at:</td>
                            <td>
                                {{ date('M d Y', strtotime($ticketSales->ticket->event->end_date)) }} At
                                {{ date('H:s:i a', strtotime($ticketSales->ticket->event->end_time)) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Location:</td>
                            <td>
                                {{ $ticketSales->ticket->event->location }}
                            </td>
                        </tr>
                        <tr>
                            <td>Guest:</td>
                            <td>
                                {{ $ticketSales->guests->lastName }}
                            </td>
                        </tr>
                        <tr>
                            <td>Ticket number:</td>
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

        .container .item {
            /* padding: 100px; */
            background: #fff;
            display: flex;
            gap: 10px;
            padding: 30px;
            border: 1px solid #988;
            height: 200px;
            margin-bottom: 50px;
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
            border-right: 1px solid #988;
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

        table, th, td {
            border: 1px solid #ddd;
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
