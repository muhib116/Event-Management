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
                    <Link :href="route('home')">
                        <img :src="get($page.props, 'settings.logo_image.value')" alt="" />
                    </Link>
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
                    <li v-for="(category, index) in $page.props.category_list" :key="index"><Link :href="route('category.event', category.category)">{{ category.name }}</Link></li>
                    <li v-if="!isAuthenticated" class="truncate border-t pt-2 px-0">
                        <Link :href="route('login')" class="">Organizer login</Link>
                    </li>
                    <!-- <li v-if="!isAuthenticated"><Link :href="route('register')" class="">Register</Link></li> -->
                </ul>
                <ul class="navbar-nav nav-btn">
                    <li>
                        <button 
                            v-if="isAuthenticated && !isLoading" 
                            @click="logout" 
                            class="px-5 text-[#172853] text-sm"
                        >
                            Logout
                        </button>
                    </li>
                    <li class="flex items-center justify-center gap-2">
                        <button 
                            v-if="!isAuthenticated && !isLoading" 
                            @click="login" 
                            class="px-3 text-[#172853] text-sm hover:bg-[#172853] hover:text-white"
                        >
                            Login
                        </button>
                        <button 
                            v-if="!isAuthenticated && !isLoading" 
                            @click="login" 
                            class="px-3 bg-[#172853] text-white text-sm hover:bg-[#172853] hover:text-white whitespace-nowrap"
                        >
                            Organizer Sign Up
                        </button>
                    </li>
                </ul>
                <ul v-if="!isAuthenticated" class="top-[50px] right-0 bg-white w-[260px]">
                    <!-- <li class="truncate border-b px-0">
                        <button @click="login" class="">Guest login</button>
                    </li>
                    <li class="truncate border-b px-0">
                        <Link :href="route('register')" class="">Register Organizer</Link>
                    </li>
                    <li class="truncate border-b px-0">
                        <Link :href="route('login')" class="">Organizer login</Link>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import useAuth from '@/useAuth.js'
    import {get} from 'lodash'

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
        color: #172853;
        background: #FFFFFF;
        border: 1px solid #172853;
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