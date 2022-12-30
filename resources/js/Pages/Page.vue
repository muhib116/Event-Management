<template>
    <Master>
        <AuthenticatedLayout>
            <Header />

            <div class="account">
                <div class="main-heading">
                    <h1>Pages</h1>
                </div>
                <nav class="flex justify-center">
                    <div class="billing nav-item filter-item" :class="{ 'active': activeTab == 'lists' }" @click="activeTab = 'lists'">Lists</div>
                    <div class="billing nav-item filter-item" :class="{ 'active': activeTab == 'create' }" @click="activeTab = 'create'">Create</div>
                </nav>
                <!-- Profile -->
                <!-- settings -->
                <div class="settings--order-notification account-item" v-show="activeTab == 'lists'">


                    <div class="shadow mt-10 rounded border-t">
                        <table class="w-full rounded">
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Title
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Description
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="page in pages" :key="page.id" class="border-b">
                                    <th scope="row" class="text-center px-2 py-4 text-gray-700">
                                        {{ page.title }}
                                    </th> 
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        {{ page.description ? page.description : 'N/A' }}
                                    </td>
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        <div class="inline-flex gap-3 text-center px-2 py-4 mx-auto">
                                            <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                        </div>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>

                <form class="Profile--Personal py-2 account-item" v-show="activeTab == 'create'" @submit.prevent="createAdvertise" method="POST" enctype="multipart/form-data">
                    <!-- <h2>Advertise</h2> -->
                    <div class="event-details">
                        <div class="element">
                            <label for="title"><span class="important">*</span>Title</label>
                            <input type="text" id="title" name="first_name" v-model="form.title">
                            <div class="text-red-500" v-if="form.errors.first_name">{{ form.errors.first_name }}</div>
                        </div>
                        <div class="element">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" placeholder="Description" v-model="form.description"></textarea>
                            <div class="text-red-500" v-if="form.errors.description">{{ form.errors.description }}</div>
                        </div>
                    </div>
                    
                    <div class="save flex gap-3"> 
                        <button class="button bg-green-600" type="submit" :disabled="form.processing">
                            <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span v-if="form.id!==null">Update</span>
                            <span v-else>Create</span>
                        </button>
                    </div>
                </form>
            </div>


        </AuthenticatedLayout>
    </Master>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Header from '@/Components/dashboard/Header.vue';
import { ref } from '@vue/reactivity';
import Master from './Master.vue';
const props = defineProps({
    pages: Array,
});
const activeTab = ref('lists');
const form = useForm({
    title: '',
    description: '',
});


</script>