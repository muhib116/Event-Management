<template>
    <div class="banner-area" :style="`background-image: url(${$page.props.settings?.home_banner_image?.value})`">
        <div class="container">
            <div class="banner-cnt">
                <h2>{{ translate($page.props.settings?.home_banner_text?.value, 'en') }}</h2>
            </div>
        </div>
    </div>
</template>

<script setup>
import useLanguage from '@/useLanguage'
const {translate} = useLanguage();

</script>

<style lang="scss" scoped>

</style>