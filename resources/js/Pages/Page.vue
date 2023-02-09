<template>
    <Master>
        <AuthenticatedLayout>
            <Header />

            <div class="account">
                <div class="main-heading">
                    <h1>Pages</h1>
                </div>
                <nav class="flex justify-center">
                    <div class="billing nav-item filter-item" :class="{ 'active': activeTab == 'lists' }" @click="activeTab = 'lists'"></div>
                    <div class="billing nav-item filter-item" :class="{ 'active': activeTab == 'create' }" @click="activeTab = 'create'"></div>
                </nav>
                
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
                                    <td scope="row" class="px-2 py-2 text-gray-700 w-[30%]">
                                        {{ page.title }}
                                    </td> 
                                    <td class="text-center px-2 py-4 text-gray-700">
                                        {{ page.content ? page.content.slice(0, 50)+'...' : 'N/A' }}
                                    </td>
                                    <td class="text-center px-2 py-2 text-gray-700 w-[100px]">
                                        <div class="inline-flex gap-3 text-center px-2 py-4 mx-auto">
                                            <button @click="editPage(page)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                        </div>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>

                <form class="Profile--Personal py-2 account-item" v-show="activeTab == 'create'" @submit.prevent="createPage" method="POST" enctype="multipart/form-data">
                    <!-- <h2>Advertise</h2> -->
                    <div class="event-details">
                        <div class="element">
                            <label for="title"><span class="important">*</span>Title</label>
                            <input type="text" id="title" name="first_name" v-model="form.title">
                            <div class="text-red-500" v-if="form.errors.first_name">{{ form.errors.first_name }}</div>
                        </div>
                        <!-- <div class="element">
                            <label for="slug"><span class="important">*</span>Link</label>
                            <input type="text" id="slug" name="slug" v-model="form.slug" readonly disabled>
                            <div class="text-red-500" v-if="form.errors.slug">{{ form.errors.slug }}</div>
                        </div> -->
                        <div class="element">
                            <label for="content">Content</label>
                            <div class="text-red-500" v-if="form.errors.content">{{ form.errors.content }}</div>
                            <textarea v-model="form.content"></textarea>
                        </div>
                    </div>
                    
                    <div class="save flex gap-3"> 
                        <button type="button" class="button" @click="() => {
                            activeTab='lists';
                            form.reset();
                        }">Cancel</button>
                        <button class="button bg-[var(--brand\_color)]" type="submit" :disabled="form.processing">
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
import { useToast } from "vue-toastification"; 

const props = defineProps({
    pages: Array,
}); 
const toast = useToast();
const activeTab = ref('lists');
const form = useForm({
    title: '',
    content: '',
    slug: '',
    id: null,
});
const deleteForm = useForm({
    id: null,
});
const editPage = (page) => {
    form.title = page.title;
    form.slug = page.slug;
    form.content = page.content;
    form.id = page.id;
    activeTab.value = 'create';
}


const createPage = () => {
    if (form.id !== null) {
        form.put(route('page.update', form.id), {
            onSuccess(ee){
                toast.success('Page updated');
                form.reset();
                activeTab.value = 'lists';
            },
            onError(ee) {
                toast.error('Page could not be created');
            }
        });
    } else {
        toast.error("Page Creation Disabled");
        form.reset();
        activeTab.value = 'lists';
    }
}

</script>

<style>


.event-details .element textarea {
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
.event-details .element textarea:focus {
    border-color: var(--normal-orange);
}
</style>