<template>
    <Master>
        <AuthenticatedLayout>
            <Header />

            <div class="account">
                <div class="main-heading">
                    <h1>Settings</h1>
                </div>
                <!-- settings -->
                <form class="container gap-6 mx-auto mt-10 grid grid-cols-1 md:grid-cols-2">
                    <label for="" class="py-3 px-2">
                        <div>Currency</div>
                        <input type="text" class="border-slate-400 w-full rounded" placeholder="Currency Symble" />
                    </label>
                    <label for="" class="py-3 px-2">
                        <div>Commission</div>
                        <input type="number" class="border-slate-400 w-full rounded" placeholder="Sales commission" />
                    </label>
                </form>
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

<style>
.el-message {
    z-index: 9999 !important;
}

.event-details textarea {
    color: var(--dark);
    background-color: #fff;
    background-image: none;
    border-radius: 6px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    height: 140px;
    outline: 0;
    padding: 15px 15px;
    transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
    width: 100%;
}

.event-details textarea:focus {
    border-color: var(--normal-orange);
}
</style>
<script setup>
import { ref } from '@vue/reactivity';

import Header from '@/Components/dashboard/Header.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Master from './Master.vue';
import "vue-toastification/dist/index.css";
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import { useToast } from "vue-toastification";
import { onMounted } from '@vue/runtime-core';
const toast = useToast();

const props = defineProps({
    settings: {
        type: Object,
        default: {}
    }
});


</script>