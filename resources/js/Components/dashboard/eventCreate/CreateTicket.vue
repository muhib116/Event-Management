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
            <div class="button">Skip and do this later</div>
         </div>
 
         <TicketCreatePopup v-model="showPopup"/>
    </div>
</template>

<script setup>
   import TicketCreatePopup from '@/Components/dashboard/popup/TicketCreatePopup.vue';
   import { ref } from 'vue'
   const showPopup = ref(false)
</script>

<style lang="scss" scoped>

</style>