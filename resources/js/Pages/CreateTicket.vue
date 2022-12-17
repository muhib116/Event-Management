<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="event-creation step-3 ">
                <Step step="3"/>
                <CreateTicket :userId="userId" />
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import Step from '@/Components/dashboard/event/Step.vue'
    import CreateTicket from '@/Components/dashboard/event/CreateTicket.vue'
    import Master from './Master.vue'
    
    const props = defineProps({
        userId: [String, Number]
    })
</script>

<style scoped>
    .progressStep{
        width: 100%;
    }
</style>