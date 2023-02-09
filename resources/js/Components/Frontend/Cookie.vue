<template>
    <div ref="jsCookieBox" id="js-cookie-box" class="cookie-box cookie-box--hide">
        Your experience on this site will be improve by following cookies. 🍪 ! 
        <span id="js-cookie-button" class="cookie-button">Allow cookies</span>
    </div>
</template>

<script setup>
    import { onMounted } from 'vue'

    onMounted(() => {
        const cookieBox = document.getElementById('js-cookie-box');
        const cookieButton = document.getElementById('js-cookie-button');

        if (!Cookies.get('cookie-box')) {
            cookieBox.classList.remove('cookie-box--hide');
            
            cookieButton.onclick = function() {
                Cookies.set('cookie-box', true, { expires: 7 });
                cookieBox.classList.add('cookie-box--hide');
            }
        }
    })
</script>

<style scoped>
    .cookie-box {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        text-align: center;
        padding: 1rem 2rem;
        background: #fff;
        transition: all 0.75s cubic-bezier(0.19, 1, 0.22, 1);
    }
    .cookie-box--hide {
        opacity: 0;
        bottom: -100%;
    }
    .cookie-button {
        display: inline-block;
        cursor: pointer;
        padding: 0.65rem 0.85rem;
        margin-left: 0.45rem;
        color: #fff;
        font-size: 0.75rem;
        letter-spacing: 1px;
        background-image: linear-gradient(62deg, #fbab7e 0%, #f7ce68 100%);
    }
</style>