<template>
    <div class="ticket-item select-none"
        :class="[quantity&&'active-box', getUpperLimit(ticket)<=0&&'stockout filter grayscale pointer-events-none opacity-40'].join(' ')"
    >
        <h2>{{ ticket.ticket_name }}</h2>
        <p>{{ ticket.ticket_description }}</p>
        <div class="ticket-btmcnt">
            <h4>
                {{ ticket.ticket_type == 'Free' || !ticket.price || ticket.price == 0 ? 'Free' : `${ getTicketPrice(ticket)} ${$page.props?.currency.value}` }}
            </h4>
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


    const props = defineProps({
        ticket: Object,
    })

    const quantity = ref(0)
    const { cards, addCardData, commission, getTicketPrice } = useTicket()
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

<style lang="scss" scoped>

</style>