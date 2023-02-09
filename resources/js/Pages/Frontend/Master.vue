<template>
    <div>
        <Nav />
        <Sidebar />
        <slot></slot>
        <Footer />

        <Cookie />
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import '@/assets/frontend/css/datepicker.css'
    import '@/assets/frontend/css/owl.carousel.css'
    import '@/assets/frontend/css/bootstrap.css'
    import '@/assets/frontend/style.css'
    import '@/assets/frontend/css/responsive.css'

    import Nav from '@/Components/Frontend/Nav.vue'
    import Sidebar from '@/Components/Frontend/Sidebar.vue'
    import Footer from '@/Components/Frontend/Footer.vue'
    import Cookie from '@/Components/Frontend/Cookie.vue'
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