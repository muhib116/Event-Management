<template>
    <Head title="Payment Method" />
    <Master>
        <LoginCheck>
            <div class="header-area">
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
                                <button class="px-4 py-1 text-left hover:bg-gray-50">Profile</button>
                                <button class="px-4 py-1 text-left hover:bg-gray-50">History</button>
                                <button class="px-4 py-1 text-left hover:bg-gray-50" @click="logout">Logout</button>
                            </div>
                        </div>
                        <div class="rightSide w-full p-4">
                            <!-- <component :is="History" /> -->
                            <History
                                :history="history"
                            />
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
    const { 
        logout,
        isAuthenticated,
        userInfo,
        isLoading
     } = useAuth();

    const history = ref([]);

    watchEffect(async ()=> {
        // console.log(isLoading);
        if (!isLoading.value) {
            console.log('in');
            let getHistory = await axios.get(route('get.history', userInfo.value.email)).then(res => res.data);
            history.value = getHistory.ticket_sales;
        }
    });
</script>

<style lang="scss" scoped>

</style>