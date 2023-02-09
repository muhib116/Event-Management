<template>
    <div class="py-5 bg-white px-5 rounded-md overflow-x-auto" data-item="guestlist">
        <h4 class="font-extrabold text-2xl">Guest List</h4>
        <div class="shadow rounded border-t mt-10 overflow-x-auto">
            <table class="w-full rounded">
                <tr class="border-b whitespace-nowrap">
                    <th class="px-2 py-4 text-gray-700">Guest Name</th>
                    <th class="px-2 py-4 text-gray-700">Email</th>
                    <th class="px-2 py-4 text-gray-700">Phone</th>
                    <th class="px-2 py-4 text-gray-700">Ticket number</th>
                    <!-- <th class="px-2 py-4 text-gray-700">Check in date</th>
                    <th class="px-2 py-4 text-gray-700">
                        Checked in/pending
                    </th> -->
                    <th class="px-2 py-4 text-gray-700">Location Info</th>
                </tr>
                <tr
                    v-for="(data, index) in eventGuest" 
                    :key="index" 
                    class="border-b">
                    <td class="text-center px-2 py-4 text-gray-700">
                        {{ data.firstName }} 
                        {{ data.lastName }}
                    </td>
                    <td class="text-center px-2 py-4 text-gray-700">{{ data.email }}</td>
                    <td class="text-center px-2 py-4 text-gray-700">{{ data.phone }}</td>

                    <td class="text-center px-2 py-4 text-gray-700">
                        <!-- Ticket number -->
                        <div class="flex flex-wrap gap-1">
                            <template v-for="(sales, index) in data.sales" :key="index">
                                <div class="flex items-start flex-wrap gap-2">
                                    
                                    <template  v-for="(number, index) in sales.ticket_number" :key="index">
                                        <span class="group relative py-0 px-2 bg-red-100 flex flex-col justify-center rounded" :class="{'bg-green-200': number.status == 'used'}">
                                            {{ number.ticket_number }}
                                            <div v-if="number.status == 'used'">
                                                {{ moment(number.updated_at).format('ddd., DD MMM. YYYY') }}
                                            </div>
                                            <div class="shadow-md scale-0 whitespace-nowrap group-hover:scale-100 absolute z-10 visible inline-block px-3 py-1 bottom-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg tooltip">
                                                Ticket name: <strong class="font-semibold">{{ sales.ticket.ticket_name }}</strong> <br>
                                                Status:
                                                <!-- <span class="w-3 h-3 inline-block rounded-full bg-red-400" :class="{'!bg-green-500': number.status == 'used'}"></span> -->
                                                <span class="text-green-600" v-if="number.status == 'used'">Checked in</span>
                                                <span v-else class="text-red-600">Pending</span>

                                            </div>
                                        </span>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </td>

                    <td class="text-center px-2 py-4 text-gray-700">
                        <div class="relative group inline-flex">
                            <button class="border px-3 py-2 rounded border-slate-200 relative" @click="viewAddress(data)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <div class="absolute scale-0 transition-transform duration-200 origin-bottom-right group-hover:scale-100 bottom-0 right-full bg-slate-50 z-10 py-1 px-2 shadow-md min-w-[100px] divide-y divide-slate-300">
                                View more
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="model fixed z-10 flex items-center justify-center w-full h-full bg-black/25 top-0 left-0" @click.self="showAddress=false" v-if="showAddress">
            <div class="transition-transform duration-200 right-full bg-white z-10 py-3 px-4 shadow-md min-w-[200px] divide-y divide-slate-300">
                <div class="flex py-1 justify-between" v-if="get(address, 'settings.browser')">Browser: <strong>{{ get(address, 'settings.browser') }}</strong></div>
                <div class="flex py-1 justify-between" v-if="get(address, 'ip_info.country')">Country: <strong>{{ get(address, 'ip_info.country') }}</strong></div>
                <div class="flex py-1 justify-between" v-if="get(address, 'ip_info.city')">City: <strong>{{ get(address, 'ip_info.city') }}</strong></div>
                <div class="flex py-1 justify-between" v-if="get(address, 'ip_info.timezone')">Timezone: <strong>{{ get(address, 'ip_info.timezone') }}</strong></div>
                <div class="flex py-1 justify-between" v-if="get(address, 'ip_info.postal')">Postal: <strong>{{ get(address, 'ip_info.postal') }}</strong></div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted, onUpdated } from 'vue'
    import useEvent from '@/Pages/useEvent'
    import moment from 'moment';
    import {get} from 'lodash';
    
    const props = defineProps({
        editable: {
            type: Boolean,
            default: false
        }
    })
    const { getEventGuest } = useEvent();

    const eventId = ref(null);
    const eventGuest = ref([]);
    const getEventId = () => {
        let urlData = window.location.pathname.split('/')
        return urlData.at(-1)
    }

    const showAddress = ref(false);
    const address = ref({});
    const viewAddress = (addr) => {
        address.value = addr;
        showAddress.value = true;
    }


    onMounted(async () => {
        eventGuest.value = await getEventGuest(getEventId());
    })
    onUpdated(() => {
        eventId.value = getEventId()
    })
</script>

<style lang="scss" scoped>
    
</style>