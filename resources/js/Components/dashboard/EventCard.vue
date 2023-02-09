<template>
    <div class="event">
        <div class="thumbnail relative">
            <img v-if="!isEmpty(event.images)" :src="`../../../../${get_banner(event.images)}`" alt="Thumbnail">
            <div @click="handlePublish(event)" class="cursor-pointer absolute py-1 px-4 top-4 right-4 rounded-md brand_bg text-white">{{ event.publish==1 ? 'Published' : 'Draft' }}</div>

            <div v-if="event.views?.count" class="absolute top-2 left-2 flex flex-col bg-white z-10 rounded-md py-0 px-2 text-center">
                <div class="flex items-center gap-2"><i class="fa fa-eye text-sm"></i> <div class="text-sm">{{ event.views?.count }}</div></div>
            </div>

        </div>
        <Link :href="route('event.edit', event.id)">
            <div class="details">
                <div class="top">
                    <div class="name" :title="event.name">{{ truncate(event.name, {
                        separator: ' ',
                        length: 25,
                    }) }}</div>
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
                    <div class="state text-right ">Tickets Sold</div>
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
    import { isEmpty, truncate } from 'lodash'
    const toast = useToast();
    const { get_banner } = useEvent()
    const props = defineProps({
        event: Object
    })

    const handlePublish = async (payload) => {
        payload.publish = !payload.publish;
        let { data } = await axios.post(`event/publish/${payload.id}`, payload)
        if(data.status){
            let msg = payload.publish ? 'Event Published' : 'Event Drafted'
            toast.success(msg, {
                timeout: 2000,
                position: "top-center",
            })
        } else {
            payload.publish = !payload.publish
            toast.error(data.message ? data.message : 'Something wrong', {
                timeout: 2000,
                position: "top-center",
            })
        }
    }
</script>

<style scoped>
main.dashboard .events .event .thumbnail {
    height: 73%;
}
@media (max-width: 992px) {
    main.dashboard .events .event .thumbnail {
        height: 58% !important;
    }
}
</style>