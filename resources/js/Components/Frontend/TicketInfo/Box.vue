<template>
    <div class="ticket-item select-none relative"
        :class="[quantity &&'active-box', (getUpperLimit(ticket)<=0 || get($page.props, 'event.end_expired'))&&'stockout filter pointer-events-none opacity-40'].join(' ')"
    >
        <h2>{{ ticket.ticket_name }}</h2>
        <p>{{ ticket.ticket_description }}</p>
        <div class="ticket-btmcnt">
            <h4>
                <span v-if="ticket.ticket_type == 'Free' || !ticket.price || ticket.price == 0">Free</span>
                <span v-else>
                    {{ getTicketPriceWithoutCommission(ticket) }} <span style="font-family: initial !important;">{{ $page.props?.currency.value }}</span>
                </span>
            </h4>
            <span class="flex justify-center" v-if="getUpperLimit(ticket)<=0 || get($page.props, 'event.end_expired')">
                <div class="ribbon-2 text-white">{{get($page.props, 'event.end_expired') ? 'Expired' : 'Sold Out' }}</div>
            </span>
            <div class="quantity">
                <span @click="quantity>0&&quantity--" class="input-number-decrement">
                    <img src="@/assets/frontend/images/minus.svg" alt="">
                </span>
                <input class="input-number active pointer-events-none" type="text" v-model="quantity" >
                <span @click="() => {
                    quantity<getUpperLimit(ticket) && quantity++; 
                }" class="input-number-increment">
                    <img src="@/assets/frontend/images/plus.svg" alt="">
                </span>                     
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, watch, onMounted } from 'vue'
    import useTicket from '@/Pages/Frontend/useTicket'
    import {get} from 'lodash'


    const props = defineProps({
        ticket: Object,
    })

    const quantity = ref(0)
    const { cards, addCardData, commission, getTicketPrice, getTicketPriceWithoutCommission } = useTicket()
    const getUpperLimit = (ticket) => {
        
        if(ticket.ticket_stock != 'limited') return ticket.purchase_limit
        
        let currentStock = (ticket.stock_limit - ticket.sold)
        if( currentStock < ticket.purchase_limit){
            return currentStock
        }

        return ticket.purchase_limit
    }

    watch(quantity, ()=>{
        addCardData(props.ticket, cards, quantity)
    }, { deep: true })

    onMounted(() => {
        let cardsFromLocalStorage = (localStorage.cards) ? JSON.parse(localStorage.cards) : {}
        let ticketFromLocalStorage = cardsFromLocalStorage[`ticket_${props.ticket.id}`]
        if(ticketFromLocalStorage){
            quantity.value = ticketFromLocalStorage.quantity
        }
    })
</script>

<style scoped>
.ribbon-2 {
  --f: 10px; /* control the folded part*/
  --r: 15px; /* control the ribbon shape */
  --t: -13px; /* the top offset */
  
  position: absolute;
  inset: var(--t) calc(-1*var(--f)) auto auto;
  padding: 0 10px var(--f) calc(10px + var(--r));
  clip-path: 
    polygon(0 0,100% 0,100% calc(100% - var(--f)),calc(100% - var(--f)) 100%,
      calc(100% - var(--f)) calc(100% - var(--f)),0 calc(100% - var(--f)),
      var(--r) calc(50% - var(--f)/2));
  background: #BD1550;
  box-shadow: 0 calc(-1*var(--f)) 0 inset #0005;
}
</style>