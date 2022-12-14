<template>
    <div v-if="modelValue" id="screen_overlay" class="screen-overlay" style="display: block;">
        <div class="create-ticket" id="make_ticket">
           <!-- exit creat new -->
           <i @click="$emit('update:modelValue', false)" class="fa-solid exit fa-xmark"></i>
           <!-- title -->
           <div class="title">Create your tickets</div>
           <!-- content goes here -->
           <div class="content">
               <h6>What kind of ticket is it?</h6>
               <div class="kind-of-ticket">
                  <div 
                     v-for="item in ticketTypes" 
                     :key="item.name" 
                     class="button free" 
                     :class="(item.isSelected&&'active')"
                     @click="() => {
                        myFormData.ticketType = item.name
                        ticketTypes.forEach(ticket => {
                           ticket.isSelected = ticket.name == item.name
                        })
                     }"
                  >
                     {{ item.name }}
                  </div>
               </div>
              <div class="element">
                 <label for="name">*Ticket Name</label>
                 <input :class="validationFor.ticket_name.hasError && 'border-red-500'" v-model="myFormData.ticket_name" name="name" type="text">
              </div>
              <div class="element">
                 <label for="name">Stock</label>
                 <div class="two-columns">
                    <select v-model="myFormData.ticket_stock" id="tickets_stock">
                       <option value="0">-select-</option>
                       <option value="limited">Limited Stock</option>
                       <option value="unlimited">Unlimited Stock</option>
                    </select>
                    <input v-if="(myFormData.ticket_stock == 'limited')" min="1" step="1" v-model="myFormData.stock_limit" type="number" id="tickets_stock_input">
                 </div>
              </div>

              <div v-if="myFormData.ticketType == 'Paid'" class="element pricing" id="ticket_price">
                 <label for="paid">Price</label>
                 <div class="two-columns">
                    <input type="text" value="$" disabled="">
                    <input v-model="myFormData.price" min="0" type="number">
                 </div>
              </div>

              <div class="element">
                 <label for="name">*Purchase Limit</label>
                 <select :class="validationFor.purchase_limit.hasError && 'border-red-500'" v-model="myFormData.purchase_limit" name="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                 </select>
              </div>
              <div class="element">
                 <label for="name">*Ticket description</label>
                 <textarea :class="validationFor.ticket_description.hasError && 'border-red-500'" v-model="myFormData.ticket_description" name="Ticket description"></textarea>
              </div>
              <div class="element perks" id="perks">
                  <input v-model="myFormData.perks" type="text" placeholder="Perks for this ticket" id="perks_input"> 
                  <div class="add-perk" id="add_perk">
                     + Add
                  </div>
              </div>
              <div class="element- mb-6">
                 <div class="two-columns">
                    <input type="checkbox" value="1" v-model="myFormData.isTransferFeesToGuest" >
                    <label>Transfer fees to guest</label>
                 </div>
              </div>
              <h6 class="additional-information-heading">Do you want to collect additional information?</h6>
              
               <template v-for="(item, index) in questions" :key="index">
                  <div class="element">
                     <label for="question">Custom question</label>
                     <input type="text" v-model="item.question" name="question"> 
                  </div>
                  <div class="element-">
                     <div class="two-columns relative">
                        <button
                           v-if="(index != 0)" 
                           class="text-sm absolute right-0 bottom-4 text-red-500"
                           @click="() => {
                              questions.splice(index, 1)
                           }"
                        >
                           Remove
                        </button>
                        <input type="checkbox" v-model="item.isRequired" value="1" :checked="item.isRequired">
                        <label for="perk checkbox">Make this question required</label>
                     </div>
                  </div>
               </template>

              <div class="add-other-question mt-8">
                 <button 
                     @click="() => {
                        questions.push(placeholderQuestion)
                        formData.questions
                     }"
                 >Add an other question</button> 
                 <img src="../../../assets/images/star-bars.svg" alt="move-pro icon">
              </div>

              <div class="buttons">
                 <!-- <div class="button btn-light">skip</div> -->
                 <div class="button" @click="nextStep">continue</div>
              </div>
           </div>
        </div>
    </div>
</template>

<script setup>
   import { ref, watch, onMounted } from 'vue'
   import useEvent from '@/Pages/useEvent';

   const placeholderQuestion = {
         question: '',
         isRequired: false
   }
   const questions = ref([
      { ...placeholderQuestion }
   ])

   const { myFormData, formData, ticketTypes } = useEvent()
   const props = defineProps({
      modelValue: {
         type: Boolean
      }
   })
   onMounted(() => {
      myFormData.value.ticketType = 'Free'
   })
   watch(questions.value, (value) => {
      myFormData.value.questions = questions.value
   }, {deep: true})

   let validationFor = ref({
      ticket_name: {
         field: 'ticket_name',
         title: 'Ticket Name',
         hasError: false
      },
      purchase_limit: {
         field: 'purchase_limit',
         title: 'Purchase Limit',
         hasError: false
      },
      ticket_description: {
         field: 'ticket_description',
         title: 'Ticket Description',
         hasError: false
      }
   })

   const validateThisPage = () => 
    {
        let validationStatus = false
        for(let item in validationFor.value){
            let myFormDataHasProperty = myFormData.value.hasOwnProperty(item)
            validationFor.value[item].hasError = !myFormDataHasProperty
            validationStatus = myFormDataHasProperty
        }
       
        return validationStatus
    }


   const nextStep = () => {
      if(!validateThisPage()){
         alert(`Required field must not be empty!`)
         return
      }

      myFormData.value.question = questions
      console.log(myFormData, formData)

      // const form = useForm(myFormData.value)
      // form.post(route('event.store', myFormData.value.eventType), {
      //    preserveScroll: true,
      //    onSuccess: (ev) => {
      //       console.log(ev);
      //       form.reset('password')
      //    },
      // })
   }
</script>

<style scoped>
.screen-overlay .create-ticket .content{
   width: 100%;
   height: 94%;
   overflow-y: auto;
}
</style>