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
                <tr v-for="n in 10" :key="n" class="border-b">
                    <td class="pl-4">{{ n }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        Concerts
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        Live Event
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        15$
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        22-12-12, 09:15am to 22-12-12, 04:00pm
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="cursor-pointer font-black text-blue-400">Download Ticket</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
