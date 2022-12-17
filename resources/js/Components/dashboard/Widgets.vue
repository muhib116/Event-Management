<template>
    <div>
        <h1 class="text-3xl font-black">Widgets</h1>
        <div class="py-4 mb-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="w-full">
                    <div class="relative flex flex-col min-w-0 break-words bg-white rounded-lg mb-6 xl:mb-0 shadow-lg">
                        <div class="flex-auto p-4">
                            <div class="flex flex-wrap">
                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">Total Event</h5>
                                    <span class="font-bold text-xl">{{ dashboard.total_event }}</span>
                                </div>
                                <div class="relative w-auto pl-4 flex-initial">
                                    <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-blueGray-500 mt-4">
                                <span class="text-emerald-500 mr-2">
                                    <i class="fas fa-arrow-down"></i> 12%
                                </span>
                                <span class="whitespace-nowrap">Since last month</span>
                            </p>
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
                            <p class="text-sm text-blueGray-500 mt-4"><span class="text-emerald-500 mr-2"><i class="fas fa-arrow-up"></i> 3.48%</span><span class="whitespace-nowrap">Since last month</span></p>
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
                            <p class="text-sm text-blueGray-500 mt-4"><span class="text-red-500 mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span><span class="whitespace-nowrap">Since last week</span></p>
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
                            <p class="text-sm text-blueGray-500 mt-4"><span class="text-orange-500 mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span><span class="whitespace-nowrap">Since yesterday</span></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script setup>
import useDashboard from '@/Pages/useDashboard';

const { dashboard } = useDashboard();

console.log(dashboard);
</script>

<style lang="scss" scoped>

</style>