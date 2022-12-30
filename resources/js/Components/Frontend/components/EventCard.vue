<template>
    <Link :href="route('event.details', item.slug)" class="w-full block px-2 relative">
        <div class="upcome-item overflow-hidden">
            <div class="absolute top-3 right-3 mt-4 bg-blue-600 bg-opacity-60 backdrop-blur-lg text-white w-14 h-14 grid items-center justify-center rounded p-2 shadow-lg">
                <h4 class="uppercase text-sm mb-0" style="line-height: 1 !important;font-weight: bold !important;font-family: 'Cabinet Grotesk', sans-serif;">{{ getMonth(item.start_date).slice(0,3) }}</h4>
                <p class="mt-0 text-xs">
                    {{ formateDate(item.start_date) }}
                </p>
            </div>
            <div class="upcome-banr h-[200px]">
                <img :src="get_banner(item.images)" :alt="item.name" class="h-full object-cover object-center w-full">
            </div>
            <div class="">
                <div class="upcome-cntright text-center py-3 grid ml-0">
                    <h4 :title="item.name" class="text-xl mb-0">{{ truncate(item.name, 25) }}</h4>
                    <p v-if="item.min_price == item.max_price" class="mt-0">
                        {{ item.min_price ? `$ ${item.min_price}` : 'Free' }}
                    </p>
                    <p v-else class="mt-0">
                        {{ item.min_price ? `$ ${item.min_price}-${item.max_price}` : 'Free' }}
                    </p>
                    <p class="flex items-center justify-center gap-1 mt-0">
                        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2.009c-2.762 0-5 2.229-5 4.99 0 4.774 5 11 5 11s5-6.227 5-11c0-2.76-2.238-4.99-5-4.99zm0 7.751a2.7 2.7 0 1 1 0-5.4 2.7 2.7 0 0 1 0 5.4z"/></svg>
                        {{ (item.eventType == 'online-event') ? 'Online' : item.location }}
                    </p>
                </div>
            </div>
        </div>
    </Link>
</template>

<script setup>
    import Helper from '@/Helper.js'
    import useEvent from '@/Pages/useEvent.js'
    import { Head, Link } from '@inertiajs/inertia-vue3'

    const { get_banner } = useEvent()
    const p = defineProps({
        item: Object
    })
    const { getMonth, formateDate, truncate } = Helper()
</script>

<style lang="scss" scoped>

</style>