<template>
    <div class="banner-area" :style="`background-image: url(${$page.props.settings?.home_banner_image?.value})`">
        <div class="container">
            <div class="banner-cnt">
                <h2>{{ $page.props.settings?.home_banner_text?.value }}</h2>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>

</style>