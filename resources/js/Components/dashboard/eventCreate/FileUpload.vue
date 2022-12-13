<template>
    <div class="grid gap-4">
        <label class="bg-red-100 cursor-pointer relative max-w-[900px] mx-auto w-full" style="aspect-ratio: 3/1">
            <img v-if="images.banner" :src="images.banner" class="block h-full w-full object-cover object-center" />
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 font-bold bg-white p-4 bg-opacity-80 rounded shadow-lg">
                + Upload Banner
                <input hidden type="file" accept="image/*" @change="(e) => { imagePreview(e.target.files[0], images, 'banner'); formDataForFileUpload.append('bannerImage', e.target.files[0]); }">
            </div>
        </label>
        <div class="grid grid-cols-3 gap-4 max-w-[900px] mx-auto w-full" style="aspect-ratio: 3/1">
            <label class="relative bg-red-100 grid  items-center justify-center">
                <img v-if="images.imageOne" :src="images.imageOne" class="block h-full w-full object-cover object-center" />
                <div class="absolute cursor-pointer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 truncate font-bold bg-white p-4 bg-opacity-80 rounded shadow-lg">
                    + Upload Image
                    <input hidden type="file" accept="image/*" @change="(e) => { imagePreview(e.target.files[0], images, 'imageOne'); formDataForFileUpload.append('galleryImageOne', e.target.files[0]); }">
                </div>
            </label>
            <label class="relative bg-red-100 grid  items-center justify-center">
                <img v-if="images.imageTwo" :src="images.imageTwo" class="block h-full w-full object-cover object-center" />
                <div class="absolute cursor-pointer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 truncate font-bold bg-white p-4 bg-opacity-80 rounded shadow-lg">
                    + Upload Image
                    <input hidden type="file" accept="image/*" @change="(e) => { imagePreview(e.target.files[0], images, 'imageTwo'); formDataForFileUpload.append('galleryImageTwo', e.target.files[0]); }">
                </div>
            </label>
            <label class="relative bg-red-100 grid  items-center justify-center">
                <img v-if="images.imageThree" :src="images.imageThree" class="block h-full w-full object-cover object-center" />
                <div class="absolute cursor-pointer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 truncate font-bold bg-white p-4 bg-opacity-80 rounded shadow-lg">
                    + Upload Image
                    <input hidden type="file" accept="image/*" @change="(e) => { imagePreview(e.target.files[0], images, 'imageThree'); formDataForFileUpload.append('galleryImageThree', e.target.files[0]); }">
                </div>
            </label>
            
        </div>
        <div class="save-or-cancel">
            <div class="button save bg-red" @click="callback">Continue</div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import useEvent from '@/Pages/useEvent'
    const { insertedEventId, formDataForFileUpload } = useEvent()
    const props = defineProps({
        callback: {
            type: Function
        }
    })

    const images = ref({
        banner: null,
        imageOne: null,
        imageTwo: null,
        imageThree: null
    })

    const imagePreview = (file, item, key) => {
        let FR = new FileReader()
        FR.readAsDataURL(file)
        FR.onload = () => {
            item[key] = FR.result
        }
    }
</script>

<style lang="scss" scoped>
    
</style>