<template>
    <Master>
        <AuthenticatedLayout>
            <Header />

            <div class="account pb-52">
                <div class="main-heading">
                    <h1>Settings</h1>
                </div>
                <!-- settings -->
                <form class="event-details container mx-auto mt-10" @submit.prevent="saveSettings">
                    <div class="flex justify-end sticky top-[140px] z-10 pointer-events-none">
                        <button type="submit" class="flex pointer-events-auto items-center py-2 px-6 bg-[var(--brand\_color)] hover:opacity-90 text-white rounded-md" :disabled="form.processing">
                            <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Save
                        </button>
                    </div>
                    <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
                        <div class="element">
                            <label for="currency">Currency</label>
                            <input class="disabled:opacity-60" type="text" style="font-family: initial !important;" name="currency" value="€" disabled>
                            <div class="text-red-500" v-if="form.errors.currency">{{ form.errors.currency }}</div>
                        </div>
                        <div class="element">
                            <label for="commission">Commission percentage</label>
                            <input type="number" id="commission" name="commission" v-model="form.commission">
                            <div class="text-red-500" v-if="form.errors.commission">{{ form.errors.commission }}</div>
                        </div>
                    </div>
                    <div class="element">
                        <label for="home_banner_text">Home page banner text</label>
                        <input type="text" id="home_banner_text" name="home_banner_text" v-model="form.home_banner_text">
                        <div class="text-red-500" v-if="form.errors.home_banner_text">{{ form.errors.home_banner_text }}</div>
                    </div>
                    <div class="element">
                        <label for="site_name">Site name</label>
                        <input type="text" name="site_name" v-model="form.site_name">
                        <div class="text-red-500" v-if="form.errors.site_name">{{ form.errors.site_name }}</div>
                    </div>
                    <div class="element">
                        <label for="paypal_publish_key">Paypal client id</label>
                        <input type="text" id="paypal_publish_key" name="paypal_publish_key" v-model="form.paypal_publish_key">
                        <div class="text-red-500" v-if="form.errors.paypal_publish_key">{{ form.errors.paypal_publish_key }}</div>
                    </div>
                    <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
                        <div class="element">
                            <label for="stripe_publish_key">Stripe publish key</label>
                            <input type="text" id="stripe_publish_key" name="stripe_publish_key" v-model="form.stripe_publish_key">
                            <div class="text-red-500" v-if="form.errors.stripe_publish_key">{{ form.errors.stripe_publish_key }}</div>
                        </div>
                        <div class="element">
                            <label for="stripe_secret_key">Stripe secret key</label>
                            <input type="text" id="stripe_secret_key" name="stripe_secret_key" v-model="form.stripe_secret_key">
                            <div class="text-red-500" v-if="form.errors.stripe_secret_key">{{ form.errors.stripe_secret_key }}</div>
                        </div>
                    </div>
                    <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
                        <div class="element">
                            <label for="auth0_domain">Auth0 domain</label>
                            <input type="text" id="auth0_domain" name="auth0_domain" v-model="form.auth0_domain">
                            <div class="text-red-500" v-if="form.errors.auth0_domain">{{ form.errors.auth0_domain }}</div>
                        </div>
                        <div class="element">
                            <label for="auth0_client_id">Auth0 client id</label>
                            <input type="text" id="auth0_client_id" name="auth0_client_id" v-model="form.auth0_client_id">
                            <div class="text-red-500" v-if="form.errors.auth0_client_id">{{ form.errors.auth0_client_id }}</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3">

                        <div class="element">
                            <label for="home_banner_image" class="text-xl font-semibold">Home page banner image</label>
                            <div class="element">
                                <div class="relative flex  items-center">
                                    <label class="cursor-pointer relative border flex items-center justify-center text-2xl border-dashed border-red-400 max-w-[300px] min-h-[100px] w-full truncate font-bold bg-white p-4 bg-opacity-80 rounded">
                                        <span class="z-[1] bg-white py-3 px-4 rounded shadow absolute top-0">Upload Banner</span>
                                        <input hidden type="file" name="image" accept="image/*" @change="(e) => {
                                            form.home_banner_image = e.target.files[0];
                                            onFileChange(e)
                                        }">
                                        <div v-if="prev_img" class="flex-1 flex gap-5 flex-wrap">
                                            <img class="w-full h-full object-cover" :src="prev_img" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="text-red-500" v-if="form.errors.home_banner_image">{{ form.errors.home_banner_image }}</div>
                            </div>
                        </div>
                        <div class="element">
                            <label for="logo_image" class="text-xl font-semibold">Header Logo image</label>
                            <div class="element">
                                <div class="relative flex  items-center">
                                    <label class="cursor-pointer relative border flex items-center justify-center text-2xl border-dashed border-red-400 max-w-[300px] min-h-[100px] w-full truncate font-bold bg-gray-200 p-4 bg-opacity-80 rounded">
                                        <span class="z-[1] bg-white py-3 px-4 rounded shadow absolute -top-0">Upload Logo</span>
                                        <input hidden type="file" name="image" accept="image/*" @change="(e) => {
                                            form.logo_image = e.target.files[0];
                                            onFileChange(e, 'logo')
                                        }">
                                        <div v-if="prev_logo_img" class="flex-1 flex gap-5 flex-wrap">
                                            <img class="w-full h-full object-cover" :src="prev_logo_img" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="text-red-500" v-if="form.errors.logo_image">{{ form.errors.logo_image }}</div>
                            </div>
                        </div>
                        <div class="element">
                            <label for="logo_image" class="text-xl font-semibold">Footer Logo image</label>
                            <div class="element">
                                <div class="relative flex  items-center">
                                    <label class="cursor-pointer relative border flex items-center justify-center text-2xl border-dashed border-red-400 max-w-[300px] min-h-[100px] w-full truncate font-bold bg-gray-200 p-4 bg-opacity-80 rounded">
                                        <span class="z-[1] bg-white py-3 px-4 rounded shadow absolute -top-0">Upload Logo</span>
                                        <input hidden type="file" name="image" accept="image/*" @change="(e) => {
                                            form.footer_logo_image = e.target.files[0];
                                            onFileChange(e, 'footer_logo_image')
                                        }">
                                        <div v-if="prev_footer_logo_img" class="flex-1 flex gap-5 flex-wrap">
                                            <img class="w-full h-full object-cover" :src="prev_footer_logo_img" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="text-red-500" v-if="form.errors.footer_logo_image">{{ form.errors.footer_logo_image }}</div>
                            </div>
                        </div>
                        <div class="element">
                            <label for="logo_image" class="text-xl font-semibold">Fave Icon</label>
                            <div class="element">
                                <div class="relative flex  items-center">
                                    <label class="cursor-pointer relative border flex items-center justify-center text-2xl border-dashed border-red-400 max-w-[300px] min-h-[100px] w-full truncate font-bold bg-gray-200 p-4 bg-opacity-80 rounded">
                                        <span class="z-[1] bg-white py-3 px-4 rounded shadow absolute -top-0">Upload Icon</span>
                                        <input hidden type="file" name="image" accept="image/*" @change="(e) => {
                                            form.fave_icon = e.target.files[0];
                                            onFileChange(e, 'fave_icon')
                                        }">
                                        <div v-if="prev_fave_icon" class="flex-1 flex gap-5 flex-wrap">
                                            <img class="w-full h-full object-cover" :src="prev_fave_icon" alt="">
                                        </div>
                                    </label>
                                </div>
                                <div class="text-red-500" v-if="form.errors.fave_icon">{{ form.errors.fave_icon }}</div>
                            </div>
                        </div>

                        
                    </div>
                    <div class="text-3xl font-bold text-gray-600 mb-5">
                        Social Links
                    </div> 
                    <div class="grid gap-3 grid-cols-2 w-full">
                        <div class="element">
                            <label>Facebook Link</label>
                            <input type="text" v-model="form.facebook_link"> 
                        </div>
                        <div class="element">
                            <label>Twitter Link</label>
                            <input type="text" v-model="form.twitter_link"> 
                        </div>
                        <div class="element">
                            <label>Tiktok Link</label>
                            <input type="text" v-model="form.tiktok_link"> 
                        </div>
                        <div class="element">
                            <label>Instagram Link</label>
                            <input type="text" v-model="form.instagram_link"> 
                        </div>
                        <div class="element">
                            <label>Youtube Link</label>
                            <input type="text" v-model="form.youtube_link"> 
                        </div>
                        <div class="element">
                            <label>Telegram Link</label>
                            <input type="text" v-model="form.telegram_link"> 
                        </div>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    </Master>
