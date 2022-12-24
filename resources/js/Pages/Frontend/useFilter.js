import { ref, computed } from 'vue'
import { isEmpty } from 'lodash'

const events = ref([])
const filterParameter = ref({
    isOnline: true,
    categories: [],
    priceRange: [],
    locations: [],
    categories: []
})

const _getItemWithRange = (item, [min_price, max_price]) => {
    // if(item.min_price >= min_price && item.max_price <= max_price){ //this condition works with ticket min and max price
    if(item.min_price >= min_price && item.min_price <= max_price){ // this condition works with only min price of ticket
        return true
    }
    return false
}

const filteredEvents = computed(() => 
{
    let newList = []
    
    // event type filtering
    newList = events.value.filter(item => (item.eventType != 'live-event') == filterParameter.value.isOnline)
    
    // location filtering
    if(!isEmpty(filterParameter.value.locations)){
        newList = newList.filter(item => filterParameter.value.locations.includes(item.location))
    }
    
    // category filtering
    if(!isEmpty(filterParameter.value.categories)){
        newList = newList.filter(item => filterParameter.value.categories.includes(item.eventCategory))
    }

    // price filtering
    if(!isEmpty(filterParameter.value.priceRange)){
        newList = newList.filter(item => _getItemWithRange(item, filterParameter.value.priceRange))
    }

    return newList
})

export default function useFilter()
{
    const getMinPrice = (localEvents) => {
        let priceList = []
        localEvents.forEach(item => {
            priceList.push(Number(item.min_price))
        })
        

        return !isEmpty(priceList) ? Math.min(...priceList) : 0
    }
    const getMaxPrice = (localEvents) => {
        let priceList = []

        localEvents.forEach(item => {
            priceList.push(Number(item.max_price))
        })

        return !isEmpty(priceList) ? Math.max(...priceList) : 0
    }

    const rangeValue = ref([getMinPrice(filteredEvents.value), getMaxPrice(filteredEvents.value)])
    const setPriceRange = (range) => {
        filterParameter.value.priceRange = range
    }

    const getLocations = (localEvents) => {
        let locations = []
        localEvents.forEach(item => {
            locations.push(item.location)
        })

        return [...new Set(locations)]
    }

    const getCategories = (localEvents) => {
        let categories = []
        localEvents.forEach(item => {
            categories.push(item.eventCategory)
        })

        return [...new Set(categories)]
    }

    
    return {
        events,
        rangeValue,
        getMinPrice,
        getMaxPrice,
        setPriceRange,
        filteredEvents,
        filterParameter,
        getLocations,
        getCategories,
    }
}