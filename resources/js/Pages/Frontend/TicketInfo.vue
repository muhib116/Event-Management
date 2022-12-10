<template>
    <Head title="Ticket Info" />
    <Master>
        <div class="checkout-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout-left border-0">
                            <div class="check-leftbtn">
                                <a href="#">
                                    <img src="@/assets/frontend/images/left.svg" alt="">
                                </a>
                            </div>
                            <div class="check-leftmain">
                                <h2>Ticket Options</h2>
                                <div class="event-upper ticket-opt">
                                    <img src="@/assets/frontend/images/event.png" alt="">
                                    <div class="event-cnt">
                                        <h4>Drive In Senja: Back to the Future</h4>
                                        <p><i class="fas fa-calendar-alt"></i> September 22, 2021   ·   20.00 - 21.56 WIB</p>
                                        <p><i class="fas fa-map-marker-alt"></i> Parkiran Utama Mall @ Alam Sutera</p>
                                        <p>Marty travels back in time using an eccentric scientist's time machine. However, he must make his high-school-aged parents fall in love in order to return to the present.</p>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ticket-mainprt">
                    <div class="short-btn">
                        <a href="#" class="inline-flex gap-1">
                            <img src="@/assets/frontend/images/updown.svg" alt="">
                            Sort By
                        </a>
                    </div>

                    <div class="ticket-boxprt">
                        <div class="ticket-item active-box">
                            <h2>Paket VIP</h2>
                            <p>1 Tiket Mobil (maks. 2 orang) 2 Burger Senja & Fries, 2 Teh Senja, 1 Voucher Merchandise Spot dan pelayanan VIP Sesi foto</p>
                            <div class="ticket-btmcnt">
                                <h4>Rp. 371.000</h4>
                                <form action="#" method="POST">
                                    <div class="quantity">
                                        <span class="input-number-decrement"><img src="@/assets/frontend/images/minus.svg" alt=""></span>
                                        <input class="input-number active" type="text" value="2">
                                        <span class="input-number-increment"><img src="@/assets/frontend/images/plus.svg" alt=""></span>                     
                                    </div>
                                </form>  
                            </div>
                        </div>

                        <div class="ticket-item">
                            <h2>Paket VVIP</h2>
                            <p>1 Tiket Mobil (maks. 2 orang) 2 Burger Senja & Fries, 2 Teh Senja, 1 Voucher Merchandise dekorasi kabin spot & pelayanan VVIP Sesi foto</p>
                            <div class="ticket-btmcnt">
                                <h4>Rp. 424.000</h4>
                                <form action="#" method="POST">
                                    <div class="quantity">
                                        <span class="input-number-decrement"><img src="@/assets/frontend/images/minus.svg" alt=""></span>
                                        <input class="input-number2" type="text" value="0">
                                        <span class="input-number-increment"><img src="@/assets/frontend/images/plus.svg" alt=""></span>                     
                                    </div>
                                </form>  
                            </div>
                        </div>

                        <div class="ticket-item">
                            <h2>Paket Ngedate</h2>
                            <p>1 Tiket Mobil (maks. 2 orang)2 Popcorn Drive-In Senja</p>
                            <div class="ticket-btmcnt">
                                <h4>Rp. 212.000</h4>
                                <form action="#" method="POST">
                                    <div class="quantity">
                                        <span class="input-number-decrement"><img src="@/assets/frontend/images/minus.svg" alt=""></span>
                                        <input class="input-number3" type="text" value="0">
                                        <span class="input-number-increment"><img src="@/assets/frontend/images/plus.svg" alt=""></span>                     
                                    </div>
                                </form>  
                            </div>
                        </div>

                        <div class="ticket-item">
                            <h2>Paket Ngedate Premium</h2>
                            <p>1 Tiket Mobil (maks. 2 orang)2 Hotdog Drive-In Senja</p>
                            <div class="ticket-btmcnt">
                                <h4>Rp. 265.000</h4>
                                <form action="#" method="POST">
                                    <div class="quantity">
                                        <span class="input-number-decrement"><img src="@/assets/frontend/images/minus.svg" alt=""></span>
                                        <input class="input-number4" type="text" value="0">
                                        <span class="input-number-increment"><img src="@/assets/frontend/images/plus.svg" alt=""></span>                     
                                    </div>
                                </form>  
                            </div>
                        </div>

                        <div class="ticket-item">
                            <h2>Paket Rame</h2>
                            <p>1 Tiket Mobil (maks. 3-4 orang)4 Popcorn Drive-In Senja</p>
                            <div class="ticket-btmcnt">
                                <h4>Rp. 371.000</h4>
                                <form action="#" method="POST">
                                    <div class="quantity">
                                        <span class="input-number-decrement"><img src="@/assets/frontend/images/minus.svg" alt=""></span>
                                        <input class="input-number5" type="text" value="0">
                                        <span class="input-number-increment"><img src="@/assets/frontend/images/plus.svg" alt=""></span>                     
                                    </div>
                                </form>  
                            </div>
                        </div>

                        <div class="ticket-item">
                            <h2>Paket Rame Premium</h2>
                            <p>1 Tiket Mobil (maks. 3-4 orang)4 Hotdog Drive-In Senja</p>
                            <div class="ticket-btmcnt">
                                <h4>Rp. 487.000</h4>
                                <form action="#" method="POST">
                                    <div class="quantity">
                                        <span class="input-number-decrement"><img src="@/assets/frontend/images/minus.svg" alt=""></span>
                                        <input class="input-number6" type="text" value="0">
                                        <span class="input-number-increment"><img src="@/assets/frontend/images/plus.svg" alt=""></span>                     
                                    </div>
                                </form>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
</script>

<style lang="scss" scoped>

</style>