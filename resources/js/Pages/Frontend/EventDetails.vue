<template>
    <Head title="Event Details" />
    <Master>
        <main class="event-wrapper">
            <div class="container">
                <div class="event-main">
                    <div class="event-left">
                        <SocialShare />
                    </div>
                    <div class="event-right">
                        <div class="event-banner">
                            <img src="@/assets/frontend/images/event-banner.png" alt="">
                        </div>

                        <div class="event-cntprt">
                            <div class="event-cntleft">
                                <h2>{{ event.name }}</h2>
                                <ul>
                                    <li><i class="fas fa-map-marker-alt"></i> {{ event.location }}</li>
                                    <li><i class="fas fa-calendar-alt"></i> {{ event.start_date }}· {{ event.start_time }}</li>
                                </ul>
                                <p>Marty travels back in time using an eccentric scientist's time machine. However, he must make his high-school-aged parents fall in love in order to return to the present.</p>
                            </div>
                            <div class="event-cntright">
                                <p>Tickets starting at</p>
                                <h4>Rp. 212.000</h4>
                                <Link :href="route('checkout', event.slug)">Buy Tickets</Link>
                            </div>
                        </div>

                        <div class="event-informprt">
                            <h4>Event Information</h4>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="images/time.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Duration</h4>
                                            <p>20.00 - 21.56 WIB</p>
                                            <p>1 hour 56 minutes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="images/people.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Audience</h4>
                                            <p>This movie is suitable for <br> audience aged 12  and above</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="images/warning.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Attention</h4>
                                            <p>Face mask and social distancing <br> are mandatory outside the car.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="event-descprt">
                            <h2>Description</h2>
                            <p>
                                {{ event.description }}
                            </p>
                        </div>

                        <div class="event-termcond">
                            <form action="#">
                                <select name="" id="">
                                    <option value="">Terms & Condition</option>
                                    <option value="">Terms & Condition</option>
                                    <option value="">Terms & Condition</option>
                                </select>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </main>
    </Master>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import SocialShare from '@/Components/Frontend/Event/SocialShare.vue'
    import Master from './Master.vue'
import { Inertia } from '@inertiajs/inertia';
    const props = defineProps({
        event: Object
    })

    console.log(props.event)
</script>

<style lang="scss" scoped>

</style>