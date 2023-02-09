<template>
    <Head :title="get($page.props, 'site_name.value')" />
    <div class="admin">
        <slot></slot>
    </div>
</template>

<script setup>
    import "@/assets/backend/styles/css/main.css"
    import { Head } from '@inertiajs/inertia-vue3';
    import {get} from 'lodash'
</script>