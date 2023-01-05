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
                    <div v-if="$page.props.user.type == 'admin' && $page.props.is_paid?.status == 'progress'">
                        <button @click="makePayment($page.props.user, id)" class="flex items-center gap-1 py-2 px-3 bg-red-500 text-white rounded-sm" v-if="$page.props.payout_date_over">
                            <svg v-if="pay_form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Pay now
                        </button>
                    </div>
                    <div v-if="$page.props.user.type == 'organizer' && !$page.props.is_paid && $page.props.has_payment_details">
                        <button @click="makePayment($page.props.user, id)" class="flex items-center gap-1 py-2 px-3 bg-red-500 text-white rounded-sm" v-if="$page.props.payout_date_over">
                            <svg v-if="pay_form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Request for payment
                        </button>
                    </div>
                    <div class="text-center" v-if="!$page.props.is_paid">
                        <div class="number">{{ $page.props.next_payout_date }}</div>
                        <div class="name">Next payout date</div>
                    </div>
                    <!-- Payment in progress -->
                    <div class="number text-green-600 flex text-sm items-center flex-col" v-if="$page.props.is_paid">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                        <!-- Paid -->
                        <span v-if="$page.props.is_paid?.status == 'progress'">Payment in progress</span>
                        <span v-else>Paid</span>
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
    </div>
</template>

<script setup>
    import axios from 'axios'
    import { ref, onMounted, onUpdated, computed } from 'vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import { useToast } from "vue-toastification";
    import useFileUpload from '@/Components/useFileUpload.js' 
    import moment from 'moment'
    

    const toast = useToast();
    
    const props = defineProps({
        editable: {
            type: Boolean,
            default: false
        },
        userId: [String, Number],
        event: Object
    });
    
    const {getImages} = useFileUpload()
    const eventId = ref(null)
    const pay_form = useForm({});
    const makePayment = () => {
        // makePayment
        pay_form.post(route('create_transaction', {
            eventList: props.event.id,
            user: props.userId
        }),
        {
            onSuccess(pg) {
                if (pg.props.flash?.error) {
                    toast.error(pg.props.flash?.error);
                }
                if (pg.props.flash?.success) {
                    toast.success(pg.props.flash?.success)
                }
            },
        });
    }
    const eventSales = ref([])
    const getData = () => {
        if(!eventSales.value?.sales) return []
        return eventSales.value.sales.map(item => {
            item.ticket_name = item.ticket.ticket_name
            item.name = item.guests.firstName+' '+item.guests.lastName
            item.date = moment(item.created_at).format('d-MMM-YYYY HH:ss a')
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
        return urlData.at(-1);
    }

    onMounted(async () => {
        getImages(getEventId())
        let { data } = await axios.get(`event-sales/${getEventId()}`);
        eventSales.value = data;
    });
    // onUpdated(() => {
    //     eventId.value = getEventId()
    // })
</script>

<style scoped>
    
</style>