</template>

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
import _ from 'lodash';

const toast = useToast();

const props = defineProps({
    site_settings: {
        type: Array,
        default: []
    }
});
const prev_img = ref(false);
const prev_logo_img = ref(false);
const prev_fave_icon = ref(false);
const prev_footer_logo_img = ref(false);

const form = useForm({
    currency: '€',
    commission: null,
    home_banner_text: '',
    home_banner_image: null,
    logo_image: null,
    footer_logo_image: null,
    facebook_link: null,
    twitter_link: null,
    tiktok_link: null,
    instagram_link: null,
    youtube_link: null,
    telegram_link: null,
    fave_icon: null,
    site_name: null,
    paypal_publish_key: null,
    stripe_publish_key: null,
    stripe_secret_key: null,
    auth0_domain: null,
    auth0_client_id: null,
});
onMounted(()=> {
    let settings = props.site_settings;
    form.currency = '€';
    form.commission = _.find(settings, {name: 'commission'})?.value;
    form.home_banner_text = _.find(settings, {name: 'home_banner_text'})?.value;
    form.site_name = _.find(settings, {name: 'site_name'})?.value;
    form.stripe_publish_key = _.find(settings, {name: 'stripe_publish_key'})?.value;
    form.stripe_secret_key = _.find(settings, {name: 'stripe_publish_key'})?.value;
    form.paypal_publish_key = _.find(settings, {name: 'paypal_publish_key'})?.value;
    form.auth0_domain = _.find(settings, {name: 'auth0_domain'})?.value;
    form.auth0_client_id = _.find(settings, {name: 'auth0_client_id'})?.value;
    
    form.facebook_link = _.find(settings, {name: 'facebook_link'})?.value;
    form.twitter_link = _.find(settings, {name: 'twitter_link'})?.value;
    form.tiktok_link = _.find(settings, {name: 'tiktok_link'})?.value;
    form.instagram_link = _.find(settings, {name: 'instagram_link'})?.value;
    form.youtube_link = _.find(settings, {name: 'youtube_link'})?.value;
    form.telegram_link = _.find(settings, {name: 'telegram_link'})?.value;



    prev_img.value = _.find(settings, {name: 'home_banner_image'})?.value;
    prev_logo_img.value = _.find(settings, {name: 'logo_image'})?.value;
    prev_footer_logo_img.value = _.find(settings, {name: 'footer_logo_image'})?.value;
    prev_fave_icon.value = _.find(settings, {name: 'fave_icon'})?.value; 
});

function onFileChange(e, type=null) {
    if (type == 'logo') {
        const file = URL.createObjectURL(e.target.files[0]);
        prev_logo_img.value = file;
    }
    else if(type == 'footer_logo_image') {
        const file = URL.createObjectURL(e.target.files[0]);
        prev_footer_logo_img.value = file;
    } 
    else if(type == 'fave_icon') {
        const file = URL.createObjectURL(e.target.files[0]);
        prev_fave_icon.value = file;
    } 
    else {
        const file = URL.createObjectURL(e.target.files[0]);
        prev_img.value = file;
    } 
}

function saveSettings() {
    form.post(route('settings.save'), {
        onSuccess(e) {
            if (e.props?.flash?.success) {
                toast.success(e.props?.flash?.success);
            }
        },
        onError(e) {
            if (e.props?.flash?.error) {
                toast.error(e.props?.flash?.error);
            } 
        }
    })
}

</script>




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