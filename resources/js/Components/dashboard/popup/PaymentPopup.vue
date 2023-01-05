<template>
    <div v-if="modelValue" id="screen_overlay" class="screen-overlay" style="display: block;">
        <div class="create-ticket" id="make_ticket">
           <!-- exit creat new -->
           <i @click="$emit('update:modelValue', false)" class="fa-solid exit fa-xmark"></i>
           <!-- title -->
           <div class="title">Create payment details</div>
           <!-- content goes here -->
           <form class="content" @submit.prevent="saveInfo">
              <div class="text-black">Bank information</div>
              <div class="element">
                 <label for="name">Bank Name</label>
                 <input name="bank_name" v-model="form.bank_name" type="text">
              </div>
              <div class="element">
                 <label for="name">IBAN number</label>
                 <input name="iban_number" v-model="form.bank_number" type="text">
              </div>
              <div class="element">
                 <label for="name">BIC</label>
                 <input name="bic" v-model="form.account_name" type="text">
              </div>
              <div class="text-black">Paypal information</div>
              <div class="element">
                 <label for="name">Email</label>
                 <input name="email" v-model="form.paypal_info" type="email">
              </div>
              <div class="text-black">M-pesa information</div>
              <div class="element">
                 <label for="name">Phone</label>
                 <input name="phone" v-model="form.mpesa_info" type="text">
              </div>
              <div class="flex justify-end">
                  <button type="submit" class="flex gap-2 rounded py-2 px-5 bg-orange-500 hover:bg-orange-600 text-white">
                     <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                     </svg>
                     Save
                  </button>
              </div>
           </form>
        </div>
    </div>
</template>

<script setup>
   import { useForm } from '@inertiajs/inertia-vue3';
   import axios from 'axios';
   import { ref, onMounted, watchEffect, watch } from 'vue'
   import { useToast } from "vue-toastification"

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
      payment_details: {
         type: [Object, null]
      },
      data: {
         type: Object,
         default: {}
      }
   })
   const toast = useToast();
   const emit = defineEmits()
   const form = useForm({
      bank_name: '',
      bank_number: '',
      account_name: '',
      paypal_info: '',
      stripe_info: '',
      mpesa_info: '',
   });
   watchEffect(() => {
      let details = props.payment_details;
      if (details) {
         form.bank_name = details.bank_name;
         form.bank_number = details.bank_number;
         form.account_name = details.account_name;
         form.paypal_info = details.paypal_info;
         form.stripe_info = details.stripe_info;
         form.mpesa_info = details.mpesa_info;
      }
   });

   function saveInfo() {
      // console.log(form.value);
      form.post(route('payment_details.save'), {
         onSuccess(s) {
            // console.log(s);
            toast.success('Details saved');
            // form.reset();
            emit('update:modelValue', false);
         },
         onError(err) {
            console.log(err);
            toast.error('Opps! Something wrong');
         }
      });
      // axios.post(route('payment_details.save'), {
      //    ...form
      // }).then(res => res.data).then(result => {
      //    console.log(result);
      //    toast.success('Details saved');
      // }).catch(err => {
      //    toast.error('Opps! Something wrong');
      // });
   }
</script>

<style scoped>
.screen-overlay .create-ticket .content{
   width: 100%;
   height: 94%;
   overflow-y: auto;
}
</style>