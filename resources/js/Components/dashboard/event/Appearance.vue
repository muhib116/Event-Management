<template>
    <div class="grid gap-4 overflow-y-auto pb-10" :class="editable&&'mb-10'">
        <label class="bg-slate-100 cursor-pointer relative grid items-center text-center max-w-[900px] mx-auto w-full" style="aspect-ratio: 3/1">
            <ImageUpload 
                :title="(getBannerImage(imageFromApi)) ? 'Update Banner' : 'Upload Banner'" 
                type="banner" 
                :id="eventId" 
                class="top-10"
                :callBack="() => {
                    deleteImage(getBannerId(imageFromApi))
                }"
            />
            <img v-if="getBannerImage(imageFromApi)" :src="getBannerImage(imageFromApi)" class="block h-full w-full object-cover object-center" />
            <h4 v-else>Banner Image not available</h4>
        </label>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4 max-w-[900px] mx-auto w-full md:px-0 px-5">
            
            <ImageUpload title="Upload Gallery" type="gallery" :id="eventId" class="min-h-[150px]" />
            
            <template v-for="(item, index) in imageFromApi" :key="index">
                <div v-if="item.type == 'gallery'" class="relative bg-slate-100 shadow-lg rounded overflow-hidden grid  items-center justify-center">
                    <button 
                        @click="handleImageDelete(item.id)"
                        class="absolute right-2 top-2 p-2 bg-white bg-opacity-50 shadow hover:text-red-500"
                    >
                        <svg width="20px" height="20px" viewBox="0 0 20 20" class="w-4 h-4" fill="currentColor"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                    </button>
                    <img :src="item.path" class="block h-full w-full object-cover object-center" />
                </div>
            </template>
        </div>


        <div v-if="!editable" class="save-or-cancel">
            <Link class="button save bg-red-500" :href="route('ticket', eventId)">Skip</Link>
            <Link class="button save bg-red" :href="route('ticket', eventId)">
                Continue
            </Link>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted, onUpdated } from 'vue'
    import { isEmpty } from 'lodash'
    import ImageUpload from '@/Components/dashboard/event/components/ImageUpload.vue'
    import useFileUpload from '@/Components/useFileUpload.js'
    import { Link } from '@inertiajs/inertia-vue3' 
    
    const props = defineProps({
        editable: {
            type: Boolean,
            default: false
        }
    })
    
    const {
        getImages,
        imageFromApi,
        deleteImage
    } = useFileUpload()

    const eventId = ref(null)

    const getBannerImage = (images) => {
        let filteredImage = images.filter(item => {
            return (item.type=='banner')
        })
        if(isEmpty(filteredImage)) return
        return (filteredImage[0].path) ? filteredImage[0].path : ''
    }
    const getBannerId = (images) => {
        let filteredImage = images.filter(item => {
            return (item.type=='banner')
        })
        if(isEmpty(filteredImage)) return null
        return (filteredImage[0].id) ? filteredImage[0].id : null
    }
    const handleImageDelete = (id) => {
        if(confirm('Are you sure to delete this image ?')){
            deleteImage(id)
            getImages(eventId.value)
        }
    }
    const getEventId = () => {
        let urlData = window.location.pathname.split('/')
        return urlData.at(-1)
    }


    onMounted(() => {
        getImages(getEventId())
    })
    onUpdated(() => {
        eventId.value = getEventId()
    })
</script>

<style lang="scss" scoped>
    
</style>