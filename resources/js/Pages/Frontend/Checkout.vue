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
                                                <Link v-if="!isEmpty(cards)" class="bg-blue-600 text-white px-4 py-2 rounded" :href="route('payment', event.slug)" type="button">Continue to Payment</Link>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <Cart :event="event"/>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import { onMounted } from 'vue'
    import { isEmpty } from 'lodash'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import Cart from '@/Components/Frontend/checkout/Cart.vue'
    import { useToast } from "vue-toastification";
    import useTicket from '@/Pages/Frontend/useTicket'

    const toast = useToast();
    const { cards } = useTicket()
    const props = defineProps({
        event: Object
    })    
    
    onMounted(() => {
        if(localStorage.getItem('cards')){
            let cardsFromLocalStorage = JSON.parse(localStorage.getItem('cards'))
            cards.value = cardsFromLocalStorage
        }
    })
</script>

<style lang="scss" scoped>

</style>