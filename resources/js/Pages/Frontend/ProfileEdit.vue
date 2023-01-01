<template>
    <Head title="Payment Method" />
    <Master>
        <LoginCheck>
            <div class="header-area min-h-[78vh]">
                <div class="container bg-white h-full px-0">
                    <div class="flex h-full border">
                        <div class="leftSide min-w-[250px] h-full bg-white py-10">
                            <div class="px-4">
                                <img
                                    :src="userInfo.image" 
                                    alt="" 
                                    class="w-15 h-15 rounded-full shadow border mx-auto"
                                />
                                <p class="text-center mt-2 font-black mb-0 opacity-80">
                                    {{ userInfo.name }}
                                </p>
                                <p class="mt-0 text-center text-sm opacity-75">
                                    {{ userInfo.email }}
                                </p>
                            </div>
                            <div class="mt-0 grid">
                                <Link :class="{'!text-red-500': $page.component == 'Frontend/ProfileEdit'}" :href="route('user.profile.edit')" class="px-4 text-black py-1 text-left hover:bg-gray-50">Profile</Link>
                                <Link :class="{'!text-red-500': $page.component == 'Frontend/Profile'}" :href="route('user.profile')" class="px-4 py-1 text-black text-left hover:bg-gray-50">History</Link>
                                <button class="px-4 py-1 text-left hover:bg-gray-50" @click="logout">Logout</button>
                            </div>
                        </div>
                        <div class="rightSide w-full p-4">
                            <!-- <component :is="History" /> -->
                            <div class="">
                                <div class="element mb-6 flex flex-col gap-2">
                                    <label>Name</label>
                                    <input type="text" :value="userForm.name" class="rounded border" disabled/>
                                </div>
                                <div class="element mb-6 flex flex-col gap-2">
                                    <label>Email</label>
                                    <input type="text"  :value="userForm.email" class="rounded border" disabled />
                                </div>
                                <div class="element mb-6 flex flex-col gap-2">
                                    <label>Phone</label>
                                    <input type="text"  v-model="userForm.phone" class="rounded border" />
                                </div>
                                <div class="element mb-6 flex flex-col gap-2">
                                    <label>Address</label>
                                    <!-- <input type="text"   class="rounded border" /> -->
                                    <textarea rows="5" v-model="userForm.settings.address" class="rounded border"></textarea>
                                </div>
                                <button @click="saveInfo()" class="py-2 flex items-center px-4 rounded bg-blue-500 text-white active:scale-95">
                                    <svg v-if="userForm.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </LoginCheck>
    </Master>
</template>

<script setup>
    import Master from './Master.vue'
    import useAuth from '@/useAuth.js'
    import History from '@/Components/Frontend/profile/History.vue'
    import LoginCheck from './LoginCheck.vue';
    import { onMounted, ref, watchEffect } from 'vue';
    import axios from 'axios';
    import { Link, useForm } from '@inertiajs/inertia-vue3';
    import { useToast } from 'vue-toastification';
    const toast = useToast();
    const { 
        logout,
        isAuthenticated,
        userInfo,
        isLoading
     } = useAuth();

     const userForm = useForm({
        email: '',
        name: '',
        phone: '',
        settings: {
            address: null
        },
     });

    const history = ref([]);

    function saveInfo() {
        userForm.post(route('user.profile.update'), {
            onSuccess(e) {
                if (e.props.flash?.success) {
                    toast.success(e.props.flash?.success);
                }
            },
            onError() {}
        });
    }

    watchEffect(async ()=> {
        // console.log(isLoading);
        if (!isLoading.value) {
            console.log('in');
            let getHistory = await axios.get(route('get.history', userInfo.value.email)).then(res => res.data);
            history.value = getHistory.ticket_sales;
            let getUser = await axios.get(route('user.get_profile', userInfo.value.email)).then(res => res.data);
            if (getUser) {
                console.log(getUser);
                userForm.name = getUser.firstName;
                userForm.email = getUser.email;
                userForm.phone = getUser.phone;
                userForm.settings.address = getUser.settings?.address;
            }
            if (getUser == 'not_found') {
                userForm.name = userInfo.value.name;
                userForm.email = userInfo.value.email;
            }
        }
    });
</script>

<style lang="scss" scoped>

</style>