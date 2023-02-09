<template>
    <div class="result-left me-xl-5">
        <div class="result-title">
            <h2>Filters</h2>
        </div>
        <div class="stich-btn">
            <label class="switch">
                <input type="checkbox" checked="" v-model="filterParameter.isOnline">
                <span class="slider round"></span>
            </label>
            <span class="online online-checked">
                {{ filterParameter.isOnline ? 'Offline' : 'Online' }}
            </span>
        </div>

        <div class="filter-item">
            <h4 @click="locationToggle = !locationToggle">Location <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
            <ul v-show="locationToggle" class="select-none">
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
            <h4 @click="catToggle = !catToggle">Categories <i class="fas fa-chevron-up"></i> <i class="fas fa-chevron-down"></i></h4>
            <ul v-show="catToggle" class="select-none">
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
            <h4>Price</h4>
            <ElSlider v-if="getMinPrice(events) <= getMaxPrice(events)" v-model="rangeValue" range :max="getMaxPrice(events)" @change="setPriceRange" />
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref } from 'vue'
    import useFilter from '@/Pages/Frontend/useFilter.js'

    const props = defineProps({
        events: Array
    })

    let catToggle = ref(true)
    let locationToggle = ref(true)

    const {
        rangeValue,
        getMinPrice,
        getMaxPrice,
        setPriceRange,
        filteredEvents,
        filterParameter,
        getLocations,
        getCategories,
        events
    } = useFilter()

    onMounted(() => {
        events.value = props.events
    })

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