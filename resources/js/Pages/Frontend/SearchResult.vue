<template>
    <Head title="Event Details" />
    <Master>
        <div class="result-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <Filter :events="events" />
                    </div>

                    <div class="col-md-9">
                        <div class="result-right">
                            <div class="result-forupr">
                                <h2>Search results for <span> “...”</span></h2>
                            </div>

                            <div class="row">
                                <div v-for="event in filteredEvents" :key="event.id" class="col-sm-6 col-xl-4 mb-4 px-0">
                                    <EventCardVue :item="event" />
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import { onMounted } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import EventCardVue from '@/Components/Frontend/components/EventCard.vue'
    import useFilter from '@/Pages/Frontend/useFilter.js'
    import Filter from '@/Components/Frontend/Search/Filter.vue'

    const props = defineProps({
        events: Array
    })

    onMounted(() => {
        events.value = props.events
    })

    const {
        events,
        rangeValue,
        getMaxPrice,
        setPriceRange,
        filteredEvents,
        filterParameter,
        getLocations,
        getCategories
    } = useFilter(props.events)

    const filterByLocation = (e) => {
        if(e.target.checked){
            let copy = [...filterParameter.value.locations]
            copy.push(e.target.value)
            filterParameter.value.locations = [...new Set(copy)]
            return
        }
        
        let myIndex = (filterParameter.value.locations.indexOf(e.target.value))
        filterParameter.value.locations.splice(myIndex, 1)
    }

    const filterByCategory = (e) => {
        if(e.target.checked){
            let copy = [...filterParameter.value.categories]
            copy.push(e.target.value)
            filterParameter.value.categories = [...new Set(copy)]
            return
        }
        
        let myIndex = (filterParameter.value.categories.indexOf(e.target.value))
        filterParameter.value.categories.splice(myIndex, 1)
    }
</script>