<template>
    <div class="event">
        <div class="thumbnail relative">
            <img :src="`../../../../${get_banner(event.images)}`" alt="Thumbnail">
            <span @click="handlePublish(event)" class="cursor-pointer">{{ event.publish ? 'Published' : 'Draft' }}</span>
        </div>
        <Link :href="route('event.edit', event.id)">
            <div class="details">
                <div class="top">
                    <div class="name">{{ event.name }}</div>
                    <div class="tickets">
                        <img src="../../assets/images/ticket.svg" alt="">
                        <div class="number">{{ event.event_tickets_sum_sold ? event.event_tickets_sum_sold : 0 }}</div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="date">
                        {{ event.start_date }} by 
                        <span class="text-orange-600">{{ event.user.first_name }} {{ event.user.last_name }}</span>
                    </div>
                    <div class="state">Tickets Sold</div>
                </div>
            </div>
        </Link>
    </div>
</template>

<script setup>
    import axios from 'axios';
    import { Link } from '@inertiajs/inertia-vue3'
    import useEvent from '@/Pages/useEvent.js'
    import { useToast } from "vue-toastification";

    const toast = useToast();
    const { get_banner } = useEvent()
    const props = defineProps({
        event: Object
    })

    const handlePublish = async (payload) => {
        payload.publish = !payload.publish
        let { data } = await axios.post(`event/publish/${payload.id}`, payload)
        if(data.status){
            let msg = payload.publish ? 'Event Published' : 'Event Drafted'
            toast.success(msg, {
                timeout: 2000,
                position: "top-center",
            })
        }
    }
</script>

<style lang="scss" scoped>

</style>