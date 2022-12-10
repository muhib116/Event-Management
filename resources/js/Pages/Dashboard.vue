<script setup>
import Header from '@/Components/dashboard/Header.vue';
import EventDashboard from '@/Components/dashboard/EventDashboard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Master from './Master.vue';
const props = defineProps({
    events: {
        type: Array
    }
})

</script>

<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <EventDashboard :events="events" />
        </AuthenticatedLayout>
    </Master>
</template>
