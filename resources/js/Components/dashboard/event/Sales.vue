<template>
    <div class="event-page">
        <div class="sales">
            <div class="sales-container">
                <div class="column">
                    <div class="number">{{ eventSales?.ticket_sold }}</div>
                    <div class="name">Tickets sold</div>
                </div>
                <div class="column">
                    <div class="number">{{ $page.props.settings?.currency?.value }}{{ eventSales?.ticket_revenue }}</div>
                    <div class="name">Sales revenue</div>
                </div>
                <div class="column">
                    <div class="number">{{ $page.props.next_payout_date }}</div>
                    <div class="name">Next payout date</div>
                </div>
            </div>
        </div>
    </div>
    <div class="guestlist event-item " data-item="guestlist">
        <div class="shadow mt-10 rounded border-t">
            <el-table
                :data="filterTableData"
                style="width: 100%; margin-bottom: 20px"
                row-key="id"
                default-expand-all
            >
                <el-table-column prop="ticket_name" label="Ticket Name" sortable />
                <el-table-column prop="name" label="Guest" sortable />
                <el-table-column prop="ticket_type" label="Ticket type" sortable />
                <el-table-column prop="price" label="Price" sortable />
                <el-table-column prop="quantity" label="Quantity" sortable />
                <el-table-column prop="date" label="Sold date" sortable />
                <el-table-column label="View Ticket" align="right">
                    <template #header>
                        <el-input v-model="search" size="small" placeholder="Type to search" />
                    </template>
                    <template #default="scope" class="text-right">
                        <el-button 
                            size="small" 
                        >
                            <a :href="route('ticket_view', scope.row.sales_id)" target="_blank" class="border px-3 py-2 relative">
                                <i class="fa fa-eye"></i>
                            </a>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted, onUpdated, computed } from 'vue'
    import { isEmpty } from 'lodash'
    import useFileUpload from '@/Components/useFileUpload.js'
    import axios from 'axios'
    import moment from 'moment'
    
    const props = defineProps({
        editable: {
            type: Boolean,
            default: false
        },
        userId: [String, Number],
        event: Object
    });
    
    const {
        getImages,
        imageFromApi,
        deleteImage
    } = useFileUpload()

    const eventId = ref(null)
    const eventSales = ref([])
    const getData = () => {
        if(!eventSales.value?.sales) return []
        return eventSales.value.sales.map(item => {
            item.ticket_name = item.ticket.ticket_name
            item.name = item.guests.firstName+' '+item.guests.lastName
            item.date = moment(item.created_at).format('d-M-Y H:s:i a')
            return item
        })
    }

    const search = ref('')
    const filterTableData = computed(() => {
        return getData().filter((data) => {
            if(!search.value || data.name.toLowerCase().includes(search.value.toLowerCase())){
                return data
            }
        })
    })
    const getEventId = () => {
        let urlData = window.location.pathname.split('/')
        return urlData.at(-1)
    }

    onMounted(async () => {
        getImages(getEventId())
        let { data } = await axios.get(`event-sales/${getEventId()}`);
        eventSales.value = data;
    })
    onUpdated(() => {
        eventId.value = getEventId()
    })
</script>

<style lang="scss" scoped>
    
</style>