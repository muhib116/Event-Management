<template>
    <div>
        <h4>Share</h4>
        <ul>
            <li>
                <a @click="copyToClipboard()" class="cursor-pointer">
                    <img src="@/assets/frontend/images/links.svg" alt="">
                    <span>Share to Links </span>
                </a>
            </li>
            <li>
                <a target="_blank" :href="pinterest">
                    <img src="@/assets/frontend/images/pinterest.svg" alt="">
                    <span>Share to Pinterest </span>
                </a>
            </li>
            <li>
                <a target="_blank" :href="twitter">
                    <img src="@/assets/frontend/images/twitter.svg" alt="">
                    <span>Share to Twitter</span>
                </a>
            </li>
            <li>
                <a target="_blank" :href="facebook">
                    <img src="@/assets/frontend/images/facebook.svg" alt="">
                    <span>Share to Facebook </span>
                </a>
            </li>
        </ul>
        <div>
            
        </div>
    </div>
</template>

<script setup>
    import UseSocialMedia from '@/Components/Frontend/Event/UseSocialMedia.js'

    const { 
        twitter,
        facebook,
        pinterest,
        url
    } = UseSocialMedia()

    function copyToClipboard() {
        const elem = document.createElement('textarea');
        elem.value = window.location.href;
        document.body.appendChild(elem);
        elem.select();
        document.execCommand('copy');
        document.body.removeChild(elem);
        alert("Link Copied")
    }
</script>

<style>
    #st-2 {
        display: block !important;
    }
</style>