<template>
    <div class="grid lg:grid-cols-5 md:grid-cols-3 gap-3">
        <template v-for="(img, index) in images" :key="index">
            <img 
                @click="showImage(`../../../../${img.path}`)"
                v-if="img && img.type == 'gallery'"
                class="border aspect-square block object-cover object-center cursor-pointer"
                :src="`../../../../${img.path}`" 
                alt=""
            >
        </template>

        <vue-easy-lightbox
            moveDisabled
            :visible="visible"
            :imgs="img"
            :index="index"
            @hide="handleHide"
        ></vue-easy-lightbox>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import VueEasyLightbox from 'vue-easy-lightbox'
    defineProps({
        images: Array
    })
    const visible =  ref(false)
    const img     =  ref('')

    const showImage = (path) => {
        img.value = path
        show()
    }
    const show = () => {
        visible.value = true
    }
    const handleHide = () => {
        visible.value = false
    }
</script>

<style lang="scss" scoped>

</style>