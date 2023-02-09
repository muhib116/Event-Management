<template>
    <div>
        <h1 class="text-3xl font-black">Widgets</h1>
        <div class="py-4 mb-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <QRScannerTrigger />
                <div class="w-full" v-if="$page.props.user.type == 'admin'">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total organizer</h5>
                                    <span class="font-bold text-xl">{{ $page.props.total_organizer }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="text-sm text-blueGray-500 mt-4">
                                <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-down"></i> 12%
                                </span>
                                <span class="whitespace-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="w-full" v-if="$page.props.user.type == 'admin'">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total clients</h5>
                                    <span class="font-bold text-xl">{{ $page.props.total_clients }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-amber-500">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="text-sm text-blueGray-500 mt-4">
                                <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-down"></i> 12%
                                </span>
                                <span class="whitespace-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total Event</h5>
                                    <span class="font-bold text-xl">{{ dashboard.total_event }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-lime-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                            <line x1="16" y1="3" x2="16" y2="7"></line>
                                            <line x1="8" y1="3" x2="8" y2="7"></line>
                                            <line x1="4" y1="11" x2="20" y2="11"></line>
                                            <rect x="8" y="15" width="2" height="2"></rect>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="text-sm text-blueGray-500 mt-4">
                                <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-down"></i> 12%
                                </span>
                                <span class="whitespace-nowrap">Since last month</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Tickets Sold</h5>
                                    <span class="font-bold text-xl">{{ dashboard.total_sales_quantity }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"><i class="far fa-chart-bar"></i></div>
                                </div>
                            </div>
                            <!-- <p class="text-sm text-blueGray-500 mt-4"><span class="text-emerald-500 mr-2"><i class="fas fa-arrow-up"></i> 3.48%</span><span class="whitespace-nowrap">Since last month</span></p> -->
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total Sell Amount</h5>
                                    <span class="font-bold text-xl">{{ dashboard.total_sales_amount }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"><i class="fas fa-chart-pie"></i></div>
                                </div>
                            </div>
                            <!-- <p class="text-sm text-blueGray-500 mt-4"><span class="text-red-500 mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span><span class="whitespace-nowrap">Since last week</span></p> -->
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total Commission</h5>
                                    <span class="font-bold text-xl">{{ dashboard.total_commission }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="text-sm text-blueGray-500 mt-4"><span class="text-orange-500 mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span><span class="whitespace-nowrap">Since yesterday</span></p> -->
                        </div>
                    </div>
                </div>
                <div class="w-full" v-if="$page.props?.total_advertise">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total Advertise</h5>
                                    <span class="font-bold text-xl">{{ $page.props.total_advertise }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                        <i class="fa-solid fa-bullhorn"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- <p class="text-sm text-blueGray-500 mt-4">
                                <Link :href="route('advertise.index')" class="py-1 px-3 bg-orange-200 rounded">Manage</Link>
                            </p> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import useDashboard from '@/Pages/useDashboard';
import { Link, usePage } from '@inertiajs/inertia-vue3';
import QRScannerTrigger from './QRScannerTrigger.vue';

const { dashboard } = useDashboard(); 
</script>

<style lang="scss" scoped>

</style>