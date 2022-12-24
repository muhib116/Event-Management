<template>
    <Head title="Event Details" />
    <Master>
        <div class="result-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="result-left me-xl-5">
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
                                    <li v-for="(item, index) in getLocations(events)" :key="`location-${item}`">
                                        <div class="form-group">
                                            <input 
                                                type="checkbox" 
                                                :id="item.location"  
                                                :value="item.location"
                                                @change="(e) => filterByLocation(e, index)"
                                            >
                                            <label :for="item.location">{{ item.location }}</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- <div class="filter-item">
                                <h4>Categories <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
                                <form action="#" method="POST">
                                    <ul>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck6">
                                                <label for="ck6">Concert</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck7">
                                                <label for="ck7">Arts</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck8" checked>
                                                <label for="ck8">Conference</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" id="ck9">
                                                <label for="ck9">Movies</label>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div> -->

                            <div class="filter-item border-0">
                                <h4>Price <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
                                <ElSlider v-model="rangeValue" range :max="getMaxPrice(events)" @change="setPriceRange" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="result-right">
                            <div class="result-forupr">
                                <h2>Search results for <span> “...”</span></h2>
                            </div>

                            <div class="row">
                                <div v-for="event in filteredEvents" :key="event.id" class="col-sm-6 col-xl-4 mb-4">
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
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import EventCardVue from '@/Components/Frontend/components/EventCard.vue'
    import useFilter from '@/Pages/Frontend/useFilter.js'

    const props = defineProps({
        events: Array
    })

    const {
        rangeValue,
        getMaxPrice,
        setPriceRange,
        filteredEvents,
        filterParameter,
        getLocations
    } = useFilter(props.events)

    const filterByLocation = (e, index) => {
        if(e.target.checked){
            let copy = [...filterParameter.value.locations]
            copy.push(e.target.value)
            filterParameter.value.locations = [...new Set(copy)]
            return
        }
        
        let myIndex = (filterParameter.value.locations.indexOf(e.target.value))
        filterParameter.value.locations.splice(myIndex, 1)
    }
</script>