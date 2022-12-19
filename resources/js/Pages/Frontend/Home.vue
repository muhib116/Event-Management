<template>
    <Head title="Welcome----" />

    <Master>
        <Banner />
        <SearchBar />
        <EventCarousel :data="upcoming_events" title="Upcoming Events" />
        <OfferCarousel :data="featured_advertise" />
        <!-- <HotOffers :data="featured_advertise" /> -->
        <TopSelling />
        <div
            v-for="(events, key, index) in category_events"
            :key="index"
        >
            <EventCarousel :data="events" :title="key" />
        </div>
    <!-- 
            <EventCarousel :data="arts_events" title="Browse Arts" />
        <EventCarousel :data="concerts_events" title="Browse Concerts" /> -->
    </Master>
</template>


<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import Banner from '@/Components/Frontend/Banner.vue'
    import SearchBar from '@/Components/Frontend/SearchBar.vue'
    import EventCarousel from '@/Components/Frontend/EventCarousel.vue'
    import HotOffers from '@/Components/Frontend/HotOffers.vue'
    import TopSelling from '@/Components/Frontend/TopSelling.vue'
import OfferCarousel from '@/Components/Frontend/OfferCarousel.vue'

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        upcoming_events: Array,
        arts_events: Array,
        concerts_events: Array,
        featured_advertise: Array,
        category_events: Object,
    });
</script>