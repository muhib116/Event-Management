<template>
    <Head title="Event Details" />
    <Master>
        <div class="result-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="result-right">
                            <div v-if="!isEmpty(events)" class="result-forupr">
                                <h2>Search results for <span> “{{ events[0].eventCategory }}”</span></h2>
                            </div>

                            <h1 v-else class="font">No result found</h1>

                            <div class="row">
                                <div class="col-sm-6 col-xl-4" v-for="(event, index) in events" :key="index">
                                    <Link :href="route('event.details', event.slug)" class="w-full block">
                                        <div class="result-item">
                                            <img :src="`../../../../${get_banner(event.images)}`" alt="Thumbnail" class="h-full w-full block object-cover object-center h-[250px]">
                                            <div class="result-cnt justify-between">
                                                <div class="result-cntleft">
                                                    <h4 class="uppercase">{{ getMonth(event.start_date).slice(0,3) }}</h4>
                                                    <p>
                                                        {{ formateDate(event.start_date) }}
                                                    </p>
                                                </div>
                                                <div class="result-cntright text-right">
                                                    <h4 class="text-right" :title="event.name">{{ truncate(event.name, 25) }}</h4>
                                                    <p class="text-right">{{ event.event_tickets_min_price ? `$ ${event.event_tickets_min_price}` : 'Free' }}</p>
                                                    <p class="text-right">
                                                        <i class="fas fa-map-marker-alt"></i> {{ (event.eventType == 'online-event') ? 'Online' : event.location }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </Link>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import { isEmpty } from 'lodash'
    import Master from './Master.vue'
    import useEvent from '@/Pages/useEvent.js'
    import Helper from '@/Helper.js'

    const { get_banner } = useEvent()
    const props = defineProps({
        events: Array
    })
    const { getMonth, formateDate, truncate } = Helper()
</script>

<style lang="scss" scoped>

</style>