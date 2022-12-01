<template>

    <AuthenticatedLayout>
        <Header />
        <div class="event-creation step-3 ">
            <Step />
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

    const activeComponent = ref(EventDetail)
    const {
        formData
    } = useEvent()

    const handleForm = (data) => {
        activeComponent.value = CreateTicket
        console.log(formData.value)
    }
</script>

<style lang="scss" scoped>

</style>