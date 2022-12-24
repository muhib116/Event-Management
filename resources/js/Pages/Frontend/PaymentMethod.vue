<template>
    <Head title="Payment Method" />
    <Master>
        <LoginCheck>
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
                            <Cart :event="event" />
                            <div class="pay-btn">
                                <!-- <Link class="active" :href="route('payment-complete')">Pay Now</Link> -->
                                <Button class="active flex items-center gap-2 justify-center" @click="()=> {
                                    handlePayment(cards);
                                    clickLoading = true;
                                }" :disabled="clickLoading"
                                :class="{
                                    'opacity-50': clickLoading
                                }"
                                >
                                    <svg v-if="clickLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Pay Now
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </LoginCheck>
    </Master>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import { onMounted, ref, watchEffect } from 'vue'
    import { useToast } from "vue-toastification";
    import Master from './Master.vue'
    import Cart from '@/Components/Frontend/checkout/Cart.vue'
    import useTicket from '@/Pages/Frontend/useTicket'
    import axios from 'axios'
    import LoginCheck from './LoginCheck.vue'
    import useAuth from '@/useAuth.js'
    
    const clickLoading = ref(false);
    const guestId = ref(null)
    const { 
        userInfo,
        isLoading
    } = useAuth()
    const toast = useToast();
    const { cards, commission } = useTicket()
    
    const props = defineProps({
        event: Object
    })

    const preparePayload = (cards) => {
        let index = 0
        let payload = []
        for(let key in cards) {
            let { type, quantity, price, id } = cards[key]
            payload[index] = {
                organizer_id: props.event.user_id,
                guest_id: guestId.value,
                ticket_id: id,
                ticket_type: type,
                quantity: quantity,
                commission: commission, //this commission setting as percentage
                price: price,
                payment_method: 'Hand Cash',
                status: 'complete',
            }
            index ++
        }

        return payload
    }

    const handlePayment = async (cards) => {
        let payload = preparePayload(cards)
        if(!payload.length) {
            toast.error("Please add ticket!", {
                timeout: 2000,
                position: "top-center",
            })
            return
        }
        let res = await axios.post('ticket/sale', payload)
        if(res.status == 200){
            // clean cards from localStorage
            localStorage.clear('cards')
            window.location.href = route('payment.complete')
        }
    }

    onMounted(() => {
        if(localStorage.getItem('cards')){
            let cardsFromLocalStorage = JSON.parse(localStorage.getItem('cards'))
            cards.value = cardsFromLocalStorage
        }
    })

    let timeoutId = null
    watchEffect(() => {
        if(!isLoading.value && !guestId.value){
            clearTimeout(timeoutId)

            timeoutId = setTimeout(async () => {
                let guest = await axios.get(`guest/${userInfo.value.email}`)
                guestId.value = guest.data.id
                console.log(guestId.value)
            }, 100)
        }
    })
</script>

<style scoped>
    .pay-btn button:hover, .pay-btn .active {
        background: #4F4CEE;
    }
    .pay-btn button {
        width: 184px;
        display: block;
        text-align: center;
        margin: 26px auto 0;
        font-weight: 400;
        font-size: 16px;
        color: #FFFFFF;
        background: #DADAFB;
        padding: 10px 16px;
        border-radius: 4px;
        transition: 0.2s all ease;
    }
</style>