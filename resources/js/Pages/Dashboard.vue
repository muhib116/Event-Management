<script setup>
import Header from '@/Components/dashboard/Header.vue';
import EventDashboard from '@/Components/dashboard/EventDashboard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Master from './Master.vue';
import useDashboard from './useDashboard.js';
import { onMounted } from '@vue/runtime-core';
const { dashboard } = useDashboard();
const props = defineProps({
    events: {
        type: Object
    },
    user: {
        type: Object,
        default: {}
    },
    total_sales_quantity: Number,
    total_sales_amount: Number,
    total_commission: Number,
    total_event: Number,
    total_ticket: Number,
})
onMounted(() => {
    dashboard.value = {
        total_sales_quantity: props.total_sales_quantity,
        total_sales_amount: props.total_sales_amount,
        total_commission: props.total_commission,
        total_event: props.total_event,
        total_ticket: props.total_ticket,
    }
});
</script>

<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <EventDashboard 
                :events="events" 
                :user="user"
            />
        </AuthenticatedLayout>
    </Master>
</template>
