<template>
    <main class="dashboard">
        <!--  -->
        <h1 class="title">Your events</h1>
        <div class="events">

            <div>
                <div @click="showEventPopup = true" class="create-new">
                    <i class="fa-solid plus-icon fa-plus"></i>
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
            <!-- <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/thumbnail.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/thumbnail.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/virtural-event.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/digital-marketing.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a>
            <a href="live/event" class="event">
                <div class="thumbnail">
                    <img src="../../assets/images/thumbnail.png" alt="Thumbnail">
                    <span>Ended</span>
                </div>
                <div class="details">
                    <div class="top">
                        <div class="name">TEST EMM</div>
                        <div class="tickets">
                            <img src="../../assets/images/ticket.svg" alt="">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="date">Ended 4 Days ago</div>
                        <div class="state">Tickets Sold</div>
                    </div>
                </div>
            </a> -->
        </div>

        <NewEventPopup v-model="showEventPopup" />
        <BoxOfficePopup v-model="showBoxOfficePopup" />
    </main>
</template>

<script setup>
    import { ref } from 'vue'
    import NewEventPopup from './popup/NewEventPopup.vue';
    import BoxOfficePopup from './popup/BoxOfficePopup.vue';
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