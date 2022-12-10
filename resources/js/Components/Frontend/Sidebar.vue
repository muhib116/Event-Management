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
                <ul class="navbar-nav">
                    <li><a href="#">Concerts</a></li>
                    <li><a href="#">Arts</a></li>
                    <li><a href="#">Conference</a></li>
                    <li><a href="#">Movies</a></li>             
                    <li><a href="#">International</a></li> 
                </ul>
                <ul class="navbar-nav nav-btn">            
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Log In</a></li> 
                    <li><a class="active" href="#">Sign Up</a></li> 
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
    defineProps({
        modelValue: Boolean
    })
</script>

<style scoped>
    .canvas_overlay{
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        background: #0006;
        visibility: hidden;
    }
</style>