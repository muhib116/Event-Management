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
                        <a href="#" class="inline-flex gap-1">
                            <img src="@/assets/frontend/images/updown.svg" alt="">
                            Sort By
                        </a>
                    </div>

                    <div class="ticket-boxprt">

                        <Box v-for="(ticket, index) in event.event_tickets" :key="index" :ticket="ticket"  />

                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="bg-red h-[65px] fixed bottom-0 text-white bg-[#7F7DF3] w-full flex items-center justify-center border-t shadow">
            Choose your ticket and quantity.
        </div> -->
        <div class="fixed bottom-0 w-full text-white bg-[#7F7DF3] border-t shadow ">
            <div class="container h-[70px] flex items-center justify-between">
                <div>
                    <table>
                        <tr>
                            <td class="py-[4px] px-2">Qty</td>
                            <td class="py-[4px] px-2 font-bold">Price Total (IDR)</td>
                        </tr>
                        <tr>
                            <td class="py-[4px] px-2">2</td>
                            <td class="py-[4px] px-2 font-bold">Rp. 742.000</td>
                        </tr>
                    </table>
                </div>
                <button class="bg-white text-[#4F4CEE] px-4 py-2 rounded shadow-lg">Buy Tickets</button>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import Box from '@/Components/Frontend/TicketInfo/Box.vue'
    import useEvent from '@/Pages/useEvent.js'

    const { get_banner } = useEvent()

    const props = defineProps({
        event: Object
    })
</script>

<style lang="scss" scoped>

</style>