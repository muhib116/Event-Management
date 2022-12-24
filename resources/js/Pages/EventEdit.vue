<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="account bg-[#e9eef1]">
                <div class="main-heading bg-transparent pl-0 h-[300px] container mx-auto">
                    <div class="left">
                        <h1>{{ event.name }}</h1>
                        <!-- <p><i class="fa-solid fa-calendar-days"></i> Wed, Aug 17 2022 at 10:00 PM - 10:30 PM GDT (Greenland)</p> -->
                        <p><i class="fa-solid fa-calendar-days"></i> {{ event.start_date }} at {{ event.start_time }} - {{ event.end_date }} at {{ event.start_time }} </p>
                        <p><i class="fa-solid fa-location-dot"></i> {{ event.location }}</p>
                    </div>
                    <div class="right">
                        <p class="top" v-if="event.is_expired"><i class="fa-solid fa-circle-exclamation"></i> This event ended {{ event.expired_at }} ago, to republish it:</p>
                        <p class="top" v-if="!event.is_expired && $page.props.has_payment_details != 1"><i class="fa-solid fa-circle-exclamation"></i> Things to do before you can make your event live</p>
                        <p class="requirement" v-if="$page.props.has_payment_details != 1"><span class="cursor-pointer select-none" @click="payPoput=true">Add payment details</span> so you can get paid</p>
                        <p class="requirement" v-if="event.ticket_count == 0"><span>Create some tickets</span> for your event</p>
                        <p class="requirement" v-if="event.is_expired">Update the <span class="cursor-pointer select-none" @click="scrollToDate">event date</span> </p>
                    </div>
                </div>
                <PaymentPopup
                    v-model="payPoput"
                />
            </div>
            <nav class="container mx-auto bg-white">
                <div class="dropdown-container" v-for="(item, index) in navList" :key="index" @click="handleComponent(item)">
                    <div class="profile nav-item filter-item" :class="item.isActive && 'active'"> 
                        {{ item.title }}
                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                    </div>
                </div>
            </nav>

            <div class="Profile--Personal account-item container mx-auto mt-5">
                <component 
                    :is="components[activeComponent]" 
                    :event="event" 
                    :editable="true"
                    :userId="userId"
                ></component>
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
    import ManageGuestlist from '@/Components/dashboard/event/ManageGuestlist.vue'
    import Sales from '@/Components/dashboard/event/Sales.vue'
    import Tickets from '@/Components/dashboard/AllTickets/Tickets.vue'
    import Master from './Master.vue'
    import useEvent from '@/Pages/useEvent.js'
import PaymentPopup from '@/Components/dashboard/popup/PaymentPopup.vue'

    const props = defineProps({
        userId: [Number, String]
    })
    const { getEventId, getEvent } = useEvent()
    const activeComponent = ref('EventDetail')
    const event = ref({})
    const payPoput = ref(false);
    const components = {
        EventDetail,
        Appearance,
        ManageGuestlist,
        Sales,
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
            title: 'ManageGuestlist',
            component: 'ManageGuestlist',
            isActive: false
        }, 
        {
            title: 'Tickets',
            component: 'Tickets',
            isActive: false
        },
        {
            title: 'Sales',
            component: 'Sales',
            isActive: false
        }
    ])

    onMounted(async () => {
        event.value = await getEvent(getEventId())
        console.log(event);
    })

    function scrollToDate() {
        let el = document.querySelector('.scroll_target');
        el.scrollIntoView({behavior: 'smooth'});
    }

    const handleComponent = (item) => {
        activeComponent.value = item.component
        navList.value.forEach(content => {
            content.isActive = item.component == content.component
            console.log(content.isActive)
        })
    }
</script>