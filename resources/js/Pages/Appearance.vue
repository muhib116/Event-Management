<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="event-creation step-3 ">
                <Step :step="2"/>
                <Appearance />
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import Step from '@/Components/dashboard/event/Step.vue'

    import { isEmpty } from 'lodash'
    // import useEvent from '@/Pages/useEvent'
    import useFileUpload from '@/Components/useFileUpload.js'
    import Appearance from '@/Components/dashboard/event/Appearance.vue'

    const props = defineProps({
        callback: {
            type: Function
        }
    }) 
    const {
        getImages,
        imageFromApi,
        deleteImage
    } = useFileUpload()
    const eventId = 6
    
    // const { insertedEventId, formDataForFileUpload } = useEvent()

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
            getImages(eventId)
        }
    }
    onMounted(async() => {
        getImages(eventId)
    })
</script>

<style lang="scss" scoped>
    
</style>