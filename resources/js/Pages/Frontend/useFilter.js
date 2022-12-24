import { ref, computed } from 'vue'
import { filter, isEmpty } from 'lodash'

export default function useFilter(events) {
    const filterParameter = ref({
        isOnline: true,
        categories: [],
        priceRange: [],
        locations: []
    })
    const filteredEvents = computed(() => 
    {
        let newList = []
        
        // event type filtering
        newList = events.filter(item => (item.eventType != 'live-event') == filterParameter.value.isOnline)
        
        console.log(newList)
        // location filtering
        if(!isEmpty(filterParameter.value.locations)){
            newList = newList.filter(item => filterParameter.value.locations.includes(item.location))
        }

        // price filtering
        if(!isEmpty(filterParameter.value.priceRange)){
            newList = newList.filter(item => _getItemWithRange(item, filterParameter.value.priceRange))
        }

        return newList
    })

    const _getItemWithRange = (item, [min_price, max_price]) => {
        // if(item.min_price >= min_price && item.max_price <= max_price){ //this condition works with ticket min and max price
        if(item.min_price >= min_price && item.min_price <= max_price){ // this condition works with only min price of ticket
            return true
        }
        return false
    }

    const getMinPrice = (events) => {
        let priceList = []
        events.forEach(item => {
            priceList.push(item.min_price)
        })

        return Math.min(...priceList)
    }
    const getMaxPrice = (events) => {
        let priceList = []
        events.forEach(item => {
            priceList.push(item.max_price)
        })

        return Math.max(...priceList)
    }

    const rangeValue = ref([getMinPrice(events), getMaxPrice(events)])
    const setPriceRange = (range) => {
        filterParameter.value.priceRange = range
    }

    const getLocations = (events) => {
        let locations = []
        events.forEach(item => {
            locations.push({
                location: item.location,
                isSelected: false
            })
        })

        return [...new Set(locations)]
    }


    // watchEffect(() => {

    // })

    return {
        rangeValue,
        getMinPrice,
        getMaxPrice,
        setPriceRange,
        filteredEvents,
        filterParameter,
        getLocations,
    }
}