<template>
    <div v-if="modelValue" id="screen_overlay" class="screen-overlay" style="display: block;">
        <div class="create-ticket" id="make_ticket">
           <!-- exit creat new -->
           <i @click="() => {
            $emit('update:modelValue', false); onclose();
           }" class="fa-solid exit fa-xmark"></i>
           <!-- title -->
           <div class="title">You are not logged in</div>
           <!-- content goes here -->
           <div class="content">
              <div class="text-2xl py-4 text-center">Please login before continue.</div>
              
              <div class="flex justify-center">
                  <button v-if="!isAuthenticated && !isLoading" @click="login" class="flex gap-2 rounded py-2 px-5 bg-[#4F4CEE] hover:bg-[#4744e4] text-white">
                     Login
                  </button>
              </div>
           </div>
        </div>
    </div>
</template>

<script setup>
   import useAuth from '@/useAuth'; 
import { ref, onMounted, watchEffect, watch } from 'vue'
   const { 
        login,
        logout,
        isAuthenticated,
        userInfo,
        isLoading
     } = useAuth()
   const props = defineProps({
      modelValue: {
         type: Boolean,
         default: false
      },
      callback: {
         type: Function,
         default: () => {}
      },
      editable: {
         type: Boolean,
         default: false
      },
   });
   const onclose = () => {
      window.location.href = route('home');
   }

</script>

<style scoped>
.screen-overlay .create-ticket .content{
   width: 100%;
   height: 94%;
   overflow-y: auto;
}
</style>