<template>
    <Master>
        <AuthenticatedLayout>
            <Header />

            <div class="account">
                <div class="main-heading">
                    <h1>Advertises</h1>
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
                                        Image
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Description
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Featured
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Status
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Position
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Time frame
                                    </th>
                                    <th scope="col" class="px-2 py-4 text-gray-700">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ad in advertises" :key="ad.id" class="border-b">
                                    <th scope="row" class="text-center px-2 py-4 text-gray-700">
                                        {{ ad.title }}
                                    </th>
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        <img :src="ad.image" class="w-10" alt="">
                                    </td>
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        {{ ad.description }}
                                    </td>
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        <span v-if="ad.featured" class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Featured</span>
                                        <span v-else class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Not featured</span>
                                    </td>
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        <span v-if="ad.status" class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Active</span>
                                        <span v-else class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Inactive</span>
                                    </td>
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        {{ ad.position }}
                                    </td>
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        {{ ad.start_at }} - {{ ad.end_at }}
                                    </td>
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        <div class="inline-flex gap-3 text-center px-2 py-4 mx-auto">
                                            <button @click="edit(ad)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                            <button @click="deleteAd(ad)" :disabled="delete_form.processing" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
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
                            <input type="text" id="title" name="first_name" v-model="advertise_form.title">
                            <div class="text-red-500" v-if="advertise_form.errors.first_name">{{ advertise_form.errors.first_name }}</div>
                        </div>
                        <div class="element">
                            <label for="link"><span class="important">*</span>Link</label>
                            <input type="text" id="link" name="link" v-model="advertise_form.link">
                            <div class="text-red-500" v-if="advertise_form.errors.link">{{ advertise_form.errors.link }}</div>
                        </div>
                        <div class="element">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" placeholder="Description" v-model="advertise_form.description"></textarea>
                            <div class="text-red-500" v-if="advertise_form.errors.description">{{ advertise_form.errors.description }}</div>
                        </div>
                        <div class="element">
                            <label for="position">Position</label>
                            <input type="number" id="position" name="position" v-model="advertise_form.position">
                            <div class="text-red-500" v-if="advertise_form.errors.position">{{ advertise_form.errors.position }}</div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="element">
                                <label for="start_at">Start At</label>
                                <input type="datetime-local" id="start_at" name="start_at" v-model="advertise_form.start_at">
                                <div class="text-red-500" v-if="advertise_form.errors.start_at">{{ advertise_form.errors.start_at }}</div>
                            </div>
                            <div class="element">
                                <label for="end_at">End At</label>
                                <input type="datetime-local" id="end_at" name="end_at" v-model="advertise_form.end_at">
                                <div class="text-red-500" v-if="advertise_form.errors.end_at">{{ advertise_form.errors.end_at }}</div>
                            </div>
                        </div>
                        <div class="element">
                            <label for="featured">Featured</label>
                            <div class="two-columns">
                                <select name="featured" id="featured" v-model="advertise_form.featured">
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select> 
                            </div> 
                            <div class="text-red-500" v-if="advertise_form.errors.featured">{{ advertise_form.errors.featured }}</div>
                        </div>
                        <div class="element">
                            <label for="status">Status</label>
                            <div class="two-columns">
                                <select name="status" id="status" v-model="advertise_form.status">
                                    <option value="1">Active</option>
                                    <option value="0">Disable</option>
                                </select> 
                            </div> 
                            <div class="text-red-500" v-if="advertise_form.errors.status">{{ advertise_form.errors.status }}</div>
                        </div>
                        <div class="element">
                            <label for="description">
                                <span class="important">*</span>
                                Image
                            </label>
                            <div class="relative flex  items-center">
                                <label class="cursor-pointer relative border flex items-center justify-center text-2xl border-dashed border-red-400 max-w-[550px] min-h-[100px] w-full truncate font-bold bg-white p-4 bg-opacity-80 rounded">
                                    <span class="z-10 bg-white py-3 px-4 rounded shadow absolute top-0">+ Upload Banner</span>
                                    <input hidden type="file" name="image" accept="image/*" @change="(e) => {
                                        advertise_form.banner_image = e.target.files[0];
                                        onFileChange(e)
                                    }">
                                    <div v-if="prev_img" class="flex-1 flex gap-5 flex-wrap">
                                        <img class="w-full h-full object-cover" :src="prev_img" alt="">
                                    </div>
                                </label>
                            </div>
                            <div class="text-red-500" v-if="advertise_form.errors.image">{{ advertise_form.errors.image }}</div>
                        </div>
                    </div>
                    <div class="save flex gap-3">
                        <button @click="cancelEdit()" v-if="advertise_form.advertise_id!==null" class="button" type="button">
                            <span>Cancel</span>
                        </button>
                        <button class="button bg-green-600" type="submit" :disabled="advertise_form.processing">
                            <svg v-if="advertise_form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span v-if="advertise_form.advertise_id!==null">Update</span>
                            <span v-else>Create</span>
                        </button>
                    </div>
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
import useEvent from './useEvent';
import "vue-toastification/dist/index.css";
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import { useToast } from "vue-toastification";
import { onMounted } from '@vue/runtime-core';
const toast = useToast();

const props = defineProps({
    advertises: {
        type: Array,
        default: []
    }
});

const activeTab = ref('lists');

const prev_img = ref(false);


const advertise_form = useForm({
    title: null,
    description: null,
    link: null,
    banner_image: null,
    advertise_id: null,
    featured: 0,
    status: 1,
    position: null,
    start_at: null,
    end_at: null,
});

const delete_form = useForm({
    advertise_id: null
});
function deleteAd(ad) {
    if (confirm('Are you sure to delete this item?')) {
        delete_form.advertise_id = ad.id;
        delete_form.delete(route('advertise.delete'), {
            onError() {
                toast.error('Opps Something wrong');
                delete_form.reset();
            },
            onSuccess() {
                delete_form.reset();
                toast.success('Advertise Deleted Successfully');
            }
        });
    }
}
function cancelEdit() {
    advertise_form.reset();
    prev_img.value = false;
    activeTab.value = 'lists';
}
function edit(ad) {
    activeTab.value = 'create';
    advertise_form.title = ad.title;
    advertise_form.description = ad.description;
    advertise_form.link = ad.link;
    advertise_form.advertise_id = ad.id;
    advertise_form.featured = ad.featured;
    advertise_form.status = ad.status;
    advertise_form.position = ad.position;
    advertise_form.start_at = ad.start_at;
    advertise_form.end_at = ad.end_at;
    prev_img.value = ad.image;
}


function onFileChange(e) {
    const file = URL.createObjectURL(e.target.files[0]);
    prev_img.value = file;
    // advertise_form.image = file;
}
const createAdvertise = () => {
    console.log(advertise_form);
    advertise_form.post(route('advertise.store'), {
        onError(e) {
            console.log('error', e);
            toast.error('Opps Something wrong');
        },
        onSuccess(e) {
            console.log('success', e);
            toast.success('Advertise Saved Successfully');
            advertise_form.reset();
            activeTab.value = 'lists';
            prev_img.value = false;
        },
    });
}

</script>