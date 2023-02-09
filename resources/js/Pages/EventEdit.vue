<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="account bg-[#e9eef1]">
                <div class="main-heading px-4 md:px-0 bg-transparent pl-0 container mx-auto">
                    <div class="left">
                        <h1>{{ event.name }}</h1>
                        <p>
                            <i class="fa-solid fa-calendar-days"></i> 
                            {{ moment(event.start_date).format('ddd., DD MMM. YYYY') }}, {{ event.start_time_formate }}. - 
                            {{ moment(event.end_date).format('ddd., DD MMM. YYYY') }}, {{ event.end_time_formate }}. </p>
                        <p class="flex gap-2">
                            <i class="fa-solid mt-2 fa-location-dot"></i> 
                            <span>
                                {{ get(event, 'location') }} 
                                {{ get(event, 'settings.streetName') }}
                                <span v-if="get(event, 'settings.houseNumber')">{{ get(event, 'settings.houseNumber') }},</span>
                                {{ get(event, 'settings.postcode') }}
                                {{ get(event, 'settings.city') }}
                                <span v-if="get(event, 'settings.country')">{{ get(event, 'settings.country') }}</span>
                            </span>
                        </p>
                    </div>
                    <div class="right">
                        <p class="top" v-if="event.is_expired"><i class="fa-solid fa-circle-exclamation"></i> This event ended {{ event.expired_at }} ago, to republish it:</p>
                        <p class="top" v-if="!event.is_expired && $page.props.has_payment_details != 1 && $page.props.user.type != 'admin'"><i class="fa-solid fa-circle-exclamation"></i> Things to do before you can make your event live</p>
                        <p class="requirement" v-if="$page.props.has_payment_details != 1 && $page.props.user.type != 'admin'">
                            <span class="cursor-pointer select-none" @click="payPoput=true">Add payment details</span> so you can get paid
                        </p>
                        <p class="requirement" v-if="event.ticket_count == 0"><span @click="showPopup=true" class="cursor-pointer">Create some tickets</span> for your event</p>
                        <p class="requirement" v-if="event.is_expired && !$page.props.is_paid">Update the <span class="cursor-pointer select-none" @click="updateEventDate">event date</span> </p>
                    </div>
                </div>
                <PaymentPopup v-model="payPoput" />
            </div>

            <nav class="container mx-auto bg-white">
                <div class="dropdown-container" v-for="(item, index) in navList" :key="index" @click="handleComponent(item)">
                    <div class="profile nav-item filter-item" :class="item.isActive && 'active'"> 
                        {{ item.title }}
                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                    </div>
                </div>
            </nav>
            <TicketCreatePopup
                v-model="showPopup" 
                :userId="userId"
            />
            <div class="Profile--Personal account-item container mx-auto mt-5">
                <component 
                    :is="components[activeComponent]" 
                    :event="event" 
                    :editable="true"
                    :userId="userId"
                    :settings="settings"
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
    import moment from "moment"
    import TicketCreatePopup from '@/Components/dashboard/popup/TicketCreatePopup.vue'
    import {get} from 'lodash'
    
    const props = defineProps({
        userId: [Number, String],
        settings: Object
    })
    const showPopup = ref(false)
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
            title: 'Guest list',
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
    })

    const updateEventDate = () =>  {
        // activeComponent.value = 'EventDetail'
        handleComponent(navList.value[0]);
        setTimeout(() => {
            let el = document.querySelector('.scroll_target');
            el.scrollIntoView({behavior: 'smooth'});
        }, 100);
    }

    const handleComponent = (item) => {
        activeComponent.value = item.component
        navList.value.forEach(content => {
            content.isActive = item.component == content.component
        })
    }
</script>


<style scoped>
.main-heading{
    height: 300px !important;
}
@media all and (max-width: 680px){
    .main-heading{
        padding: 20px !important;
        height: auto !important;
    }
}
</style>