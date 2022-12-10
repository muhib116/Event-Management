<template>
    <div>
        <Nav />
        <Sidebar />
        <SearchBar />
        <slot></slot>
        <Footer />
    </div>
</template>

<script setup>
    import '@/assets/frontend/css/datepicker.css'
    import '@/assets/frontend/css/owl.carousel.css'
    import '@/assets/frontend/css/bootstrap.css'
    import '@/assets/frontend/style.css'
    import '@/assets/frontend/css/responsive.css'

    import Nav from '@/Components/Frontend/Nav.vue'
    import Sidebar from '@/Components/Frontend/Sidebar.vue'
    import SearchBar from '@/Components/Frontend/SearchBar.vue'
    import Footer from '@/Components/Frontend/Footer.vue'
</script>
        <!-- fonts -->
        <!-- <link href="https://api.fontshare.com/v2/css?f[]=general-sans@701,500,300,600,400,700&f[]=cabinet-grotesk@800,500,700,400,300,900&display=swap" rel="stylesheet">  -->
<style scoped>
</style>