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
                        <div class="profile nav-item filter-item" :class="{'active': activeTab=='profile-personal'}" @click="activeTab='profile-personal'">
                            Profile
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="dropdown">
                            <div class="dropdown-item filter-item " @click="activeTab='profile-personal'">Personal</div>
                            <div class="dropdown-item filter-item" @click="activeTab='profile-password'">Password</div>
                            <div class="dropdown-item filter-item" @click="activeTab='profile-interests'">Interests</div>
                        </div>
                    </div>
                    <div class="billing nav-item filter-item" :class="{'active': activeTab=='billing'}" @click="activeTab='billing'">Billing</div>
                    <div class="dropdown-container">
                        <div class="profile nav-item filter-item" :class="{'active': activeTab=='order-notifications'}" @click="activeTab='order-notifications'">
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
                        <div 
                            class="type"
                            v-for="item in eventsCategory" 
                            :key="item.name"
                            :class="{'active': interest_form.includes(item.name)}"
                            @click="() => handleInterest(item)"
                        >
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
                    <div class="flex items-center flex-wrap  justify-between">
                        <h2>Account Informations</h2>
                        <button class="button rounded hover:bg-orange-700 py-2 px-7 bg-orange-600 text-white" @click="showPopup = true">
                            Add payment details
                        </button>
                    </div>
                    <PaymentPopup
                        v-model="showPopup"
                    />

                    <div class="mt-10">
                        payment_details.get
                        <div class="shadow mt-10 rounded border-t">
                            <table class="w-full rounded">
                                <tr class="border-b">
                                    <th class="px-2 py-4 text-gray-700 capitalize">Organizer name</th>
                                    <th class="px-2 py-4 text-gray-700 capitalize">bank name</th>
                                    <th class="px-2 py-4 text-gray-700 capitalize">bank number</th>
                                    <th class="px-2 py-4 text-gray-700 capitalize">account name</th>
                                    <th class="px-2 py-4 text-gray-700 capitalize">paypal info</th>
                                    <th class="px-2 py-4 text-gray-700 capitalize">stripe info</th>
                                    <th class="px-2 py-4 text-gray-700 capitalize">mpesa info</th>
                                    <th class="px-2 py-4 text-gray-700 capitalize">Action</th>
                                </tr>
                                <tr
                                    v-for="data in payment_details" 
                                    :key="data.id" 
                                    class="border-b">
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        {{ data.organizer?.first_name }}
                                        {{ data.organizer?.last_name }}
                                    </td>
                                    <td class="text-center px-2 py-4 text-gray-700">{{ data.bank_name }}</td>
                                    <td class="text-center px-2 py-4 text-gray-700">{{ data.bank_number }}</td>
                                    <td class="text-center px-2 py-4 text-gray-700">{{ data.account_name }}</td>
                                    <td class="text-center px-2 py-4 text-gray-700">{{ data.paypal_info }}</td>
                                    <td class="text-center px-2 py-4 text-gray-700">{{ data.stripe_info }}</td>
                                    <td class="text-center px-2 py-4 text-gray-700">{{ data.mpesa_info }}</td>
                                    <td class="text-center px-2 py-4 text-gray-700"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- settings -->
                <div class="settings--order-notification account-item" v-show="activeTab == 'order-notifications'">
                    <h2>Order Notifications</h2>
                    <p>How frequently should we send order notifications by email?</p>
                    <div class="options">
                        <div class="element">
                            <input type="radio" name="order-notification-option" >
                            <label>Instantly, for each order as it comes in</label>
                        </div>
                        <div class="element">
                            <input type="radio" name="order-notification-option" >
                            <label>Daily summary, a daily summary of all orders sold each day</label>
                        </div>
                        <div class="element">
                            <input type="radio" name="order-notification-option" >
                            <label>Weekly summary, a weekly summary of all orders sold each week</label>
                        </div>
                        <div class="element">
                            <input type="radio" name="order-notification-option" >
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
                            <input type="radio" name="payment-settings-option" >
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
        type: Array,
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


</script>