<template>
    <Head title="Ticket Info" />
    <Master>
        <div class="checkout-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout-left border-0">
                            <div class="check-leftbtn">
                                <Link  onclick="history.back();return false;">
                                    <img src="@/assets/frontend/images/left.svg" alt="">
                                </Link>
                            </div>
                            <div class="check-leftmain">
                                <h2>Ticket Options</h2>
                                <div class="event-upper ticket-opt items-start">
                                    <img :src="`../../../../${get_banner(event?.images)}`" alt="">
                                    <div class="event-cnt">
                                        <h4>{{ event.name }}</h4>
                                        <p><i class="fas fa-calendar-alt"></i> {{ event.start_date }}· {{ event.start_time }} </p>
                                        <p><i class="fas fa-map-marker-alt"></i> {{ event.location }} </p>
                                        <p>{{ event.description.slice(0, 300) }}...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ticket-mainprt">
                    <div class="short-btn">
                        <button @click="event.event_tickets.reverse()" class="inline-flex gap-1">
                            <img src="@/assets/frontend/images/updown.svg" alt="">
                            Sort By
                        </button>
                    </div>

                    <div class="ticket-boxprt">
                        <template v-for="(ticket, index) in event.event_tickets" :key="index">
                            <Box :ticket="ticket" v-if="!ticket.settings.isHidden"  />
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="Object.keys(cards).length" class="fixed bottom-0 w-full text-white bg-[#7F7DF3] border-t shadow ">
            <div class="container h-[70px] flex items-center justify-between">
                <div>
                    <table>
                        <tr>
                            <td class="py-[4px] px-2">Qty</td>
                            <td class="py-[4px] px-2 font-bold">Price Total (IDR)</td>
                        </tr>
                        <tr>
                            <td class="py-[4px] px-2">{{ totalQuantity }}</td>
                            <td class="py-[4px] px-2 font-bold">Rp. {{ totalPrice.toFixed(2) }}</td>
                        </tr>
                    </table>
                </div>
                <Link :href="route('checkout', event.slug)" class="bg-white text-[#4F4CEE] px-4 py-2 rounded shadow-lg">Buy Tickets</Link>
            </div>
        </div>
        <div v-else class="bg-red h-[65px] fixed bottom-0 text-white bg-[#7F7DF3] w-full flex items-center justify-center border-t shadow">
            Choose your ticket and quantity.
        </div>
    </Master>
</template>

<script setup>
    import { watch, onMounted } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import Box from '@/Components/Frontend/TicketInfo/Box.vue'
    import useEvent from '@/Pages/useEvent.js'
    import useTicket from '@/Pages/Frontend/useTicket'

    const { get_banner } = useEvent()
    const { cards, getTotalWithFees, totalQuantity, totalPrice } = useTicket()
    const props = defineProps({
        event: Object
    })
    watch(cards, ()=>{
        getTotalWithFees(cards.value)
        localStorage.setItem('cards', JSON.stringify(cards.value))
    }, { deep: true })

    onMounted(() => {
        if(localStorage.cards){
            cards.value = JSON.parse(localStorage.getItem('cards'))
        }
    })
</script>

<style scoped>
    .short-btn button {
        font-weight: 400;
        font-size: 14px;
        color: #4F4CEE;
        background: #FFFFFF;
        border: 1px solid #4F4CEE;
        display: inline-block;
        padding: 6px 16px;
        border-radius: 4px;
    }
</style>