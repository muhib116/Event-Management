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
                    <div v-if="$page.props.user.type == 'admin' && !$page.props.is_paid">
                        <button @click="makePayment($page.props.user, id)" class="flex items-center gap-1 py-2 px-3 bg-red-500 text-white rounded-sm" v-if="$page.props.payout_date_over">
                            <svg v-if="pay_form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Pay now
                        </button>
                        <div class="number">{{ $page.props.next_payout_date }}</div>
                    </div>
                    <div class="number text-green-600 flex items-center flex-col" v-else>
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                        Paid
                    </div>
                    <div class="name">Next payout date</div>
                </div>
            </div>
        </div>
    </div>
    <div class="guestlist event-item " data-item="guestlist">
        <!-- eventSales -->
        <div class="shadow mt-10 rounded border-t">
            
            <table class="w-full rounded">
                <tr class="border-b">
                    <th class="px-2 py-4 text-gray-700">Ticket Name</th>
                    <th class="px-2 py-4 text-gray-700">Guest</th>
                    <th class="px-2 py-4 text-gray-700">Ticket type</th>
                    <th class="px-2 py-4 text-gray-700">Price</th>
                    <th class="px-2 py-4 text-gray-700">Quantity</th>
                    <th class="px-2 py-4 text-gray-700">Sold date</th>
                    <th class="px-2 py-4 text-gray-700">View Ticket</th>
                </tr>
                <tr
                    v-for="(data, index) in eventSales.sales" 
                    :key="index" 
                    class="border-b">
                    <td class="text-center px-2 py-4 text-gray-700">{{ data.ticket?.ticket_name }}</td>
                    <td class="text-center px-2 py-4 text-gray-700">
                        {{ data.guests?.firstName }} 
                        {{ data.guests?.lastName }}
                    </td>
                    <td class="text-center px-2 py-4 text-gray-700">{{ data.ticket_type }}</td>
                    <td class="text-center px-2 py-4 text-gray-700">{{ $page.props.settings?.currency.value }} {{ data.price }}</td>
                    <td class="text-center px-2 py-4 text-gray-700">{{ data.quantity }}</td>
                    <td class="text-center px-2 py-4 text-gray-700">{{ moment(data.created_at).format('d-M-Y H:s:i a') }}</td>
                    <td class="text-center px-2 py-4 text-gray-700">
                        <a :href="route('ticket_view', data.sales_id)" target="_blank" class="border px-3 py-2 rounded border-slate-200 relative">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted, onUpdated } from 'vue'
    import { isEmpty } from 'lodash'
    import ImageUpload from '@/Components/dashboard/event/components/ImageUpload.vue'
    import useFileUpload from '@/Components/useFileUpload.js'
    import { Link, useForm } from '@inertiajs/inertia-vue3'
    import axios from 'axios'
    import moment from 'moment'
    import { Inertia } from '@inertiajs/inertia'
    import { useToast } from "vue-toastification";
    const toast = useToast();
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
    const eventSales = ref({})
    const pay_form = useForm({});
    const makePayment = () => {
        // makePayment
        pay_form.post(route('create_transaction', {
            eventList: props.event.id,
            user: props.userId
        }), {
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

    const getBannerImage = (images) => {
        let filteredImage = images.filter(item => {
            return (item.type=='banner')
        })
        if(isEmpty(filteredImage)) return
        return (filteredImage[0].path) ? filteredImage[0].path : ''
    }
    const getBannerId = (images) => {
        let filteredImage = images.filter(item => {
            return (item.type=='banner')
        })
        if(isEmpty(filteredImage)) return null
        return (filteredImage[0].id) ? filteredImage[0].id : null
    }
    const handleImageDelete = (id) => {
        if(confirm('Are you sure to delete this image ?')){
            deleteImage(id)
            getImages(eventId.value)
        }
    }
    const getEventId = () => {
        let urlData = window.location.pathname.split('/')
        return urlData.at(-1)
    }


    onMounted(async () => {
        getImages(getEventId())
        let { data } = await axios.get(`event-sales/${getEventId()}`);
        console.log(data);
        eventSales.value = data;
    })
    onUpdated(() => {
        eventId.value = getEventId()
    })
</script>

<style lang="scss" scoped>
    
</style>