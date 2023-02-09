<template>
    <footer class="footer-area">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-4 py-6">
                <div class="footer-logo flex items-center w-full">
                    <a :href="route('home')" class="flex items-center md:ml-0 ml-auto mr-auto">
                        <img :src="$page.props.settings?.footer_logo_image?.value" alt="">
                    </a>
                </div>
                <div class="footer-item w-full"> 
                    <ul>
                        <li class="text-center"><Link href="/page/imprint" class="mt-0">Imprint</Link></li> 
                    </ul>
                </div> 
                <div class="footer-item w-full"> 
                    <ul>
                        <li class="text-center"><Link href="/page/data-privacy" class="mt-0">Data privacy</Link></li> 
                    </ul>
                </div>
                <div class="footer-item w-full"> 
                    <ul>
                        <li class="md:text-right text-center">
                            <Link href="/page/terms-conditions" class="mt-0">Terms & conditions</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-btmprt py-2 border-t-white border-opacity-20">
            <div class="container">
                <div class="footer-btmitem">
                    <ul>
                        <li v-if="$page.props.settings.facebook_link?.value">
                            <a :href="$page.props.settings.facebook_link.value" target="_blank" class="text-xs"><i class="fab fa-facebook-square"></i></a>
                        </li>
                        <li v-if="$page.props.settings.twitter_link?.value">
                            <a :href="$page.props.settings.twitter_link.value" target="_blank" class="text-xs"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li v-if="$page.props.settings.tiktok_link?.value">
                            <a :href="$page.props.settings.tiktok_link.value" target="_blank" class="text-xs"><i class="fab fa-tiktok"></i></a>
                        </li>
                        <li v-if="$page.props.settings.instagram_link?.value">
                            <a :href="$page.props.settings.instagram_link.value" target="_blank" class="text-xs"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li v-if="$page.props.settings.youtube_link?.value">
                            <a :href="$page.props.settings.youtube_link.value" target="_blank" class="text-xs"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li v-if="$page.props.settings.telegram_link?.value">
                            <a :href="$page.props.settings.telegram_link.value" target="_blank" class="text-xs"><i class="fab fa-telegram"></i></a>
                        </li>
                    </ul>
                    <label class="text-white inline-flex items-center gap-2 border-gray-500 border px-2">
                        <svg fill="currentColor" style="width: 16px;height:16px;" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="796 796 200 200" xml:space="preserve"><path d="M973.166 818.5H818.833c-12.591 0-22.833 10.243-22.833 22.833v109.333c0 12.59 10.243 22.833 22.833 22.833h154.333c12.59 0 22.834-10.243 22.834-22.833V841.333c0-12.59-10.244-22.833-22.834-22.833zM896 961.5h-77.167c-5.973 0-10.833-4.859-10.833-10.833V841.333c0-5.974 4.86-10.833 10.833-10.833H896v131zm82.58-89.371c-.547 9.145-5.668 27.261-20.869 39.845 4.615 1.022 9.629 1.573 14.92 1.573v12c-10.551 0-20.238-1.919-28.469-5.325-7.689 3.301-16.969 5.325-28.125 5.325v-12c5.132 0 9.924-.501 14.366-1.498-8.412-7.016-13.382-16.311-13.382-26.78h11.999c0 8.857 5.66 16.517 14.884 21.623 4.641-2.66 8.702-6.112 12.164-10.351 5.628-6.886 8.502-14.521 9.754-20.042h-49.785v-12h22.297v-11.986h12V864.5h21.055c1.986 0 3.902.831 5.258 2.28a7.213 7.213 0 0 1 1.933 5.349z"/><path d="m839.035 914.262-4.45 11.258h-15.971l26.355-61.09h15.971l25.746 61.09h-16.583l-4.363-11.258h-26.705zm13.44-34.386-8.902 22.604h17.629l-8.727-22.604z"/></svg>
                        <select class="bg-transparent" v-model="selectedLanguage" @change="languageChanger(selectedLanguage)">
                            <option class="text-black" v-for="item in languageList" :key="item.key" :value="item.key">{{ item.value }}</option>
                        </select>
                    </label>
                    <p class="text-xs">&copf; {{ new Date().getFullYear() }} {{ get($page, 'props.site_name.value') }}</p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import {get} from 'lodash'
import { ref, onMounted } from 'vue'
import useLanguage from '@/useLanguage'

const { selectedLanguage, languageList, languageChanger } = useLanguage()


</script>

<style lang="scss" scoped>

</style>