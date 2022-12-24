<template>
    <div>
        <header class="header-area">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <Link class="navbar-brand" :href="route('home')">
                        <!-- <img :src="@/assets/frontend/images/logo.png" alt=""> -->
                        <img :src="$page.props.settings?.logo_image.value" alt="">
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
                                <button v-if="!isAuthenticated && !isLoading" @click="login">Log in</button>
                            </li> 
                            <!-- <li><Link :href="route('login')" data-bs-toggle="modal" data-bs-target="#staticBackdrop">L og In</Link></li>  -->
                            <!-- <li><Link class="active" :href="route('register')">Sign Up</Link></li>  -->
                            <li v-if="isAuthenticated" class="relative nav_dropdown_wrapper">
                                <img :src="userInfo.image" class="w-10 h-10 rounded-full cursor-pointer object-cover object-center border shadow hover:shadow-lg" />
                                <ul class="dropdown absolute top-[50px] right-0 bg-white shadow w-[260px] rounded">
                                    <li class="truncate border-b px-0">
                                        <Link :href="route('user.profile')" class="flex items-center cursor-pointer px-3 py-2 hover:bg-gray-100  border-0 p-0 text-black text-md bg-transparent truncate">
                                            {{ userInfo.name }}
                                        </Link>
                                    </li>
                                    <li class="truncate border-b px-0">
                                        <Link :href="route('user.profile')" class="cursor-pointer flex items-center px-3 py-2 hover:bg-gray-100  border-0 p-0 text-black text-md">User Profile</Link>
                                    </li>
                                    <li @click="logout" class="cursor-pointer px-3 py-2 hover:bg-gray-100">Logout</li>
                                </ul>
                            </li>
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
        logout,
        isAuthenticated,
        userInfo,
        isLoading
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

    .nav_dropdown_wrapper .dropdown{
        visibility: hidden;
        opacity: 0;
        transition: 0.3s ease;
    }
    .nav_dropdown_wrapper:hover .dropdown{
        visibility: visible;
        opacity: 1;
    }

    @media all and (max-width: 992px){
        .navbar-collapse{
            display: none;
        }
    }
</style>