<template>
    <div class="upcome-item">
        <div class="upcome-banr h-[150px]">
            <img :src="item.image" :alt="item.name" class="h-full block">
        </div>
        <div class="upcome-cnt">
            <div class="upcome-cntleft">
                <h4 class="uppercase">{{ getMonth(item.start_date).slice(0,3) }}</h4>
                <p>
                    {{ formateDate(item.start_date) }}
                </p>
            </div>
            <div class="upcome-cntright">
                <h4 class="text-right" :title="item.name">{{ truncate(item.name, 25) }}</h4>
                <p class="text-right">{{ item.price ? item.price : 'Free' }}</p>
                <p class="text-right">
                    <i class="fas fa-map-marker-alt"></i> {{ item.location }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
    import useUpcomingEvents from '@/Components/Frontend/useUpcomingEvents.js'
    defineProps({
        item: Object
    })
    const { getMonth, formateDate, truncate } = useUpcomingEvents()
</script>

<style lang="scss" scoped>

</style>