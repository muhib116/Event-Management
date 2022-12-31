<template>
    <div class="w-full">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
            <button @click="() => {isCameraOpen=true;showScanner=true;}" class="px-4 bg-blue-500 text-white rounded-md text-sm font-semibold flex gap-2 items-center py-7 cursor-pointer justify-center">
                <i class="fas fa-qrcode"></i>
                Scan Ticket
            </button>
        </div>
        <QRScanner v-model="showScanner" :isCameraOpen="isCameraOpen" />
    </div>
</template>

<script setup>
    import QRScanner from './QRScanner.vue';
    import { ref } from 'vue'

    const isCameraOpen = ref(false)
    const showScanner  = ref(false)
</script>

<style lang="scss" scoped>

</style>