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
                            <input type="text" name="first_name" v-model="form.first_name">
                            <div class="text-red-500" v-if="form.errors.first_name">{{ form.errors.first_name }}</div>
                        </div>
                        <div class="element">
                            <label for="last_name"><span class="important">*</span>Last Name</label>
                            <input type="text" id="last_name" name="last_name" v-model="form.last_name">
                            <div class="text-red-500" v-if="form.errors.last_name">{{ form.errors.last_name }}</div>
                        </div>
                        <div class="element">
                            <label for="Phone number"><span class="important">*</span>Phone number</label>
                            <input type="text" name="phone" v-model="form.phone" placeholder="+23480000000">
                            <div class="text-red-500" v-if="form.errors.phone">{{ form.errors.phone }}</div>
                        </div>
                    </div>
                    <div class="save">
                        <button class="button" type="submit">Save</button>
                    </div>
                </form>
                <div class="Profile--Password account-item" v-show="activeTab == 'profile-password'">
                    <h2>Update Password</h2>
                    <div class="inputs">
                        <div class="element">
                            <label><span class="important">*</span>Old password</label>
                            <input type="password" name="Old password">
                        </div>
                        <div class="element">
                            <label><span class="important">*</span>New password</label>
                            <input type="password" name="New password">
                        </div>
                        <div class="element">
                            <label><span class="important">*</span>Repeat new password</label>
                            <input type="password" name="Repeat new password" >
                        </div>
                    </div>
                    <div class="save">
                        <div class="button">Save</div>
                    </div>
                </div>
                <div class="Profile--Interests account-item" v-show="activeTab == 'profile-interests'">
                    <h2>Your interests</h2>
                    <p>Select up to three categories that describe the events you organize</p>
                    <!-- desktop user interests-->
                    <div class="user-interests-desktop" id="user_interests">
                        <div class="type">
                            <object data="../../assets/images/svgs/art.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/business.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type active">
                            <object data="../../assets/images/svgs/career.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type active">
                            <object data="../../assets/images/svgs/aid.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type active">
                            <object data="../../assets/images/svgs/5.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/6.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/7.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/8.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/9.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/10.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/11.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/12.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/13.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/14.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/15.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/16.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                        <div class="type">
                            <object data="../../assets/images/svgs/17.svg"></object>
                            <span class="name">Arts & Culture</span>
                        </div>
                    </div>
                    <!-- mobile user interests-->
                    <div class="user-interests-mobile" id="user_interests">
                        <!-- first -->
                        <select>
                            <option value="arts & culture">arts & culture</option>
                            <option value="business">business</option>
                            <option value="career">career</option>
                            <option value="charity & aid">charity & aid</option>
                            <option value="children & youth">children & youth</option>
                            <option value="community">community</option>
                            <option value="fashion & design">fashion & design</option>
                            <option value="food & drink">food & drink</option>
                            <option value="goverment">goverment</option>
                            <option value="investments">investments</option>
                            <option value="media & film">media & film</option>
                            <option value="music & performances">music & performances</option>
                            <option value="schools & education">schools & education</option>
                            <option value="spirituality & religion">spirituality & religion</option>
                            <option value="sports & fitness">sports & fitness</option>
                            <option value="startups & smallbusiness">startups & smallbusiness</option>
                            <option value="technology & science">technology & science</option>
                        </select>
                        <!-- second -->
                        <select>
                            <option value="charity & aid">charity & aid</option>
                            <option value="arts & culture">arts & culture</option>
                            <option value="business">business</option>
                            <option value="career">career</option>
                            <option value="children & youth">children & youth</option>
                            <option value="community">community</option>
                            <option value="fashion & design">fashion & design</option>
                            <option value="food & drink">food & drink</option>
                            <option value="goverment">goverment</option>
                            <option value="investments">investments</option>
                            <option value="media & film">media & film</option>
                            <option value="music & performances">music & performances</option>
                            <option value="schools & education">schools & education</option>
                            <option value="spirituality & religion">spirituality & religion</option>
                            <option value="sports & fitness">sports & fitness</option>
                            <option value="startups & smallbusiness">startups & smallbusiness</option>
                            <option value="technology & science">technology & science</option>
                        </select>
                        <!-- third -->
                        <select>
                            <option value="children & youth">children & youth</option>
                            <option value="arts & culture">arts & culture</option>
                            <option value="business">business</option>
                            <option value="career">career</option>
                            <option value="charity & aid">charity & aid</option>
                            <option value="community">community</option>
                            <option value="fashion & design">fashion & design</option>
                            <option value="food & drink">food & drink</option>
                            <option value="goverment">goverment</option>
                            <option value="investments">investments</option>
                            <option value="media & film">media & film</option>
                            <option value="music & performances">music & performances</option>
                            <option value="schools & education">schools & education</option>
                            <option value="spirituality & religion">spirituality & religion</option>
                            <option value="sports & fitness">sports & fitness</option>
                            <option value="startups & smallbusiness">startups & smallbusiness</option>
                            <option value="technology & science">technology & science</option>
                        </select>
                    </div>
                    <div class="save">
                        <div class="button">Save</div>
                    </div>
                </div>
                <!-- Billing -->
                <div class="Billing account-item" v-show="activeTab == 'billing'">
                    <h2>Personal Informations</h2>
                    <div class="current-plan">
                        <div class="left">
                            <h3>Tix Free <i class="fa-solid fa-circle-exclamation"></i></h3>
                            <p>
                                <strong>You are on the free plan and charged nothing.</strong> <br>
                                Subscribe to Pro to get everything on the free plan plus lower transaction processing fees on paid tickets and more event management tools
                            </p>
                        </div>
                        <div class="right">
                            <div class="button">Upgrade Pro</div>
                        </div>
                    </div>
                    <div class="invoices">
                        <h2>Your invoices</h2>
                        <p>You have no invoice history yet.</p>
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


<script setup>
import { ref } from '@vue/reactivity';
import Header from '@/Components/dashboard/Header.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Master from './Master.vue';
import useEvent from './useEvent';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';

const activeTab = ref('profile-personal');

const props = defineProps({
    user: {
        type: Object
    }
});
const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    phone: props.user.phone
})

const {
    formData
} = useEvent()
formData.value = props.user;
console.log(formData.value);
const handleForm = (data) => {
    // formData.value.eventType = props.eventType
    // activeComponent.value = CreateTicket
    console.log(formData.value)
    // console.log(progressStep);
}

const savePersonalInfo = (e) => {
    form.post(route('account.update_info'));
    // const formEntries = new FormData(e.target).entries();
    // const json = Object.assign(...Array.from(formEntries, ([x,y]) => ({[x]:y})));
    // Inertia.post(route('account.update_info'),json);
}


</script>