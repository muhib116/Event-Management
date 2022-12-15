<template>
    <main class="dashboard">
        <h1 class="title">Widgets</h1>
        <div class="py-4 mb-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Traffic</h5>
                                    <span class="font-bold text-xl">350,897</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"><i class="far fa-chart-bar"></i></div>
                                </div>
                            </div>
                            <p class="text-sm text-blueGray-500 mt-4"><span class="text-emerald-500 mr-2"><i class="fas fa-arrow-up"></i> 3.48%</span><span class="whitespace-nowrap">Since last month</span></p>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">NEW USERS</h5>
                                    <span class="font-bold text-xl">2,356</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"><i class="fas fa-chart-pie"></i></div>
                                </div>
                            </div>
                            <p class="text-sm text-blueGray-500 mt-4"><span class="text-red-500 mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span><span class="whitespace-nowrap">Since last week</span></p>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">SALES</h5>
                                    <span class="font-bold text-xl">924</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"><i class="fas fa-users"></i></div>
                                </div>
                            </div>
                            <p class="text-sm text-blueGray-500 mt-4"><span class="text-orange-500 mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span><span class="whitespace-nowrap">Since yesterday</span></p>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">PERFORMANCE</h5>
                                    <span class="font-bold text-xl">49,65%</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-blueGray-500 mt-4">
                                <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-down"></i> 12%
                                </span>
                                <span class="whitespace-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="title">Your events</h1>
        <div class="events">

            <div>
                <div @click="showEventPopup = true" class="create-new cursor-pointer">
                    <svg width="20px" height="20px" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"/>
                    </svg>
                    <p>Create new event</p>
                </div>
            </div>
            
            <Link v-for="event in events" :href="route('event.edit', event.id)" :key="event.id" class="event">
                <div class="thumbnail">
                    <img :src="get_banner(event.images)" alt="Thumbnail">
                    <span>{{ event.status ? 'Ended' : 'Draft' }}</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">{{ event.name }}</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">{{ event.event_tickets_sum_sold ? event.event_tickets_sum_sold : 0 }}</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">{{ event.start_date }}</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </Link>
        </div>

        <NewEventPopup v-model="showEventPopup" />
    </main>
</template>

<script setup>
    import { ref } from 'vue'
    import { get } from 'lodash'
    import NewEventPopup from './popup/NewEventPopup.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    const showEventPopup = ref(false)
    const props = defineProps({
        events: {
            typeof: Array
        }
    })
    const get_banner = (images) => {
        let img = images.find(item => {
            return item.type=='banner'
        })
        if(!get(img, 'path')) return null
        return `../../../../${img.path}`
    }
</script>

<style lang="scss" scoped>
</style>