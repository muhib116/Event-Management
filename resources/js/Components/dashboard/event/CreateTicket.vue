<template>
    <div>

        <div class="note">
            <a href="#">Tix is free to use for free events. If you’re charging guests a fee, we charge a percentage of the value of ticket as a transaction processing fee.</a> 
         </div>
         <div class="make-tickets">
            <img src="../../../assets/images/ticket-create.svg" alt="Ticket Create">
            <h5>Let's create tickets</h5>
            <p>You don't have any tickets created yet, create your first ticket - it will only take 1 minute</p>
            
            <div @click="() => showPopup = true" class="button" id="trigger_make_ticket">
               Add Ticket <i class="fa-solid fa-plus"></i>
            </div>
         </div>
         <!-- continue buttons 2-->
         <div class="continue-buttons">
            <Link :href="route('dashboard')" class="button">Skip and do this later</Link>
            <!-- <Link :href="route('tickets', getEventId())" class="button">Skip and do this later</Link> -->
         </div>
 
         <TicketCreatePopup v-model="showPopup" :userId="userId" :callback="redirectToTicketsPage"/>
    </div>
</template>

<script setup>
   import TicketCreatePopup from '@/Components/dashboard/popup/TicketCreatePopup.vue';
   import { ref } from 'vue'
   import { Link } from '@inertiajs/inertia-vue3'
   import useTicket from '@/Pages/useTicket.js'

   const props = defineProps({
      userId: [String, Number]
   })
   const { getEventId } = useTicket()
   const showPopup = ref(false)
   const redirectToTicketsPage = () => {
      console.log('callback...')
      window.location.href = route('tickets', getEventId())
   }
</script>

<style lang="scss" scoped>

</style>