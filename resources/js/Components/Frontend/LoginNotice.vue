<template>
    <div class="container text-xl">
        <p class="text-red-400">You don't have permission to access this page !</p>
        <button 
            class="border py-2 px-4 rounded mt-10 bg-red-400 text-white shadow" 
            @click="login"
        >
            Please Login
        </button>
    </div>
</template>

<script setup>
    import useAuth from '@/useAuth.js'

    const { 
        login
    } = useAuth()
</script>

<style lang="scss" scoped>

</style>