<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="event-creation step-3 ">
                <Step :step="progressStep"/>
                <component :is="activeComponent" :callback="handleForm"></component>
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

    import Step from '@/Components/dashboard/eventCreate/Step.vue'
    import EventDetail from '@/Components/dashboard/eventCreate/EventDetail.vue'
    import FileUpload from '@/Components/dashboard/eventCreate/FileUpload.vue'
    import CreateTicket from '@/Components/dashboard/eventCreate/CreateTicket.vue'

    import useEvent from './useEvent.js'
    import Master from './Master.vue'

    const props = defineProps({
        eventType: {
            type: String
        }
    })
    const progressStep = ref(1)
    const activeComponent = ref(EventDetail)
    const {
        eventForm,
        insertedEventId
    } = useEvent()

    onMounted(() => {
        eventForm.value.eventType = props.eventType
    })

    const handleForm = (eventInsertedId=null) => 
    {
        if(eventInsertedId){
            insertedEventId.value = eventInsertedId
        }

        progressStep.value ++
        if(progressStep.value == 2){
            activeComponent.value = FileUpload
        }
        
        if(progressStep.value == 3){
            activeComponent.value = CreateTicket
        }
    }
</script>

<style scoped>
    .progressStep{
        width: 100%;
    }
</style>