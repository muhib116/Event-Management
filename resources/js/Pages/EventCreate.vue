<template>
    <div class="event-creation step-3 ">
        <Step />
        <EventDetail />
        <CreateTicket />

    </div>
</template>

<script setup>
   import Step from '@/Components/dashboard/eventCreate/Step.vue';
   import EventDetail from '@/Components/dashboard/eventCreate/EventDetail.vue';
   import CreateTicket from '@/Components/dashboard/eventCreate/CreateTicket.vue';
</script>

<style lang="scss" scoped>

</style>