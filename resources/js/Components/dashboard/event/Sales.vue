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
                    <div class="number">-</div>
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
                    <th class="px-2 py-4 text-gray-700">Pricie</th>
                    <th class="px-2 py-4 text-gray-700">Quantity</th>
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
                    <td class="text-center px-2 py-4 text-gray-700">
                        <a :href="route('ticket_view', data.id)" target="_blank" class="border px-3 py-2 rounded border-slate-200 relative">
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
    import { Link } from '@inertiajs/inertia-vue3' 
import axios from 'axios'
    
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