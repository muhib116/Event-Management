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
                        <li class="md:text-right text-center"><Link href="/page/terms-conditions" class="mt-0">Terms & conditions</Link></li> 
                    </ul>
                </div>
            </div>             
        </div>
        <div class="footer-btmprt py-2 border-t-white border-opacity-20">
            <div class="container">
                <div class="footer-btmitem">
                    <ul>
                        <li v-if="$page.props.settings.facebook_link?.value">
                            <a :href="$page.props.settings.facebook_link.value" class="text-xs"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li v-if="$page.props.settings.twitter_link?.value">
                            <a :href="$page.props.settings.twitter_link.value" class="text-xs"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li v-if="$page.props.settings.tiktok_link?.value">
                            <a :href="$page.props.settings.tiktok_link.value" class="text-xs"><i class="fab fa-tiktok"></i></a>
                        </li>
                        <li v-if="$page.props.settings.instagram_link?.value">
                            <a :href="$page.props.settings.instagram_link.value" class="text-xs"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li v-if="$page.props.settings.youtube_link?.value">
                            <a :href="$page.props.settings.youtube_link.value" class="text-xs"><i class="fab fa-telegram"></i></a>
                        </li>
                        <li v-if="$page.props.settings.telegram_link?.value">
                            <a :href="$page.props.settings.telegram_link.value" class="text-xs"><i class="fab fa-facebook-square"></i></a>
                        </li>
                    </ul>
                    <p class="text-xs">&copy; 2020 Karcis incorporated</p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<style lang="scss" scoped>

</style>