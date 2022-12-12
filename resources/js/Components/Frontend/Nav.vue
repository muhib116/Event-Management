<template>
    <div>
        <header class="header-area">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <Link class="navbar-brand" :href="route('home')">
                        <img src="@/assets/frontend/images/logo.png" alt="">
                    </Link>
                    <button @click="(showOffCanvas = true)" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                    <div class="navbar-collapse">
                        <ul class="navbar-nav ms-auto">
                            <li><a href="#">Concerts</a></li>
                            <li><a href="#">Arts</a></li>
                            <li><a href="#">Conference</a></li>
                            <li><a href="#">Movies</a></li>             
                            <li><a href="#">International</a></li>              
                        </ul>
                        <ul class="navbar-nav nav-btn ms-auto">            
                            <li><Link :href="route('login')" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Log In</Link></li> 
                            <li><Link class="active" :href="route('register')">Sign Up</Link></li> 
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <Sidebar v-model="showOffCanvas" />
    </div>
</template>

<script setup>
    import Sidebar from './Sidebar.vue';
    import { ref } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    const showOffCanvas = ref(false)
</script>


<style scoped>
    @media all and (max-width: 992px){
        .navbar-collapse{
            display: none;
        }
    }
</style>