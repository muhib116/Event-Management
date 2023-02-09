<template>
    <div class="checkout-right">
        <h2>Event Details</h2>
        <div class="event-upper">
            <img :src="`../../../../${get_banner(event?.images)}`" alt="" class="max-h-[200px] h-full object-cover object-center">
            <div class="event-cnt">
                <h4>{{ event.name }}</h4>
                <p><i class="fas fa-map-marker-alt"></i> {{ event.location }}</p>
                <p><i class="fas fa-calendar-alt"></i> {{ moment(event.start_date).format('ddd., DD MMM. YYYY') }} · {{ moment(event.start_time, 'H:m a').format('H:m') }} to {{ moment(event.end_date).format('ddd., DD MMM. YYYY') }} · {{ moment(event.end_time, 'H:m a').format('H:m') }}</p>
            </div>
        </div>

        <div class="summary-item">
            <h6>Order Summary</h6>
            <p v-for="(card, index) in cards" :key="`type-${index}`">
                <span>{{ card.name }} ({{ card.type }})</span>
                <span>{{ card.quantity }}pcs x {{ card.price }} <span style="font-family: initial !important;">{{  $page.props?.currency.value }}</span></span>
            </p>
        </div>
        <div v-if="getTotalCommission(cards)>0" class="summary-item">
            <p>Service & Handling <span> {{ getTotalCommission(cards).toFixed(2) }} <span style="font-family: initial !important;">{{  $page.props?.currency.value }}</span></span></p>
        </div>
        <div class="summary-item">
            <p><span>Total</span> <span>{{ getTotalWithFees(cards) }}<span style="font-family: initial !important;">{{  $page.props?.currency.value }}</span></span></p>
        </div>
    </div>
</template>

<script setup>
    import { onMounted } from 'vue'
    import useTicket from '@/Pages/Frontend/useTicket'
    import useEvent from '@/Pages/useEvent.js'
    import { usePage } from '@inertiajs/inertia-vue3'
    import moment from 'moment'
    
    const { cards, getTotal, getTotalCommission, getTotalWithFees } = useTicket();
    const { get_banner } = useEvent();
    const props = defineProps({
        event: Object,
        commission: Object
    })
    const page = usePage();

    onMounted(() => {
        if(localStorage.getItem('cards')){
            let cardsFromLocalStorage = JSON.parse(localStorage.getItem('cards'))
            cards.value = cardsFromLocalStorage
            getTotal(cards.value)
        }
    })

</script>

<style lang="scss" scoped>

</style>