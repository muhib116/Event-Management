<template>
    <Link :href="route('event.details', item.slug)" class="w-full block">
        <div class="upcome-item">
            <div class="upcome-banr h-[200px]">
                <img :src="`../../../../../${get_banner(item.images)}`" :alt="item.name" class="h-full block object-cover object-center w-full">
            </div>
            <div class="upcome-cnt justify-between">
                <div class="upcome-cntleft">
                    <h4 class="uppercase">{{ getMonth(item.start_date).slice(0,3) }}</h4>
                    <p>
                        {{ formateDate(item.start_date) }}
                    </p>
                </div>
                <div class="upcome-cntright">
                    <h4 class="text-right" :title="item.name">{{ truncate(item.name, 25) }}</h4>
                    <p class="text-right" v-if="item.min_price == item.max_price">
                        {{ item.min_price ? `$ ${item.min_price}` : 'Free' }}
                    </p>
                    <p class="text-right" v-else>
                        {{ item.min_price ? `$ ${item.min_price}-${item.max_price}` : 'Free' }}
                    </p>
                    <p class="text-right">
                        <i class="fas fa-map-marker-alt"></i> {{ (item.eventType == 'online-event') ? 'Online' : item.location }}
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
    console.log(p.item);
    const { getMonth, formateDate, truncate } = Helper()
</script>

<style lang="scss" scoped>

</style>