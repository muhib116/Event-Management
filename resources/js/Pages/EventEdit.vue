<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="account">
                <div class="main-heading h-[300px]">
                    <div class="left">
                        <h1>{{ event.name }}</h1>
                        <p><i class="fa-solid fa-calendar-days"></i> Wed, Aug 17 2022 at 10:00 PM - 10:30 PM GDT (Greenland)</p>
                        <p><i class="fa-solid fa-calendar-days"></i> {{ event.start_date }} at {{ event.start_time }} - {{ event.end_date }} at {{ event.start_time }} </p>
                        <p><i class="fa-solid fa-location-dot"></i> {{ event.location }}</p>
                    </div>
                    <div class="right">
                        <p class="top"><i class="fa-solid fa-circle-exclamation"></i> This event ended 20 days ago, to republish it:</p>
                        <p class="requirement"><span>Add payment details</span> so you can get paid</p>
                        <p class="requirement"><span>Create some tickets</span> for your event</p>
                        <p class="requirement">Update the <span>event date</span> </p>
                    </div>
                </div>
            </div>
            <nav>
                <div class="dropdown-container" v-for="(item, index) in navList" :key="index" @click="handleComponent(item)">
                    <div class="profile nav-item filter-item" :class="item.isActive && 'active'"> 
                        {{ item.title }}
                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                    </div>
                </div>
            </nav>

            <div class="Profile--Personal account-item container mx-auto mt-5">
                <component :is="components[activeComponent]" :event="event" editable="true"></component>
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import EventDetail from '@/Components/dashboard/event/EventDetail.vue'
    import Appearance from '@/Components/dashboard/event/Appearance.vue'
    import Tickets from '@/Components/dashboard/AllTickets/Tickets.vue'
    import Master from './Master.vue'
    import useEvent from '@/Pages/useEvent.js'

    const { getEventId, getEvent } = useEvent()
    const activeComponent = ref('EventDetail')
    const event = ref({})
    const components = {
        EventDetail,
        Appearance,
        Tickets
    }
    const navList = ref([
        {
            title: 'Detail',
            component: 'EventDetail',
            isActive: true
        },
        {
            title: 'Appearance',
            component: 'Appearance',
            isActive: false
        },
        {
            title: 'Tickets',
            component: 'Tickets',
            isActive: false
        }
    ])

    onMounted(() => {
        event.value = getEvent(getEventId())
    })

    const handleComponent = (item) => {
        activeComponent.value = item.component
        navList.value.forEach(content => {
            content.isActive = item.component == content.component
            console.log(content.isActive)
        })
    }
</script>