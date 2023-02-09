<template>
    <main class="dashboard">
        <h1 class="text-4xl -m-5 mb-8 px-3 text-center border-b pb-4 border-slate-200 font-black">Welcome to {{ user.type }}  panel</h1> 
        
        <Widgets />

        <div class="events">
            <div @click="showEventPopup = true" v-show="user.type == 'organizer'" class="create-new cursor-pointer">
                <svg width="20px" height="20px" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"/>
                </svg>
                <p>Create new event</p>
            </div>
            
            <EventCard v-for="(event, index) in events.data" :key="index" :event="event" />
        </div>
        <div class="mt-10 flex justify-center" v-if="events.links && events.data.length">
            <div class="flex flex-wrap -mb-1">
                <div v-for="(link, inde) in events.links" :key="inde">
                    <div v-if="link.url === null" :key="Math.random()+Math.random()" class="mr-1 mb-1 px-4 py-3 bg-white text-sm leading-4 text-gray-800 border rounded" v-html="link.label" />
                    <Link :key="inde" v-else :class="{ 'brand_bg text-white': link.active, 'text-black': !link.active }" class="block mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded bg-white hover:bg-[var(brand\_color)] hover:border-[var(--brand\_color)] hover:text-white focus:border-[var(--brand\_color)] focus:text-white" :href="link.url">
                        <span v-html="link.label"></span>
                    </Link>
                </div>
            </div>
        </div>
        <div v-else>
            No event found
        </div>

        <NewEventPopup v-model="showEventPopup" />
    </main>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3'
    import { ref } from 'vue'
    import EventCard from './EventCard.vue';
    import NewEventPopup from './popup/NewEventPopup.vue'
    import Widgets from './Widgets.vue'

    const showEventPopup = ref(false)
    const props = defineProps({
        events: {
          typeof: Array
        },
        user: {
          type: Object,
          default: {}
        }
    });
</script>

<style>
</style>