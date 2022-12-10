<template>
    <Head title="Payment Method" />
    <Master>
        <div class="checkout-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="checkout-left">
                            <div class="check-leftbtn">
                                <a href="#">
                                    <img src="@/assets/frontend/images/left.svg" alt="">
                                </a>
                            </div>
                            <div class="check-leftmain payright-prt">
                                <h2>Payment Method</h2>
                                <form action="#">
                                    <div class="payment-item">
                                        <h4>Credit Card</h4>
                                        <ul>
                                            <li>
                                                <input type="radio" id="r1" name="radio-group">
                                                <label for="r1">Credit/Debit Card</label>
                                            </li>
                                        </ul>   
                                    </div>
                                    <div class="payment-item">
                                        <h4>Virtual Account</h4>
                                        <ul>
                                            <li>
                                                <input type="radio" id="r2" name="radio-group">
                                                <label for="r2">BCA Virtual Account <img src="@/assets/frontend/images/r1.png" alt=""></label>
                                            </li>
                                             <li>
                                                <input type="radio" id="r3" name="radio-group">
                                                <label for="r3">BNI Virtual Account <img src="@/assets/frontend/images/r2.png" alt=""></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="r4" name="radio-group">
                                                <label for="r4">Mandiri Virtual Account <img src="@/assets/frontend/images/r3.png" alt=""></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="r5" name="radio-group">
                                                <label for="r5">Other Bank </label>
                                            </li>
                                        </ul>   
                                    </div>
                                    <div class="payment-item">
                                        <h4>Electronic Money</h4>
                                        <ul>
                                            <li>
                                                <input type="radio" id="r6" name="radio-group">
                                                <label for="r6">Gopay <img src="@/assets/frontend/images/r4.png" alt=""></label>
                                            </li>
                                             <li>
                                                <input type="radio" id="r7" name="radio-group" checked>
                                                <label for="r7">OVO <img src="@/assets/frontend/images/r5.png" alt=""></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="r8" name="radio-group">
                                                <label for="r8">LinkAja <img src="@/assets/frontend/images/r6.png" alt=""></label>
                                            </li>
                                            <li>
                                                <input type="radio" id="r9" name="radio-group">
                                                <label for="r9">Shopee pay <img src="@/assets/frontend/images/r7.png" alt=""></label>
                                            </li>
                                        </ul>   
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
                                <p>Admin Fee <span> Rp. 5.000 </span></p>
                            </div>
                            <div class="summary-item">
                                <p><span>Total</span> <span>Rp. 747.000</span></p>
                            </div>

                            <div class="pay-btn">
                                <a class="active" href="#">Pay Now</a>
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