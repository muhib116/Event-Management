<template>
    <Head title="Payment Complete" />
    <Master>
        <LoginCheck>
            <main class="completed-wrapper">
                <div class="container">
                    <div class="completed-main">
                        <div class="completed-upper">
                            <Link :href="route('home')">Completed!</Link>
                            <img src="@/assets/frontend/images/completed.png" alt="">
                        </div>

                        <div class="completed-cnt">
                            <h2>Tickets have been sent to</h2>
                            <a v-if="!isLoading" :href="`mailto: ${userInfo.email}`">{{ userInfo.email }}</a>
                        </div>

                        <div class="resend-tickcnt">
                            <h4>Haven’t received tickets yet?</h4>
                            <Link :href="route('user.profile')">Get your ticket</Link>
                        </div>

                        <div class="completed-btm">
                            <h4>Having trouble receiving the tickets?</h4>
                            <ul>
                                <!-- <li><a href="tel: +62 21 1234 9876"><i class="fas fa-phone-alt"></i> {{ userInfo.phone }}</a></li> -->
                                <li><a v-if="!isLoading" :href="`mailto: ${userInfo.email}`"><i class="far fa-envelope"></i>{{ userInfo.email }}</a></li>
                            </ul>
                        </div>                    
                    </div>
                </div>
            </main>
        </LoginCheck>
    </Master>
</template>

<script setup>
    import useAuth from '@/useAuth';
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import { onMounted } from '@vue/runtime-core';
    import LoginCheck from './LoginCheck.vue';
    import Master from './Master.vue'

    const { 
        userInfo,
        isLoading
    } = useAuth();

    onMounted(() => {
        console.log(userInfo);
    })
</script>

<style lang="scss" scoped>

</style>