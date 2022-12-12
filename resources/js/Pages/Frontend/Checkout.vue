<template>
    <Head title="Checkout" />
    <Master>
        <div class="checkout-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="checkout-left">
                            <div class="check-leftbtn">
                                <Link  onclick="history.back();return false;">
                                    <img src="@/assets/frontend/images/left.svg" alt="">
                                </Link>
                            </div>
                            <div class="check-leftmain">
                                <h2>Buyer Contact Information</h2>
                                <div class="eticket-box">
                                    <p>E-tickets will be sent to your email address, please make sure your email address is correct.</p>
                                </div>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="inform-cnt">
                                                <label for="in1">First Name</label>
                                                <input type="text" id="in1" placeholder="Rachel">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="inform-cnt">
                                                <label for="in2">Last Name</label>
                                                <input type="text" id="in2" placeholder="Green">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="inform-cnt">
                                                <label for="in3">Email Address</label>
                                                <input type="email" id="in3" placeholder="rachelgreen@gmail.com" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="inform-cnt">
                                                <label for="in4">Confirm Email Address</label>
                                                <input type="email" id="in4" placeholder="rachelgreen@gmail.com" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="inform-cnt">
                                                <label for="in5">Phone Number</label>
                                                <input type="tel" id="in5" placeholder="Phone Number" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="inform-btn">
                                                <Link class="bg-blue-600 text-white px-4 py-2 rounded" :href="route('payment-method')" type="button">Continue to Payment</Link>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="checkout-right">
                            <h2>Event Details</h2>
                            <div class="event-upper">
                                <img src="@/assets/frontend/images/event.png" alt="">
                                <div class="event-cnt">
                                    <h4>Drive In Senja: Back to the Future</h4>
                                    <p><i class="fas fa-map-marker-alt"></i> Parkiran Utama Mall @ Alam Sutera</p>
                                    <p><i class="fas fa-calendar-alt"></i> September 22, 2021 · 20.00 - 21.56 WIB</p>
                                </div>
                            </div>

                            <div class="summary-item">
                                <h6>Order Summary</h6>
                                <p>Ticket Type <span>2 x Paket VIP</span></p>
                            </div>
                            <div class="summary-item">
                                <p>Ticket Price <span>2 x Rp. 371.000</span></p>
                                <p>Service & Handling <span> - </span></p>
                                <p>Admin Fee <span> - </span></p>
                            </div>
                            <div class="summary-item">
                                <p><span>Total</span> <span>Rp. 742.000</span></p>
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