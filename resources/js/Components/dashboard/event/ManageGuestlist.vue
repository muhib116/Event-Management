<template>
    <div class="py-5 bg-white px-5 rounded-md" data-item="guestlist">
        <h4 class="font-extrabold text-2xl">Guest List</h4>
        <div class="shadow rounded border-t mt-10">
            <table class="w-full rounded">
                <tr class="border-b">
                    <th class="px-2 py-4 text-gray-700">Name</th>
                    <th class="px-2 py-4 text-gray-700">Email</th>
                    <th class="px-2 py-4 text-gray-700">Phone</th>
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
                        <div class="relative group inline-flex">
                            <button class="border px-3 py-2 rounded border-slate-200 relative">
                                <i class="fa fa-eye"></i>
                            </button>
                            <div class="absolute scale-0 transition-transform duration-200 origin-bottom-right group-hover:scale-100 bottom-0 right-full bg-white z-10 py-3 px-4 shadow-md min-w-[200px] divide-y divide-slate-300">
                                <div class="flex py-1 justify-between" v-if="data.settings?.browser">Browser: <strong>{{ data.settings?.browser }}</strong></div>
                                <div class="flex py-1 justify-between" v-if="data.ip_info?.country">Country: <strong>{{ data.ip_info?.country }}</strong></div>
                                <div class="flex py-1 justify-between" v-if="data.ip_info?.city">City: <strong>{{ data.ip_info?.city }}</strong></div>
                                <div class="flex py-1 justify-between" v-if="data.ip_info?.timezone">Timezone: <strong>{{ data.ip_info?.timezone }}</strong></div>
                                <div class="flex py-1 justify-between" v-if="data.ip_info?.postal">Postal: <strong>{{ data.ip_info?.postal }}</strong></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted, onUpdated } from 'vue'
    import useEvent from '@/Pages/useEvent'
    
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


    onMounted(async () => {
        eventGuest.value = await getEventGuest(getEventId());
    })
    onUpdated(() => {
        eventId.value = getEventId()
    })
</script>

<style lang="scss" scoped>
    
</style>