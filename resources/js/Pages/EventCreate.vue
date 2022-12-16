<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="event-creation step-3 ">
                <Step step="1"/>
                <EventDetail :userId="userId" />
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import { onMounted } from 'vue'
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import Step from '@/Components/dashboard/event/Step.vue'

    import EventDetail from '@/Components/dashboard/event/EventDetail.vue'

    import useEvent from './useEvent.js'
    import Master from './Master.vue'

    const props = defineProps({
        eventType: {
            type: String
        },
        userId: [Number, String]
    })

    const {
        eventForm
    } = useEvent()

    onMounted(() => {
        eventForm.value.eventType = props.eventType
    })
</script>

<style scoped>
    .progressStep{
        width: 100%;
    }
</style>