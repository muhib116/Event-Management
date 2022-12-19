<template>
    <div 
        class="canvas_overlay lg:hidden z-10"
        :class="modelValue&&'visible'"
        @click.self="$emit('update:modelValue', false)"
    >
        <div 
            class="offcanvas offcanvas-start d-lg-none z-20"
            :class="modelValue&&'show visible'"
            tabindex="-1" id="offcanvasExample" 
            aria-labelledby="offcanvasExampleLabel"
        >
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                    <a href="#">
                        <img src="@/assets/frontend/images/logo.png" alt="">
                    </a>
                </h5>
                <button @click="$emit('update:modelValue', false)" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="">
                    <li v-if="isAuthenticated" class="nav_dropdown_wrapper">
                        <img :src="userInfo.image" class="w-10 h-10 rounded-full object-cover object-center border" />
                        <p class="cursor-pointer py-2 truncate border-b">
                            <Link :href="route('user.profile')">
                                {{ userInfo.name }}
                            </Link>
                        </p>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li v-if="isAuthenticated">
                        <Link :href="route('user.profile')">User Profile</Link>
                    </li>
                    <li><Link :href="route('category.event', 'concerts')">Concerts</Link></li>
                    <li><Link :href="route('category.event', 'arts-culture')">Arts</Link></li>
                    <li><Link :href="route('category.event', 'media-and-film')">Movies</Link></li>
                    <li><Link :href="route('category.event', 'investments')">Investments</Link></li>   
                </ul>
                <ul class="navbar-nav nav-btn">
                    <li>
                        <button 
                            v-if="!isAuthenticated && !isLoading" 
                            @click="login" 
                            class="px-5 text-[#4F4CEE] text-sm"
                        >
                            Log in
                        </button>
                        <button 
                            v-if="isAuthenticated && !isLoading" 
                            @click="logout" 
                            class="px-5 text-[#4F4CEE] text-sm"
                        >
                            Logout
                        </button>
                    </li>
                    <!-- <li><a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Log In</a></li>  -->
                    <!-- <li><a class="active" href="#">Sign Up</a></li>  -->
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import useAuth from '@/useAuth.js'

    defineProps({
        modelValue: Boolean
    })
    const { 
        login,
        logout,
        isAuthenticated,
        userInfo,
        isLoading
     } = useAuth()
</script>

<style scoped>
    li{
        font-family: 'Cabinet Grotesk', sans-serif;
    }
    .canvas_overlay{
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        background: #0006;
        visibility: hidden;
    }

    .offcanvas-body .nav-btn li a {
        width: 100px;
        display: block;
        text-align: center;
        margin: 2px 0;
    }
    
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
    .navbar-nav li button {
        font-family: 'Cabinet Grotesk', sans-serif;
        font-weight: 500;
        font-size: 18px;
        color: #1B1B25;
        transition: 0.2s all ease;
    }
</style>