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
                                    <div>
                                        <div class="payment-item">
                                            <h4>Select method</h4>
                                            <ul>
                                                <li>
                                                    <input v-model="active_pay" type="radio" id="r1" name="radio-group" value="paypal">
                                                    <label for="r1">Paypal</label>
                                                </li>
                                                <li>
                                                    <input v-model="active_pay" type="radio" id="r2" name="radio-group" value="stripe">
                                                    <label for="r2">Stripe</label>
                                                </li>
                                            </ul>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <Cart :event="event" />
                            <div class="pay-btn">
                                <!-- <Link class="active" :href="route('payment-complete')">Pay Now</Link> -->
                                <!-- <Button class="active flex items-center gap-2 justify-center" @click="()=> {
                                    clickLoading = true;
                                    handlePayment(cards);
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
                                </Button> -->
                                <div v-show="active_pay=='paypal'" id="braintree-paypal-cta" ref="paypalBtnContainer"></div>

                                <div v-show="active_pay=='stripe'" >
                                    <div id="stripe"></div>
                                    <div class="text-red-400" v-if="stripe_error">{{ stripe_error }}</div>
                                    <Button class="active flex items-center gap-2 justify-center" ref="btn_stripe" :disabled="clickLoading">
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
            </div> 

        </LoginCheck>
    </Master>
</template>

<script setup> 
    import { loadScript } from "@paypal/paypal-js";
    import { loadStripe } from '@stripe/stripe-js/pure';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
    import { onMounted,onActivated, ref, watchEffect } from 'vue'
    import { useToast } from "vue-toastification";
    import Master from './Master.vue'
    import Cart from '@/Components/Frontend/checkout/Cart.vue'
    import useTicket from '@/Pages/Frontend/useTicket'
    import axios from 'axios'
    import LoginCheck from './LoginCheck.vue'
    import useAuth from '@/useAuth.js'
    import { result } from "lodash-es";
    const { getTotalWithFees } = useTicket();
    
    const clickLoading = ref(false);
    const guestId = ref(null)
    const active_pay = ref(false);
    const stripeElement = ref({});
    const btn_stripe = ref();
    const stripe_error = ref(false);
    const stripeForm = useForm({
        stripe_token: null,
        cards: null,
        total_amount_with_fees: null,
    });

    
    const { 
        userInfo,
        isLoading
    } = useAuth()
        
    const props = defineProps({
        event: Object,
        settings: Object
    })
// console.log(props);
    const toast = useToast();
    const { cards, commission } = useTicket()
    const payLoadForPaypal = ref({});

    
    const paypalBtnContainer = ref(null);

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
                commission: commission.value, //this commission setting as percentage
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
        let res = await axios.post('ticket/sale', payload);
        if(res.status == 200){
            // clean cards from localStorage
            localStorage.clear('cards')
            window.location.href = route('payment.complete')
            clickLoading.value = false;
        } else {
            clickLoading.value = false;
        }
    } 
    onMounted(async () => {
        if(localStorage.getItem('cards')){
            let cardsFromLocalStorage = JSON.parse(localStorage.getItem('cards')) 
        }
        commission.value = props.settings.commission.value
    })

    let timeoutId = null
    let mountedPaypal = ref(false);
    watchEffect(() => {
        if(!isLoading.value && !guestId.value){
            clearTimeout(timeoutId)

            timeoutId = setTimeout(async () => {
                let guest = await axios.get(`guest/${userInfo.value.email}`)
                guestId.value = guest.data.id;
                payLoadForPaypal.value = preparePayload(cards.value);
            }, 100)
        }
        if (!isLoading.value && !mountedPaypal.value) {
            mountedPaypal.value = true;
            loadScript({ "client-id": "AQeJeHLGLcEAq6RII_55oIyly5_zD5LaNxldDPauKB-qxcfwo33NbxErw0QxuqSrmvwjO79AVSKAskrY" })
                .then((paypal) => {
                    paypal
                        .Buttons({
                            createOrder: async function(data, actions) {
                                return actions.order.create({ 
                                    purchase_units: [{ 
                                        amount: {
                                            currency_code: "USD",
                                            value: getTotalWithFees(cards.value).value
                                        }, 
                                    }]
                                });
                            },
                            onApprove: async function(data, actions) {
                                console.log('approved', data, actions);
                                let payload = preparePayload(cards.value)
                                let res = await axios.post('ticket/sale', payload);
                                console.log('result', res.data);
                                if (res.data.target_url) {
                                    // This function captures the funds from the transaction.
                                    return actions.order.capture().then(function(details) {
                                        // This function shows a transaction success message to your buyer.
                                        // alert('Transaction completed by ' + details.payer.name.given_name);
                                        localStorage.clear('cards')
                                        window.location.href = res.data.target_url; 
                                    });
                                }
                            }
                        })
                        .render("#braintree-paypal-cta")
                        .catch((error) => {
                            console.error("failed to render the PayPal Buttons", error);
                        });
                })
                .catch((err) => {
                    console.error("failed to load the PayPal JS SDK script", err);
                });

                
            // stripe 
            loadStripe('pk_test_51M1lgfDKrpdPsiSpc2iGtO8XgCgWkjhGvXo5JRT6jpH6NLsyPDVXTSczbUFEihz94XQBZnWvQ2hqE46mJraU238E00l1d2VpQG')
                .then(stripe => {
                    let element = stripe.elements();
                    let stripeElement = element.create('card', {
                        hidePostalCode: true,
                        base: {
                            color: '#32325d',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        classes: {
                            base: 'bg-gray-100 rounded border py-3 px-4',
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    });
                    stripeElement.mount('#stripe');
                    
                    btn_stripe.value.addEventListener('click', function() {
                        clickLoading.value = true;
                        stripe.createToken(stripeElement).then(function(result) {
                            console.log(result);
                            if (result.error) {
                                console.log('error', result.error);
                                stripe_error.value = result.error.message;
                                clickLoading.value = false;
                            } else {
                                let payload = preparePayload(cards.value);
                                stripeForm.stripe_token = result.token.id
                                stripeForm.cards = payload;
                                stripeForm.total_amount_with_fees = getTotalWithFees(cards.value).value;
                                axios.post(route('stripe.pay'), stripeForm)
                                    .then(response => response.data)
                                    .then(result => {
                                        clickLoading.value = false;
                                        if (result.target_url) {
                                            localStorage.clear('cards')
                                            window.location.href = route('payment.complete')
                                        }
                                    }).catch(() => {
                                        clickLoading.value = false;
                                    });
                                // axios.post(route('stripe.pay'), {
                                //     onSuccess(p) {
                                //         console.log(p.props.flash);
                                //         if (p.props.flash?.success) {
                                //             // localStorage.clear('cards')
                                //             // window.location.href = route('payment.complete')
                                //         }
                                //     },
                                //     onError(p) {}
                                // });
                            }
                        });
                    });
                    // stripe.createToken();
                })
            
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