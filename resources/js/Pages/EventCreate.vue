<template>

    <AuthenticatedLayout>
        <Header />
        <div class="event-creation step-3 ">
            <Step :step="progressStep"/>
            <component :is="activeComponent" :callback="handleForm" :formData="formData"></component>
            <!-- <EventDetail :callback="handleForm" /> -->
            <!-- <CreateTicket /> -->
        </div>
    </AuthenticatedLayout>

</template>

<script setup>
    import { ref } from 'vue'
    import Header from '@/Components/dashboard/Header.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Step from '@/Components/dashboard/eventCreate/Step.vue';
    import EventDetail from '@/Components/dashboard/eventCreate/EventDetail.vue';
    import CreateTicket from '@/Components/dashboard/eventCreate/CreateTicket.vue';
    import useEvent from './useEvent.js'

    const props = defineProps({
        eventType: {
            type: String
        }
    })
    const progressStep = ref(1)
    const activeComponent = ref(EventDetail)
    const {
        formData
    } = useEvent()

    const handleForm = (data) => {
        progressStep.value ++
        formData.value.eventType = props.eventType
        activeComponent.value = CreateTicket
        console.log(formData.value, props)
    }
</script>

<style scoped>
    .progressStep{
        width: 100%;
    }
</style>