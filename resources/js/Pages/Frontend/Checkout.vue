<template>
    <Head title="Checkout" />
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
                                <div class="check-leftmain">
                                    <BuyerInfo :event="event"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <Cart :event="event"/>
                        </div>
                    </div>
                </div>
            </div>
        </LoginCheck>
    </Master>
</template>

<script setup>
    import { onMounted } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import Cart from '@/Components/Frontend/checkout/Cart.vue'
    import { useToast } from "vue-toastification";
    import useTicket from '@/Pages/Frontend/useTicket'
    import LoginCheck from './LoginCheck.vue'
    import BuyerInfo from '@/Components/Frontend/checkout/BuyerInfo.vue'


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