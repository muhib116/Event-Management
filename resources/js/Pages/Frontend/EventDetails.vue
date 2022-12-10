<template>
    <Head title="Event Details" />
    <Master>
        <main class="event-wrapper">
            <div class="container">
                <div class="event-main">
                    <div class="event-left">
                        <h4>Share</h4>
                        <ul>
                            <li><a href="#"><img src="@/assets/frontend/images/links.svg" alt=""><span>Share to Links </span></a></li>
                            <li><a href="#"><img src="@/assets/frontend/images/instagram.svg" alt=""><span>Share to Instagram </span></a></li>
                            <li><a href="#"><img src="@/assets/frontend/images/twitter.svg" alt=""><span>Share to Twitter</span></a></li>
                            <li><a href="#"><img src="@/assets/frontend/images/facebook.svg" alt=""><span>Share to Facebook </span></a></li>
                        </ul>
                    </div>
                    <div class="event-right">
                        <div class="event-banner">
                            <img src="@/assets/frontend/images/event-banner.png" alt="">
                        </div>

                        <div class="event-cntprt">
                            <div class="event-cntleft">
                                <h2>Drive In Senja: Back to The Future</h2>
                                <ul>
                                    <li><i class="fas fa-map-marker-alt"></i> Parkiran Utama Mall @ Alam Sutera</li>
                                    <li><i class="fas fa-calendar-alt"></i> September 22, 2021 · 20.00 - 21.56 WIB</li>
                                </ul>
                                <p>Marty travels back in time using an eccentric scientist's time machine. However, he must make his high-school-aged parents fall in love in order to return to the present.</p>
                            </div>
                            <div class="event-cntright">
                                <p>Tickets starting at</p>
                                <h4>Rp. 212.000</h4>
                                <a href="#">Buy Tickets</a>
                            </div>
                        </div>

                        <div class="event-informprt">
                            <h4>Event Information</h4>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="images/time.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Duration</h4>
                                            <p>20.00 - 21.56 WIB</p>
                                            <p>1 hour 56 minutes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="images/people.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Audience</h4>
                                            <p>This movie is suitable for <br> audience aged 12  and above</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="images/warning.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Attention</h4>
                                            <p>Face mask and social distancing <br> are mandatory outside the car.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="event-descprt">
                            <h2>Description</h2>
                            <p>Drive-In Senja memberikan retro drive-in experience yang dikemas secara modern. Penggunaan transmisi radio kit, mengintegrasikan suara film ke dalam radio mobil, ditambah proyektor resolusi tinggi yang menyediakan pengalaman visual terbaik. Acara ini merupakan sarana yang aman untuk menghabiskan waktu bersama keluarga, pasangan, maupun komunitas</p>
                        </div>

                        <div class="event-termcond">
                            <form action="#">
                                <select name="" id="">
                                    <option value="">Terms & Condition</option>
                                    <option value="">Terms & Condition</option>
                                    <option value="">Terms & Condition</option>
                                </select>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </main>
    </Master>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
</script>

<style lang="scss" scoped>

</style>