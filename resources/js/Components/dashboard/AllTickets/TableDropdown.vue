<template>
    <div class="absolute top-full right-0 grid bg-white z-10 text-xs rounded shadow-lg">
        <button @click="$emit('openTicketPopup')" class="px-5 text-left py-2 border-b">Edit</button>
        <button @click="handleDuplicate(data.id)" class="px-5 text-left py-2 border-b">Duplicate</button>
        <a :href="route('ticket_view', data.id)" target="_blank" class="px-5 text-left py-2 border-b whitespace-nowrap">View design</a>
        <button @click="handleHidden(data)" class="px-5 text-left py-2 border-b">
            {{ data.settings.isHidden ? 'Show' : 'Hide' }}
        </button>
        <button @click="handleDelete(data.id)" class="px-5 text-left py-2 border-b">Delete</button>
    </div>
</template>

<script setup>
    import useTicket from '@/Pages/useTicket.js'
    import { useToast } from "vue-toastification"
    import { Link } from '@inertiajs/inertia-vue3';

    const toast = useToast();
    const props = defineProps({
        data: Object
    })
    const { deleteTicket, getTickets, getEventId, duplicateTicket, updateTicket } = useTicket()
    
    const handleDuplicate = async (id) => {
        let { data } = await duplicateTicket(id)
        if(data){
            getTickets(getEventId())
            toast.success("Ticket duplicated!", {
                timeout: 2000,
                position: "top-center",
            })
            return
        }
        toast.error("Something went wrong!", {
            timeout: 2000,
            position: "top-center",
        })
    }

    const handleHidden = (data) => {
        data.settings.isHidden = !data.settings.isHidden
        
        let res = updateTicket(data, data.id)
        let msg = data.settings.isHidden ? 'Now this ticket hidden' : 'Now this ticket is ready to show'
        if(res){
            toast.success(msg, {
                timeout: 2000,
                position: "top-center",
            })
            getTickets(getEventId())
            return
        }
        toast.error("Something went wrong!", {
            timeout: 2000,
            position: "top-center",
        })
    }

    const handleDelete = async (id) => {
        if(confirm('Are you sure to delete this ticket?')){
            let res = await deleteTicket(id)
            if(res.statusText == "OK"){
                getTickets(getEventId())
                toast.success("Ticket deleted!", {
                    timeout: 2000,
                    position: "top-center",
                })
                return
            }
            toast.error("Something went wrong!", {
                timeout: 2000,
                position: "top-center",
            })
        }
    }
</script>

<style lang="scss" scoped>

</style>