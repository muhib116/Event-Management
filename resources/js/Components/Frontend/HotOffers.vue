<template>
    <div class="offer-area">
        <div class="container">
            <div class="upcome-upper">
                <h2>Hot Offers</h2>
                <a href="#">View All <i class="fas fa-chevron-right" aria-hidden="true"></i></a>
            </div>

            <div class="row">
                <a v-for="item in data" :key="item.id" target="_blank" :href="item.link" class="block col-md-6">
                    <div class="offer-item">
                        <img :src="item.image" alt="" class="h-[300px] object-cover object-center block w-full">
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
    const props = defineProps({
        data: Array
    })
</script>

<style lang="scss" scoped>

</style>