<template>
    <Head title="Welcome----" />

    <Master>
        <Banner />
        <SearchBar />
        <UpcomingEvents />
        <HotOffers />
        <TopSelling />
        <Arts />
        <Concerts />
    </Master>
</template>


<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import Banner from '@/Components/Frontend/Banner.vue'
    import SearchBar from '@/Components/Frontend/SearchBar.vue'
    import UpcomingEvents from '@/Components/Frontend/UpcomingEvents.vue'
    import HotOffers from '@/Components/Frontend/HotOffers.vue'
    import TopSelling from '@/Components/Frontend/TopSelling.vue'
    import Arts from '@/Components/Frontend/Arts.vue'
    import Concerts from '@/Components/Frontend/Concerts.vue'

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });
</script>