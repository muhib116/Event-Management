<template>
    <Head title="Event Details" />
    <Master>
        <div class="result-wrapper footer_mh">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="result-right">
                            <div v-if="!isEmpty(events)" class="result-forupr">
                                <h2>Search results for <span> “{{ events[0].eventCategory }}”</span></h2>
                            </div>
                            <div v-else class="min-h-[calc(51vh+5px)] flex items-center justify-center">
                                <h1 class="font">No result found</h1>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-xl-4" style="margin-bottom: 20px" v-for="(event, index) in event_list" :key="index">
                                    <EventCard :item="event" />
                                </div>
                            </div>
                            <div class="flex justify-center" v-if="events.length>page_size">
                                <el-pagination 
                                    v-model:current-page="page_number" 
                                    background layout="prev, pager, next" 
                                    :total="events.length"
                                    :page-size="page_size"
                                    :pager-count="4"
                                />
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
    import EventCard from '@/Components/Frontend/components/EventCard.vue'
    import { computed, ref, watch, watchEffect } from '@vue/runtime-core'

    const { get_banner } = useEvent()
    const props = defineProps({
        events: Array
    })
    
    const { getMonth, formateDate, truncate } = Helper()


    const page_number = ref(1);
    const page_size = ref(12);
    const local_event = [...props.events];
    const event_list = computed(()=> {
        let start_point = (page_number.value -1) * page_size.value;
        let end_point = start_point + page_size.value;
        return local_event.slice(start_point, end_point);
    });

</script>

<style lang="scss" scoped>

</style>