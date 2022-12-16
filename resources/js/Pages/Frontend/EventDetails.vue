<template>
    <Head title="Event Details" />
    <Master>
        <main class="event-wrapper">
            <div class="container">
                <div class="event-main">
                    <div class="event-left">
                        <SocialShare />
                    </div>
                    <div v-if="event" class="event-right">
                        <div class="event-banner" v-if="event.images && get_banner(event.images)">
                            <img :src="`../../../../${get_banner(event?.images)}`" alt="">
                        </div>

                        <h1 class="mt-4 text-lg font-black">Gallery</h1>
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-3">
                            <template v-for="(img, index) in event.images" :key="index">
                                <img 
                                    v-if="img && img.type == 'gallery'"
                                    class="border aspect-square block object-cover object-center"
                                    :src="`../../../../${img.path}`" 
                                    alt=""
                                >
                            </template>
                        </div>

                        <div class="event-cntprt">
                            <div class="event-cntleft">
                                <h2>{{ event.name }}</h2>
                                <ul>
                                    <li><i class="fas fa-map-marker-alt"></i> {{ event.location }}</li>
                                    <li><i class="fas fa-calendar-alt"></i> {{ event.start_date }}· {{ event.start_time }} </li>
                                </ul>
                                <p>{{ event.description.slice(0, 150) }}<a href="#description">...</a></p>
                            </div>
                            <div class="event-cntright">
                                <p>Tickets starting at</p>
                                <h4>$ {{ event.event_tickets_min_price }}</h4>
                                <Link :href="route('ticket-info', event.slug)">Buy Tickets</Link>
                            </div>
                        </div>

                        <div class="event-informprt">
                            <h4>Event Information</h4>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="@/assets/frontend/images/time.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Duration</h4>
                                            <p>20.00 - 21.56 WIB</p>
                                            <p>1 hour 56 minutes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="@/assets/frontend/images/people.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Audience</h4>
                                            <p>{{ event.audience }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="@/assets/frontend/images/warning.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Attention</h4>
                                            <p>{{ event.attention }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="event-descprt" id="description">
                            <h2>Description</h2>
                            <p>
                                {{ event.description }}
                            </p>
                        </div>
                        
                        <iframe 
                            class="block max-w-[800px] w-full mx-auto mt-4 aspect-video"
                            v-if="getVideoCode(event.video_link)" 
                            :src="`https://www.youtube.com/embed/${getVideoCode(event.video_link)}`" 
                            title="YouTube video player" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                        ></iframe>

                        <div class="event-termcond">
                            <button @click="showTerms = !showTerms" class="text-lg font-black">Terms & Conditions</button>
                            <p v-if="showTerms">{{ event.terms_and_conditions }}</p>
                        </div>    
                        
                        <iframe 
                            v-if="event.map_link.indexOf('https://www.google.com/maps/embed')==0" 
                            class="block w-full mx-auto h-[300px] mb-4 aspect-auto mt-10" 
                            :src="event.map_link" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                        
                    </div>
                </div>
            </div>
        </main>
    </Master>
</template>

<script setup>
    import { ref } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import SocialShare from '@/Components/Frontend/Event/SocialShare.vue'
    import Master from './Master.vue'
    import useEvent from '@/Pages/useEvent.js'

    const { get_banner } = useEvent()
    const props = defineProps({
        event: Object
    })
    const showTerms = ref(false)
    const getVideoCode = (videoLink) => {
        if(!videoLink) return false
        let splitLink = videoLink.split('?v=')
        if(splitLink.length==2){
            let videoCode = splitLink[1].split('&')
            return videoCode[0]
        }
    }
</script>

<style lang="scss" scoped>

</style>