<template>
    <header class="bg-white shadow-md z-10 sticky top-0">
        <Link :href="route('dashboard')" class="flex items-center">
            <img :src="get($page.props, 'settings.logo_image.value')" alt="Logo Image" class="logo">
        </Link>
        <div class="account-container">
            <div class="account"> 
                <img :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user.first_name}&rounded=true&background=172853&color=fff`" alt="">
            </div>
            <div class="nav">
                <Link :href="route('live.account')">Account</Link>
                <Link :href="route('dashboard')">Events</Link>
                <Link :href="route('organizer_payment')">Payments</Link>
                <Link v-if="$page.props.auth.user.type=='admin'" :href="route('advertise.index')">Advertise</Link>
                <Link v-if="$page.props.auth.user.type=='admin'" :href="route('settings.index')">Settings</Link>
                <Link v-if="$page.props.auth.user.type=='admin'" :href="route('page')">Pages</Link> 
                <a href="#" @click="logOutUser()">Log out</a>
            </div>
        </div>
    </header>
</template>

<script setup>
import { get } from 'lodash'
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';

function logOutUser() {
    Inertia.post(route('logout'));
}
</script>

<style lang="scss" scoped>

</style>