<script setup></script>
<template>
    <div class="ticket_wrap">
        <div class="ticket">
            <div class="ticket-header">
                <div class="ticket-departure">
                    <h1 class="city-abbr">YOG</h1><span class="city-name">Yogyakarta</span>
                </div>
                <svg class="separator" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve">
                    <g id="flights"></g>
                    <path d="M510,255c0-20.4-17.85-38.25-38.25-38.25H331.5L204,12.75h-51l63.75,204H76.5l-38.25-51H0L25.5,255L0,344.25h38.25    l38.25-51h140.25l-63.75,204h51l127.5-204h140.25C492.15,293.25,510,275.4,510,255z" fill="currentColor"></path>
                </svg>
                <div class="ticket-destination">
                    <h1 class="city-abbr">JAK</h1><span class="city-name">Jakarta</span>
                </div>
            </div>
            <div class="ticket-body">
                <div class="row">
                    <div class="col item">
                        <h2 class="name">Flight</h2><span class="value">815</span>
                    </div>
                    <div class="col item">
                        <h2 class="name">Gate</h2><span class="value">22A</span>
                    </div>
                    <div class="col item">
                        <h2 class="name">Seat</h2><span class="value">10C</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col half">
                        <div class="row-vertical">
                            <div class="col">
                                <div class="item">
                                    <h2 class="name">Passenger</h2><span class="value">Kaneki Ken</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="item">
                                    <h2 class="name">Class</h2><span class="value">Premium</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="item">
                                    <h2 class="name">Departure</h2><span class="value">3:45am, Dec 15</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col half"><img class="ticket-qrcode" src="https://1.bp.blogspot.com/-tWxtTHsnBvQ/Wx0E35ydjVI/AAAAAAAAA6w/SxUTG14Kx8ABJkT4_7S18j4W-Sj5a50YACLcBGAs/s1600/qr.png" alt="Ticket Code"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.ticket_wrap {
    background: #eee;
    min-height: 100vh;
    padding: 50px 0;
}
img {
    height: auto;
    width: 100%;
}

.ticket {
    background: #ffffff;
    border-radius: 4px;
    color: #0b1521;
    font-family: "Roboto", sans-serif;
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
    padding: 30px;
    margin: 0 auto;
    max-width: 400px;
}

.ticket-header {
    display: flex;
    justify-content: space-between;
    margin: 20px 0 50px 0;
    position: relative;
}

.ticket-header>svg.separator {
    -webkit-animation: flight 2s infinite;
    animation: flight 2s infinite;
    display: block;
    color: #d3e6f4;
    height: 30px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30px;
}

.ticket-departure {
    text-align: left;
}

.ticket-destination {
    text-align: right;
}

.ticket .city-abbr {
    color: #3b8acf;
    font-size: 45px;
    font-weight: 900;
    letter-spacing: -2px;
    line-height: 50px;
    margin: 0;
    text-transform: uppercase;
}

.ticket .city-name {
    color: #aaaaac;
    font-size: 16px;
    text-transform: uppercase;
}

.ticket .item:not(:last-child) {
    margin-bottom: 20px;
}

.ticket .name {
    color: #aaaaac;
    font-size: 12px;
    font-weight: normal;
    line-height: 20px;
    margin: 0;
    text-transform: uppercase;
}

.ticket .value {
    color: #000000;
    font-size: 16px;
    line-height: 20px;
}

.row {
    display: flex;
    flex-direction: row;
}

.row-vertical {
    display: flex;
    height: 100%;
    flex-direction: column;
    justify-content: space-between;
}

.row-vertical>.col {
    flex: 0;
}

.row>.col {
    flex: 1;
}

.row>.col.half {
    flex-basis: 50%;
}
</style>