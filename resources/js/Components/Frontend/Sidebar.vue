<template>
    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                <a href="#">
                    <img src="images/logo.png" alt="">
                </a>
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
</template>

<script setup>

</script>

<style lang="scss" scoped>

</style>