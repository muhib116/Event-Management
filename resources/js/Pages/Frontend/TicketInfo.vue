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
                                <div class="event-upper ticket-opt">
                                    <img :src="event.image" alt="">
                                    <div class="event-cnt">
                                        <h4>{{ event.name }}</h4>
                                        <p><i class="fas fa-calendar-alt"></i> {{ event.start_date }}· {{ event.start_time }} </p>
                                        <p><i class="fas fa-map-marker-alt"></i> {{ event.location }} </p>
                                        <p>{{ event.description }}</p>
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

                        <Box v-for="(ticket, index) in event.tickets" :key="index" :ticket="ticket"  />

                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import Box from '@/Components/Frontend/TicketInfo/Box.vue'

    const props = defineProps({
        event: Object
    })
</script>

<style lang="scss" scoped>

</style>