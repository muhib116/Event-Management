<template>
    <div class="checkout-right">
        <h2>Event Details</h2>
        <div class="event-upper">
            <img :src="`../../../../${get_banner(event?.images)}`" alt="" class="max-h-[200px] h-full object-cover object-center">
            <div class="event-cnt">
                <h4>{{ event.name }}</h4>
                <p><i class="fas fa-map-marker-alt"></i> {{ event.location }}</p>
                <p><i class="fas fa-calendar-alt"></i> {{ moment(event.start_date).format('d-MMM-YYYY') }} · {{ event.start_time }} to {{ moment(event.end_date).format('d-MMM-YYYY') }} · {{ event.end_time }}</p>
            </div>
        </div>

        <div class="summary-item">
            <h6>Order Summary</h6>
            <p v-for="(card, index) in cards" :key="`type-${index}`">
                <span>{{ card.name }} ({{ card.type }})</span>
                <span>{{ card.quantity }}pcs x {{ card.price }} {{  $page.props?.currency.value }}</span>
            </p>
        </div>
        <div v-if="getTotalCommission(cards)>0" class="summary-item">
            <!-- <p v-for="(card, index) in cards" :key="`type-${index}`">
                Ticket Price 
                <span>{{ card.quantity }} x Rp. {{ card.price }}</span>
            </p> -->
            <!-- <p>Service & Handling <span> - </span></p> -->
            <p>Service & Handling <span> {{ getTotalCommission(cards).toFixed(2) }} </span></p>
        </div>
        <div class="summary-item">
            <p><span>Total</span> <span>{{ getTotalWithFees(cards) }} {{  $page.props?.currency.value }}</span></p>
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
        // console.log(props.commission);
        // commission.value = props.settings.commission.value
        // commission.value = page.props.value?.settings.commission?.value
    })

</script>

<style lang="scss" scoped>

</style>