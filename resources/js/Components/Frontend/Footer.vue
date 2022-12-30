<template>
    <footer class="footer-area">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-4 pt-16 pb-16">
                <div class="footer-logo flex items-center w-full">
                    <a :href="route('home')" class="flex items-center">
                        <img :src="$page.props.settings?.footer_logo_image?.value" alt="">
                    </a>
                </div>
                <div class="footer-item w-full"> 
                    <ul>
                        <li><a href="#" class="mt-0">Imprint</a></li> 
                    </ul>
                </div> 
                <div class="footer-item w-full"> 
                    <ul>
                        <li><a href="#" class="mt-0">Data privacy</a></li> 
                    </ul>
                </div>
                <div class="footer-item w-full"> 
                    <ul>
                        <li><a href="#" class="mt-0">Terms & conditions</a></li> 
                    </ul>
                </div>
            </div>             
        </div>
        <div class="footer-btmprt">
            <div class="container">
                <div class="footer-btmitem">
                    <ul>
                        <li v-if="$page.props.settings.facebook_link?.value"><a :href="$page.props.settings.facebook_link.value"><i class="fab fa-twitter"></i></a></li>
                        <li v-if="$page.props.settings.twitter_link?.value"><a :href="$page.props.settings.twitter_link.value"><i class="fab fa-instagram"></i></a></li>
                        <li v-if="$page.props.settings.tiktok_link?.value"><a :href="$page.props.settings.tiktok_link.value"><i class="fab fa-tiktok"></i></a></li>
                        <li v-if="$page.props.settings.instagram_link?.value"><a :href="$page.props.settings.instagram_link.value"><i class="fab fa-youtube"></i></a></li>
                        <li v-if="$page.props.settings.youtube_link?.value"><a :href="$page.props.settings.youtube_link.value"><i class="fab fa-telegram"></i></a></li>
                        <li v-if="$page.props.settings.telegram_link?.value"><a :href="$page.props.settings.telegram_link.value"><i class="fab fa-facebook-square"></i></a></li>
                    </ul>
                    <p>&copy; 2020 Karcis incorporated</p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>

</script>

<style lang="scss" scoped>

</style>