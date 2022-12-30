<template>
    <div class="overflow-auto border border-b-0 w-full">
        <table class="w-full text-sm text-black">
            <thead
                class="bg-gray-100 uppercase font-medium"
            >
                <tr class="border-b">
                    <th></th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left tracking-wider"
                    >
                        Ticket Name
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left tracking-wider"
                    >
                        Ticket Type
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left tracking-wider"
                    >
                        Ticket price
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left tracking-wider"
                    >
                        Quantity
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 tracking-wider text-center"
                    >
                        Ticket numbers
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 tracking-wider text-center"
                    >
                        Date
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 text-left tracking-wider"
                    >
                        Download
                    </th>
                </tr>
            </thead>

            <tbody class="">
                <tr v-for="(item, index) in history" :key="index" class="border-b">
                    <td class="pl-4">{{ ++index }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ item.ticket?.ticket_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ item.ticket?.ticketType }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ item.ticket?.price }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ item.quantity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex flex-wrap gap-[2px]">
                            <template v-for="ticket_number in item.ticket_number" :key="ticket_number.id">
                                <span class="inline-flex bg-green-100 px-1 rounded-md border border-green-700 text-green-800 text-xs">
                                    {{ ticket_number.ticket_number }}
                                </span>
                            </template>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        {{ item.ticket?.event.start_date }} {{ item.ticket?.event.start_time }} <br> to <br>
                        {{ item.ticket?.event.end_date }} {{ item.ticket?.event.end_time }}
                        <!-- 22-12-12, 09:15am to 22-12-12, 04:00pm -->
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <!-- <a :href="route('ticket_view', data.id)" target="_blank" class="border px-3 py-2 rounded border-slate-200 relative">
                            <i class="fa fa-eye"></i>
                        </a> -->
                        <a :href="route('ticket_view', item.sales_id)" class="cursor-pointer font-black text-blue-400">Download Ticket</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { onMounted } from 'vue'
const props = defineProps({
    history: Array
});

onMounted(() =>{
    console.log('test')
});


</script>

<style lang="scss" scoped></style>
