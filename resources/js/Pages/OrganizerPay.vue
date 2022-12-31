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
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Organizer info
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Bank info
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="transaction in transactions" :key="transaction.id" class="border-b">
                                    <th scope="row" class="text-center px-2 py-4 text-gray-700">
                                        <div>Name: {{ transaction.first_name }} {{ transaction.last_name }}</div>
                                        <div>Email: {{ transaction.email }}</div>
                                        <div>Phone: {{ transaction.phone }}</div>
                                    </th> 
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        <div><strong>Bank name: </strong>{{ transaction.bank_name }}</div>
                                        <div><strong>IBAN number: </strong>{{ transaction.bank_number }}</div>
                                        <div><strong>BIC: </strong>{{ transaction.account_name }}</div>
                                        <div><strong>Paypal info: </strong>{{ transaction.paypal_info }}</div>
                                        <div><strong>Stripe info: </strong>{{ transaction.stripe_info }}</div>
                                        <div><strong>M-Pesa info: </strong>{{ transaction.mpesa_info }}</div>
                                    </td> 
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        {{ transaction.amount }} {{ $page.props.settings?.currency.value }}
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
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