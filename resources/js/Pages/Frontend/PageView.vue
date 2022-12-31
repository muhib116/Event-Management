page
<template>
    <Head :title="`${page.title}`" />

    <Master>
        <div style="min-height: 80vh;" class="py-[100px] max-w-screen-xl mx-auto">
            <h1 class="text-black">
                {{ page.title }}
            </h1>
            <div>
                {{ page.content }}
            </div>
        </div>
    </Master>
</template>


<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Master from './Master.vue'
    import Banner from '@/Components/Frontend/Banner.vue'

    defineProps({
        page: Object,
    });
</script>