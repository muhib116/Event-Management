<template>
        <div>
            <div class="flex justify-between items-end">
                <h4 class="font-extrabold text-2xl">Tickets</h4>
                <button @click="() => showPopup = true" class="bg-orange-500 px-4 py-2 rounded shadow text-white">Add Tickets</button>
            </div>
            
            <!-- table start -->
            <div class="shadow mt-10 rounded border-t">
                <table class="w-full rounded">
                    <tr class="border-b">
                        <th class="px-2 py-4 text-gray-700">Ticket name</th>
                        <th class="px-2 py-4 text-gray-700">Ticket quantity</th>
                        <th class="px-2 py-4 text-gray-700">Ticket price</th>
                        <th class="px-2 py-4 text-gray-700"></th>
                    </tr>
                    <TableRow 
                        v-for="(item, index) in ticketList" 
                        :key="index" 
                        :data="item"
                        :callback="getList"
                    />
                </table>
            </div>
            
            <TicketCreatePopup
                v-model="showPopup" 
                :userId="userId"
            />
        </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import TicketCreatePopup from '@/Components/dashboard/popup/TicketCreatePopup.vue'
    import TableRow from '@/Components/dashboard/AllTickets/TableRow.vue'
    import useTicket from '@/Pages/useTicket.js'

    const { getEventId, getTickets, ticketList } = useTicket()
    const props = defineProps({
        editable: {
            type: Boolean,
            default: false
        },
        userId: [String, Number]
    })
    const showPopup = ref(false)
    
    const getList = async () => {
        getTickets(getEventId())
    }
    onMounted(() => {
        getList()
    })
</script>

<style lang="scss" scoped>
    
</style>