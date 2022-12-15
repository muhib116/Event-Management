<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="event-creation step-3 ">
                <Step :step="2"/>
                <Appearance />
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import Master from '@/Pages/Master.vue'
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import Step from '@/Components/dashboard/event/Step.vue'
    import Appearance from '@/Components/dashboard/event/Appearance.vue'
</script>

<style lang="scss" scoped>
    
</style>