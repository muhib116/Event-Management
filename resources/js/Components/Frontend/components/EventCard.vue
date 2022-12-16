<template>
    <div class="upcome-item">
        <div class="upcome-banr h-[150px]">
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
                <p class="text-right">{{ item.event_tickets_min_price ? `$ ${item.event_tickets_min_price}` : 'Free' }}</p>
                <p class="text-right">
                    <i class="fas fa-map-marker-alt"></i> {{ item.location }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
    import useUpcomingEvents from '@/Components/Frontend/useUpcomingEvents.js'
    import useEvent from '@/Pages/useEvent.js'

    const { get_banner } = useEvent()
    defineProps({
        item: Object
    })
    const { getMonth, formateDate, truncate } = useUpcomingEvents()
</script>

<style lang="scss" scoped>

</style>