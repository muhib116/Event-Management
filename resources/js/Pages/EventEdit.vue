<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="account">
                <div class="main-heading">
                    <h1>Event Name</h1>
                </div>
            </div>
            <nav>
                <div class="dropdown-container">
                    <div class="profile nav-item filter-item active"> 
                        Detail
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
                <div class="billing nav-item filter-item">Tickets</div>
                <div class="billing nav-item filter-item">Appearance</div>
                <div class="billing nav-item filter-item">Manage Guest list</div>
                <div class="billing nav-item filter-item">Sales</div>
            </nav>

            <div class="Profile--Personal account-item">
                {{ components[activeComponent] }}
                <components :is="components[activeComponent]"></components>
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import { ref } from 'vue'
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import EventDetail from '@/Components/dashboard/event/EventDetail.vue'
    import Appearance from '@/Components/dashboard/event/Appearance.vue'
    import Tickets from '@/Components/dashboard/AllTickets/Tickets.vue'
    import Master from './Master.vue'

    const activeComponent = ref('EventDetail')
    const components = {
        EventDetail,
        Appearance,
        Tickets
    }

    const navList = [
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
    ]
</script>