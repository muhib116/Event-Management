<template>
    <header class="bg-white shadow-md z-10 sticky top-0">
        <Link :href="route('dashboard')">
            <img src="../../assets/images/logo.svg" alt="Logo Image" class="logo">
        </Link>
        <div class="account-container">
            <div class="account"> EK </div>
            <div class="nav">
                <Link :href="route('live.account')">Account</Link>
                <Link :href="route('dashboard')">Events</Link>
                <Link :href="route('advertise.index')">Advertise</Link>
                <a href="#">Help</a>
                <a href="#">Log out</a>
            </div>
        </div>
    </header>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<style lang="scss" scoped>

</style>