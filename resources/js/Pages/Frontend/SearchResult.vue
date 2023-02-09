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
                        <div class="result-right min-h-[55vh]">
                            <div class="result-forupr">
                                <h2>Search results</h2>
                            </div>

                            <div v-if="!isEmpty(event_list)" class="row">
                                <div v-for="event in event_list" :key="event.id" class="col-sm-6 col-xl-4 mb-4 px-0">
                                    <EventCardVue :item="event" />
                                </div>
                            </div>
                            <div v-else class="opacity-40">
                                No result found
                            </div>
                            <div class="flex justify-center" v-if="filteredEvents.length>page_size">
                                <el-pagination 
                                    v-model:current-page="page_number" 
                                    background layout="prev, pager, next" 
                                    :total="filteredEvents.length"
                                    :page-size="page_size"
                                    :pager-count="4"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import { computed, onMounted, ref } from 'vue'
    import { isEmpty } from 'lodash'
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


    const page_number = ref(1);
    const page_size = ref(12); 
    const event_list = computed(()=> {
        let start_point = (page_number.value -1) * page_size.value;
        let end_point = start_point + page_size.value;
        return filteredEvents.value.slice(start_point, end_point);
    });
</script>


<style>
.el-pagination.is-background .btn-next.is-active, .el-pagination.is-background .btn-prev.is-active, .el-pagination.is-background .el-pager li.is-active {
    background-color: #172853 !important;
}
</style>