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
                            <li><Link :href="route('category.event', 'concerts')">Concerts</Link></li>
                            <li><Link :href="route('category.event', 'arts-culture')">Arts</Link></li>
                            <li><Link :href="route('category.event', 'media-and-film')">Movies</Link></li>
                            <li><Link :href="route('category.event', 'investments')">Investments</Link></li>            
                        </ul>
                        <ul class="navbar-nav nav-btn ms-auto">            
                            <li>
                                <button @click="logoutNow">Logout</button>
                                <button @click="login">Log in</button>
                            </li> 
                            <!-- <li><Link :href="route('login')" data-bs-toggle="modal" data-bs-target="#staticBackdrop">L og In</Link></li>  -->
                            <!-- <li><Link class="active" :href="route('register')">Sign Up</Link></li>  -->
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <Sidebar v-model="showOffCanvas" />
    </div>
</template>

<script setup>
    import Sidebar from './Sidebar.vue'
    import { ref } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import useAuth from '@/useAuth.js'

    const { 
        login,
        logoutNow,
        isLogIn
     } = useAuth()
    const showOffCanvas = ref(false)
</script>


<style scoped>
    .nav-btn li button {
        font-family: 'General Sans', sans-serif;
        font-weight: 500;
        font-size: 14px;
        color: #4F4CEE;
        background: #FFFFFF;
        border: 1px solid #4F4CEE;
        display: inline-block;
        padding: 8px 16px;
        border-radius: 4px;
    }
    .nav-btn li button:hover, .nav-btn li .active {
        background: #4F4CEE;
        color: #FFFFFF;
    }

    @media all and (max-width: 992px){
        .navbar-collapse{
            display: none;
        }
    }
</style>