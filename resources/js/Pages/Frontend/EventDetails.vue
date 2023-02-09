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
                        <div id="details-banner" class="event-banner overflow-hidden bg-[#487EB7]" v-if="event.images && get_banner(event.images)">
                            <img :src="`../../../../${get_banner(event?.images)}`" alt="" class="flex h-full object-cover object-center" style="">
                        </div>

                        <div class="event-cntprt">
                            <div class="event-cntleft">
                                <h2>{{ event.name }}</h2>
                                <ul>
                                    <li class="flex gap-2">
                                        <i class="mt-2 fas fa-map-marker-alt"></i> 
                                        <div class="flex-1">
                                            {{ get(event, 'location') }} 
                                            {{ get(event, 'settings.streetName') }}
                                            <span v-if="get(event, 'settings.houseNumber')">{{ get(event, 'settings.houseNumber') }},</span>
                                            {{ get(event, 'settings.postcode') }}
                                            {{ get(event, 'settings.city') }}
                                            <span v-if="get(event, 'settings.country')">{{ get(event, 'settings.country') }}</span>
                                        </div>
                                    </li>
                                    <li><i class="fas fa-calendar-alt"></i> {{ moment(event.start_date).format('ddd., D., MMM., YYYY') }} at {{ moment(event.start_time, 'H:m a').format('H:m') }} </li>
                                </ul>
                                <p>
                                    {{ removeTags(event.description).slice(0, 150) }}
                                </p>
                                <!-- <p>{{ event.description.slice(0, 150) }}<a href="#description">...</a></p> -->
                            </div>
                            <div class="event-cntright">
                                <p>Tickets starting at</p>
                                <h4>{{ event.min_price }} <span style="font-family: initial !important;">{{  $page.props?.currency.value }}</span></h4>
                                <div class="select-none text-red-500" v-if="event.end_expired">Expired</div>
                                <Link v-else :href="route('ticket-info', event.slug)">Buy Tickets</Link>
                            </div>
                        </div>

                        <Gallery :images="event.images" class="mt-16"/>

                        <div class="event-informprt">
                            <h4>Event Information</h4>
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="event-informitem">
                                        <img src="@/assets/frontend/images/time.svg" alt="">
                                        <div class="event-informcnt">
                                            <h4>Duration</h4>
                                            <p>{{ event.duration }}</p>
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
                            <h2 class="text-xl font-black mt-4 mb-0 hero-bold">Description</h2>
                            <p class="font-thin hero-regular">{{ event.description }}</p>
                        </div>
                        
                        <iframe 
                            class="block max-w-[600px] w-full mx-auto mt-4 aspect-video"
                            v-if="getVideoCode(event.video_link)" 
                            :src="`https://www.youtube.com/embed/${getVideoCode(event.video_link)}`" 
                            title="YouTube video player" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                        ></iframe>
                        
                        
                        <div v-if="event.locationTips">
                            <h2 class="text-xl font-black mt-4 mb-0 hero-bold">Location tips</h2>
                            <span class="hero-regular">{{ event.locationTips }}</span>
                        </div>
                        <div>
                            <template v-if="hasContact(event)">
                                <h2 class="text-xl font-black mt-4 mb-0 hero-bold">Contact us</h2>
                            </template>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <a v-if="event.facebook" :href="event.facebook" class="w-11 h-11 hover:shadow-md flex items-center justify-center text-2xl border rounded-full"><i class="fa fa-facebook"></i></a>
                                <a v-if="event.twitter" :href="event.twitter" class="w-11 h-11 hover:shadow-md flex items-center justify-center text-2xl border rounded-full"><i class="fab fa-twitter"></i></a>
                                <a v-if="event.instagram" :href="event.instagram" class="w-11 h-11 hover:shadow-md flex items-center justify-center text-2xl border rounded-full"><i class="fab fa-instagram"></i></a>
                                <a v-if="event.website" :href="event.website" class="w-11 h-11 hover:shadow-md flex items-center justify-center text-2xl border rounded-full"><i class="fa-solid fa-link"></i></a>
                            </div> 
                        </div>
                        <div class="event-termcond">
                            <div @click="showTerms = !showTerms" class="flex items-center justify-between text-lg font-black text-left border rounded select-none cursor-pointer py-2 px-4 w-full" style="border: 1px solid #828282 !important;">
                                Terms & Conditions
                                <i class="fas fa-angle-down transition rotate-90" :class="{'!rotate-0': showTerms}"></i>
                            </div>
                            <p class="mt-2" v-if="showTerms">{{ event.terms_and_conditions }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </Master>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import { isEmpty, get, now } from 'lodash'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import SocialShare from '@/Components/Frontend/Event/SocialShare.vue'
    import Master from './Master.vue'
    import useEvent from '@/Pages/useEvent.js'
    import Gallery from '@/Components/Frontend/EventDetails/Gallery.vue'
    import moment from 'moment'
    import { removeTags } from '@/Helper'
    import UseSocialMedia from '@/Components/Frontend/Event/UseSocialMedia.js'

    const {         
        title,
        url,
        postImg
    } = UseSocialMedia()

    const { get_banner } = useEvent() 
    const props = defineProps({
        event: Object,
        url: String
    })
    const showTerms = ref(true)
    const getVideoCode = (videoLink) => {
        if(!videoLink) return false
        let splitLink = videoLink.split('?v=')
        if(splitLink.length==2){
            let videoCode = splitLink[1].split('&')
            return videoCode[0]
        }
    }

    const hasContact = (event) => {
        if (
            event.facebook ||
            event.twitter ||
            event.instagram ||
            event.website
        ) {
            return true;
        }
        return false;
    }

    onMounted(() => {
        title.value = props.event.name
        url.value   = location.href
        postImg.value = props.url+'/'+get_banner(props.event?.images)
    })
</script>

<style scoped>
#details-banner {
    height: auto;
    aspect-ratio: 2.8 / 1;
}
@media (max-width: 768px) {
    #details-banner {
        height: auto;
        aspect-ratio: 1.3 / 1;
    }
}
</style>