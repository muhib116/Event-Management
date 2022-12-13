<template>
    <main class="dashboard">
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
            
            <Link v-for="event in events" :key="event.id" :href="route('event.manage', event.name)" class="event">
                <div class="thumbnail">
                    <img :src="event.image" alt="Thumbnail">
                    <span>{{ event.status ? 'Ended' : 'Draft' }}</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">{{ event.name }}</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
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
    import NewEventPopup from './popup/NewEventPopup.vue';
import { Link } from '@inertiajs/inertia-vue3';
    const showEventPopup = ref(false)
    const showBoxOfficePopup = ref(false)
    const props = defineProps({
        events: {
            typeof: Array
        }
    });
</script>

<style lang="scss" scoped>

</style>