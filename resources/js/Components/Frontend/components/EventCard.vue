<template>
    <Link :href="route('event.details', item.slug)" class="w-full block px-2 relative hover:text-black text-gray-600">
        <div class="upcome-item overflow-hidden border-slate-300 rounded-lg hover:shadow-xl transition-shadow duration-300"> 
            <div class="upcome-banr h-[200px]">
                <img v-if="item.images && !isEmpty(item.images)" :src="get_banner(item.images)" :alt="item.name" class="h-full object-cover object-center w-full">
            </div>
            <div class="text-left px-3">
                <h2 :title="item.name" class="text-[24px] pt-3 pb-2 text-left font-sans !font-extrabold truncate"> 
                    {{ truncate(item.name, 35) }}
                </h2>
                <div class="grid gap-2">
                    <p>
                        <i class="far fa-calendar-alt text-slate-500"></i> {{ moment(item.start_date).format('MMM D YYYY') }}
                    </p>
                    <p class="flex truncate" :title="`${ get(item, 'location') } ${ get(item, 'settings.city') ? get(item, 'settings.city') : '' }`">
                        <i class="fa-solid mt-1 fa-location-dot text-slate-500"></i>
                        <span class="flex-2 pl-2 truncate" style="display:block;">
                            {{ item.location }}
                            <span v-if="!isEmpty(item.settings.city)">, {{ get(item, 'settings.city') }},</span>
                            <!-- {{ get(item, 'settings.streetName') }} -->
                            <!-- <span v-if="get(item, 'settings.houseNumber')">{{ get(item, 'settings.houseNumber') }},</span>
                            {{ get(item, 'settings.postcode') }} -->
                            <!-- <div>{{ get(item, 'settings.country') }}</div> -->
                        </span>
                        <!-- {{ item.location }} -->
                        <!-- <span v-if="!isEmpty(item.settings.city)">, {{ item.settings.city }}</span> -->
                    </p>
                </div>
                <div class="border-b border-gray-300 mb-2 mt-3"></div>
                <div class="flex justify-between pb-2"> 
                    <span v-if="item.min_price > 0">{{  item.min_price }} <span style="font-family: initial !important;">{{ $page.props.currency?.value }}</span></span>
                    <span v-else>Free</span>
                    <span class="text-orange-600 font-bold font-sans">Get Ticket</span>
                </div>
            </div>
        </div>
    </Link>
</template>

<script setup>
    import Helper from '@/Helper.js'
    import useEvent from '@/Pages/useEvent.js'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import {isEmpty, get} from 'lodash'
    import moment from 'moment'
    const { get_banner } = useEvent()
    const p = defineProps({
        item: Object
    })
    const { getMonth, formateDate, truncate, formateYear } = Helper()
</script>

<style lang="scss" scoped>

</style>