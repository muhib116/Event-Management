<template>
    <div>
        <template v-if="!isLoading">
            <div v-if="isAuthenticated" class="header-area">
                <slot></slot>
            </div>
            <div v-else class="header-area h-[40vh] grid items-center text-center">
                <LoginNotice />
            </div>
        </template>
        <p v-else class="text-center h-[40vh] grid items-center">Loading...</p>
    </div>
</template>

<script setup>
    import LoginNotice from '@/Components/Frontend/LoginNotice.vue'
    import useAuth from '@/useAuth.js'

    const {
        isAuthenticated,
        isLoading
    } = useAuth()
</script>

<style lang="scss" scoped>

</style>