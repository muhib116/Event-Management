<template>
    <Head title="Event Details" />
    <Master>
        <div class="result-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <Filter :events="events" />
                        <!-- <div class="result-left me-xl-5">
                            <div class="result-title">
                                <h2>Filters</h2>
                            </div>
                            <div class="stich-btn">
                                <label class="switch">
                                    <input type="checkbox" checked="" v-model="filterParameter.isOnline">
                                    <span class="slider round"></span>
                                </label>
                                <span class="online online-checked">Online</span>
                            </div>

                            <div class="filter-item">
                                <h4>Location <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
                                <ul class="select-none">
                                    <li v-for="location in getLocations(events)" :key="`location-${location}`">
                                        <div class="form-group">
                                            <input 
                                                type="checkbox" 
                                                :id="location"  
                                                :value="location"
                                                @change="(e) => filterByLocation(e)"
                                            >
                                            <label :for="location">{{ location }}</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="filter-item">
                                <h4>Categories <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
                                <ul class="select-none">
                                    <li v-for="category in getCategories(events)" :key="`location-${category}`">
                                        <div class="form-group">
                                            <input 
                                                type="checkbox" 
                                                :id="category"  
                                                :value="category"
                                                @change="(e) => filterByCategory(e)"
                                            >
                                            <label :for="category">{{ category }}</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="filter-item border-0">
                                <h4>Price <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
                                <ElSlider v-model="rangeValue" range :max="getMaxPrice(filteredEvents)" @change="setPriceRange" />
                            </div>
                        </div> -->
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