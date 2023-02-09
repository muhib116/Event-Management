<template>
    <Master>
        <AuthenticatedLayout>
            <Header />
            <div class="account">
                <div class="main-heading">
                    <h1>Payments</h1>
                </div>
                <!-- 
                user_id
                event_list_id
                amount
                note
                bank_name
                bank_number
                account_name
                paypal_info
                stripe_info
                mpesa_info
                first_name
                last_name
                email
                phone
                status
                settings  
                -->
                <div class="settings--order-notification account-item">
                    <div class="shadow mt-10 rounded border-t">
                        <table class="w-full rounded">
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="px-2 text-left py-4 text-gray-700">
                                        Organizer info
                                    </th>
                                    <th scope="col" class="px-2 text-left py-4 text-gray-700">
                                        Bank info
                                    </th>
                                    <th scope="col" class="px-2 text-left py-4 text-gray-700">
                                        Status
                                    </th>
                                    <th scope="col" class="px-2 text-left py-4 text-gray-700">
                                        Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="transaction in transactions" :key="transaction.id" class="border-b">
                                    <th scope="row" class="text-left px-2 py-4 text-gray-700">
                                        <div>Name: {{ transaction.first_name }} {{ transaction.last_name }}</div>
                                        <div>Email: {{ transaction.email }}</div>
                                        <div>Phone: {{ transaction.phone }}</div>
                                    </th> 
                                    <td class="text-left px-2 py-4 text-gray-700">
                                        <div v-if="transaction.bank_name"><strong>Bank name: </strong>{{ transaction.bank_name }}</div>
                                        <div v-if="transaction.bank_number"><strong>IBAN: </strong>{{ transaction.bank_number }}</div>
                                        <div v-if="transaction.account_name"><strong>BIC: </strong>{{ transaction.account_name }}</div>
                                        <div v-if="transaction.paypal_info"><strong>Paypal info: </strong>{{ transaction.paypal_info }}</div>
                                        <div v-if="transaction.stripe_info"><strong>Stripe info: </strong>{{ transaction.stripe_info }}</div>
                                        <div v-if="transaction.mpesa_info"><strong>M-Pesa info: </strong>{{ transaction.mpesa_info }}</div>
                                    </td> 
                                    <td class="text-left">
                                        <!-- paid/progress -->
                                        <span v-if="transaction.status == 'paid'" class="bg-green-100 text-green-500 py-px px-2 rounded inline-flex gap-1 items-center">
                                            <i class="fa fa-check"></i>
                                            {{ transaction.status }}
                                        </span>
                                        <span v-else class="bg-red-100 text-red-500 py-px px-2 rounded inline-flex gap-1 items-left">
                                            {{ transaction.status }}
                                        </span>
                                    </td>
                                    <td class="text-left px-2 py-4 text-gray-700">
                                        {{ transaction.amount }} <span style="font-family: initial !important;">{{ $page.props.settings?.currency.value }}</span>
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                        <div v-if="!transactions.length" class="text-center min-h-[200px] text-orange-500 text-xl font-semibold flex items-center justify-center">
                            No payment yet
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import Header from '@/Components/dashboard/Header.vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue' 
    import Master from './Master.vue' 
    const props = defineProps({
        transactions: Array
    });
</script>