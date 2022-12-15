<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="event-creation step-3 ">
                <Tickets />
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import Tickets from '@/Components/dashboard/AllTickets/Tickets.vue';
    import useTicket from './useTicket';

    const ticketList = ref([])
    const { getEventId, getTickets } = useTicket()
    const showPopup = ref(false)
    
    const getList = async () => {
        let tickets = await getTickets(getEventId())
        ticketList.value = tickets
    }
    onMounted(() => {
        getList()
    })
</script>

<style lang="scss" scoped>
    
</style>