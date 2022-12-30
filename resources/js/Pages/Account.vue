<template>
    <Master>
        <AuthenticatedLayout>
            <Header />

            <div class="account">
                <div class="main-heading">
                    <h1>Your account</h1>
                </div>
                <nav>
                    <div class="dropdown-container">
                        <div class="profile nav-item filter-item" :class="{ 'active': activeTab == 'profile-personal' }" @click="activeTab = 'profile-personal'">
                            Profile
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="dropdown">
                            <div class="dropdown-item filter-item " @click="activeTab = 'profile-personal'">Personal</div>
                            <div class="dropdown-item filter-item" @click="activeTab = 'profile-password'">Password</div>
                            <div class="dropdown-item filter-item" @click="activeTab = 'profile-interests'">Interests</div>
                        </div>
                    </div>
                    <div class="billing nav-item filter-item" :class="{ 'active': activeTab == 'billing' }" @click="activeTab = 'billing'">Billing</div>
                    <div class="dropdown-container">
                        <div class="profile nav-item filter-item" :class="{ 'active': activeTab == 'order-notifications' }" @click="activeTab = 'order-notifications'">
                            Settings
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="dropdown">
                            <div class="dropdown-item filter-item " @click="activeTab = 'order-notifications'">Order notifications</div>
                            <div class="dropdown-item filter-item" @click="activeTab = 'payment-settings'">Payment settings</div>
                        </div>
                    </div>
                </nav>
                <!-- Profile -->
                <form class="Profile--Personal account-item" method="POST" v-show="activeTab == 'profile-personal'" @submit.prevent="savePersonalInfo">
                    <h2>Personal Informations</h2>
                    <div class="inputs">
                        <div class="element">
                            <label for="First Name"><span class="important">*</span>First Name</label>
                            <input type="text" name="first_name" v-model="personal_info_form.first_name">
                            <div class="text-red-500" v-if="personal_info_form.errors.first_name">{{ personal_info_form.errors.first_name }}</div>
                        </div>
                        <div class="element">
                            <label for="last_name"><span class="important">*</span>Last Name</label>
                            <input type="text" id="last_name" name="last_name" v-model="personal_info_form.last_name">
                            <div class="text-red-500" v-if="personal_info_form.errors.last_name">{{ personal_info_form.errors.last_name }}</div>
                        </div>
                        <div class="element">
                            <label for="Phone number"><span class="important">*</span>Phone number</label>
                            <input type="text" name="phone" v-model="personal_info_form.phone" placeholder="+23480000000">
                            <div class="text-red-500" v-if="personal_info_form.errors.phone">{{ personal_info_form.errors.phone }}</div>
                        </div>
                    </div>
                    <div class="save">
                        <button class="button" type="submit" :disabled="personal_info_form.processing">
                            <svg v-if="personal_info_form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Save
                        </button>
                    </div>
                </form>
                <form class="Profile--Password account-item" v-show="activeTab == 'profile-password'" @submit.prevent="savePassword">
                    <h2>Update Password</h2>
                    <div class="inputs">
                        <div class="element">
                            <label><span class="important">*</span>Old password</label>
                            <input type="password" name="old_password" v-model="password_reset_info.old_password">
                            <div class="text-red-500" v-if="password_reset_info.errors.old_password">{{ password_reset_info.errors.old_password }}</div>
                        </div>
                        <div class="element">
                            <label><span class="important">*</span>New password</label>
                            <input type="password" name="password" v-model="password_reset_info.password">
                        </div>
                        <div class="element">
                            <label><span class="important">*</span>Repeat new password</label>
                            <input type="password" name="password_confirmation" v-model="password_reset_info.password_confirmation">
                            <div class="text-red-500" v-if="password_reset_info.errors.password">{{ password_reset_info.errors.password }}</div>
                        </div>
                    </div>
                    <div class="save">
                        <button class="button" type="submit" :disabled="password_reset_info.processing">
                            <svg v-if="password_reset_info.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Save
                        </button>
                    </div>
                </form>
                <form class="Profile--Interests account-item" v-show="activeTab == 'profile-interests'" @submit.prevent="saveInterest">
                    <h2>Your interests</h2>
                    <p>Select up to three categories that describe the events you organize</p>
                    <!-- desktop user interests-->
                    <div class="user-interests-desktop" id="user_interests">
                        <div class="type" v-for="item in eventsCategory" :key="item.name" :class="{ 'active': interest_form.includes(item.name) }" @click="() => handleInterest(item)">
                            <img :src="item.src" />
                            <span class="name">
                                {{ item.name }}
                            </span>
                        </div>
                    </div>
                    <div class="save">
                        <button type="submit" class="button" :disabled="interest_form_inf.processing">
                            <svg v-if="interest_form_inf.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Save
                        </button>
                    </div>
                </form>
                <!-- Billing -->
                <div class="Profile--Password account-item py-4" v-show="activeTab == 'billing'">
                    <h2>Account Informations</h2>
                    <PaymentPopup v-model="showPopup" :payment_details="payment_details" />
                    
                    <div class="flex items-center flex-wrap  justify-end" v-if="payment_details">
                        <button class="button rounded hover:bg-orange-700 py-2 px-7 bg-orange-600 text-white" @click="showPopup = true">
                            Edit payment details
                        </button>
                    </div>
                    <div class="mt-10 flex flex-wrap gap-5 justify-center" v-if="payment_details">
                        <!-- payment_details.get -->

                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="py-4 flex justify-center text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="3" y1="21" x2="21" y2="21"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                    <polyline points="5 6 12 3 19 6"></polyline>
                                    <line x1="4" y1="10" x2="4" y2="21"></line>
                                    <line x1="20" y1="10" x2="20" y2="21"></line>
                                    <line x1="8" y1="14" x2="8" y2="17"></line>
                                    <line x1="12" y1="14" x2="12" y2="17"></line>
                                    <line x1="16" y1="14" x2="16" y2="17"></line>
                                </svg>
                            </div>
                            <div class="pb-5 px-4 text-center">
                                <h5 class="mb-2 font-semibold tracking-tight text-gray-900">Bank information</h5>
                                <div class="flex flex-col">
                                    <div>
                                        <strong>Bank name:</strong> {{ payment_details.bank_name }}
                                    </div>
                                    <div>
                                        <strong>IBAN number:</strong> {{ payment_details.bank_number }}
                                    </div>
                                    <div>
                                        <strong>BIC:</strong> {{ payment_details.account_name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="payment_details.paypal_info" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="py-4 flex justify-center">
                                <img width="90" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/2560px-PayPal.svg.png" alt="">
                            </div>
                            <div class="pb-5 px-4 text-center">
                                <h5 class="mb-2 font-semibold tracking-tight text-gray-900">Paypal information</h5>
                                <div class="flex flex-col">
                                    <div>
                                        <strong>Email:</strong> {{ payment_details.paypal_info }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="payment_details.mpesa_info" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="py-4 flex justify-center">
                                <img width="90" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/M-PESA_LOGO-01.svg/1200px-M-PESA_LOGO-01.svg.png" alt="">
                            </div>
                            <div class="pb-5 px-4 text-center">
                                <h5 class="mb-2 font-semibold tracking-tight text-gray-900">Mpesa information</h5>
                                <div class="flex flex-col">
                                    <div>
                                        <strong>Email:</strong> {{ payment_details.mpesa_info }}
                                    </div>
                                </div>
                            </div>
                        </div> 
                         
                    </div>
                    <div v-else class="py-10 min-h-[300px] flex items-center justify-center flex-col gap-10">
                        <h2 class="text-xl text-black font-semibold">
                            You didn't provide any payment information
                        </h2>
                        <div class="flex items-center flex-wrap  justify-end">
                            <button class="button rounded-md hover:bg-orange-700 py-5 px-8 bg-orange-600 text-white" @click="showPopup = true">
                                <span v-if="payment_details">Edit</span>
                                <span v-else><i class="fa fa-plus"></i> Add</span>
                                payment details
                            </button>
                        </div>
                    </div>
                </div>
                <!-- settings -->
                <div class="settings--order-notification account-item" v-show="activeTab == 'order-notifications'">
                    <h2>Order Notifications</h2>
                    <p>How frequently should we send order notifications by email?</p>
                    <div class="options">
                        <div class="element">
                            <input type="radio" name="order-notification-option">
                            <label>Instantly, for each order as it comes in</label>
                        </div>
                        <div class="element">
                            <input type="radio" name="order-notification-option">
                            <label>Daily summary, a daily summary of all orders sold each day</label>
                        </div>
                        <div class="element">
                            <input type="radio" name="order-notification-option">
                            <label>Weekly summary, a weekly summary of all orders sold each week</label>
                        </div>
                        <div class="element">
                            <input type="radio" name="order-notification-option">
                            <label>I do not want to receive order notifications</label>
                        </div>
                        <!-- save -->
                        <div class="save">
                            <div class="button">Save</div>
                        </div>
                    </div>
                </div>
                <div class="settings--order-notification account-item" v-show="activeTab == 'payment-settings'">
                    <h2>Payment Settings</h2>
                    <p>How frequently should we send order notifications by email?</p>
                    <div class="options">
                        <div class="element">
                            <input type="radio" name="payment-settings-option">
                            <label>Weekly, your payouts are batched and paid once a week on friday</label>
                        </div>
                        <!-- save -->
                        <div class="save">
                            <div class="button">Save</div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<style>
.el-message {
    z-index: 9999 !important;
}
</style>
<script setup>
import { ref } from '@vue/reactivity';

import Header from '@/Components/dashboard/Header.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Master from './Master.vue';
import useEvent from './useEvent';
import "vue-toastification/dist/index.css";
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import { useToast } from "vue-toastification";
import PaymentPopup from '@/Components/dashboard/popup/PaymentPopup.vue';
import { watch } from '@vue/runtime-core';
import axios from 'axios';

const toast = useToast();

const activeTab = ref('profile-personal');
const showPopup = ref(false)
const props = defineProps({
    user: {
        type: Object,
        default: {}
    },
    payment_details: {
        type: Object,
        default: {}
    }
});
const {
    formData,
    eventsCategory
} = useEvent()

console.log(props);
const personal_info_form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    phone: props.user.phone,
});

const password_reset_info = useForm({
    old_password: '',
    password: '',
    password_confirmation: '',
});
const interest_form_inf = useForm({
    interests: props.user.interests ? props.user.interests : [],
});

const interest_form = ref(props.user.interests ? props.user.interests : []);


const handleInterest = (item) => {
    if (!interest_form.value.includes(item.name) && interest_form.value.length < 3) {
        interest_form.value.push(item.name);
    } else {
        let ind = interest_form.value.indexOf(item.name);
        if (ind > -1) {
            interest_form.value.splice(ind, 1);
        } else {
            toast.error("You can select maximum 3 categories", {
                timeout: 2000,
                position: "top-center",
            });
        }
    }
    interest_form_inf.interests = interest_form.value;
}

const saveInterest = (e) => {
    interest_form_inf.post(route('account.update_interest'), {
        onSuccess: (e) => {
            console.log(e);
            toast.success("Interest updated", {
                timeout: 2000,
                position: "top-center",
            });
        },
        onError: (e) => {
            toast.error('Opps Something worng', {
                position: "top-center",
            })
        }
    });
}
const savePassword = (e) => {
    password_reset_info.post(route('account.update_password'), {
        onSuccess: (e) => password_reset_info.reset()
    });
}

const savePersonalInfo = (e) => {
    personal_info_form.post(route('account.update_info'), {
        onSuccess: (e) => {
            toast.success('Profile update successfully', {
                position: "top-center",
            })
        },
        onError: (e) => {
            console.log(e);
            let msg = '';
            for (const m of Object.values(e)) {
                msg += `${m} \n`
            }
            toast.error(msg, {
                timeout: 2000,
                position: "top-center",
            });
        }
    });
}
function deletePersonalInfo(data) {
    if (confirm('Are you sure?')) {
        Inertia.delete(route('account.delete_info', data.id));
    }
}

</script>