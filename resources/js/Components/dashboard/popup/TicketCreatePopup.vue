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
                        ticketForm.ticketType = item.name
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
                 <input :class="validationFor.ticket_name.hasError && 'border-red-500'" v-model="ticketForm.ticket_name" name="name" type="text">
              </div>
              <div class="element">
                 <label for="name">*Stock</label>
                 <div class="two-columns">
                    <select :class="validationFor.ticket_stock.hasError && 'border-red-500'" v-model="ticketForm.ticket_stock" id="tickets_stock">
                       <option :value="null">-select-</option>
                       <option value="limited">Limited Stock</option>
                       <option value="unlimited">Unlimited Stock</option>
                    </select>
                    <input v-if="(ticketForm.ticket_stock == 'limited')" min="1" step="1" v-model="ticketForm.stock_limit" type="number" id="tickets_stock_input">
                 </div>
              </div>

              <div v-show="ticketForm.ticketType == 'Paid'" class="element pricing" id="ticket_price">
                 <label for="paid">Price</label>
                 <div class="two-columns">
                    <input type="text" value="$" disabled="">
                    <input v-model="ticketForm.price" min="0" type="number">
                 </div>
              </div>

              <div class="element">
                 <label for="name">*Purchase Limit</label>
                 <select :class="validationFor.purchase_limit.hasError && 'border-red-500'" v-model="ticketForm.purchase_limit" name="">
                    <option v-for="n in 15" :key="n" :value="n">{{ n }}</option>
                 </select>
              </div>
              <div class="element">
                 <label for="name">*Ticket description</label>
                 <textarea :class="validationFor.ticket_description.hasError && 'border-red-500'" v-model="ticketForm.ticket_description" name="Ticket description"></textarea>
              </div>
              <div class="element perks" id="perks">
                  <input v-model="ticketForm.perks" type="text" placeholder="Perks for this ticket" id="perks_input"> 
                  <!-- <div class="add-perk" id="add_perk">
                     + Add
                  </div> -->
              </div>
              <div class="element- mb-6">
                 <div class="two-columns">
                    <input type="checkbox" v-model="ticketForm.isTransferFeesToGuest" value="1" :checked="Boolean(ticketForm.isTransferFeesToGuest)"  >
                    <label>Transfer fees to guest</label>
                 </div>
              </div>

              <h6 class="additional-information-heading">Do you want to collect additional information?</h6>
              
               <template v-for="(item, index) in ticketForm.questions" :key="index">
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
                        <input type="checkbox" v-model="item.isRequired" value="1" :checked="Boolean(item.isRequired)">
                        <label for="perk checkbox">Make this question required</label>
                     </div>
                  </div>
               </template>

              <div class="add-other-question mt-8">
                 <button 
                     @click="() => {
                        ticketForm.questions.push({...placeholderQuestion})
                     }"
                 >+ Add an other question</button> 
              </div>

              <div class="buttons">
                 <!-- <div class="button btn-light">skip (go to event publish page)</div> -->
                 <div v-if="!editable" class="button" @click="save(ticketForm)">Create</div>
                 <div v-else class="button" @click="update(ticketForm)">Update</div>
              </div>
           </div>
        </div>
    </div>
</template>

<script setup>
   import { ref, onMounted } from 'vue'
   import useTicket from '@/Pages/useTicket'
   import { useToast } from "vue-toastification"

   const props = defineProps({
      userId: [String, Number],
      modelValue: {
         type: Boolean
      },
      callback: {
         type: Function,
         default: () => {}
      },
      editable: {
         type: Boolean,
         default: false
      },
      data: {
         type: Object,
         default: {}
      }
   })
   const toast = useToast();
   const { 
      ticketTypes, 
      ticketForm, 
      placeholderQuestion, 
      questions, 
      resetTicketForm, 
      saveTicket, 
      getEventId, 
      getTickets, 
      updateTicket
   } = useTicket()


   onMounted(() => {
      ticketForm.value.ticketType = 'Free'
      if(props.editable){
         ticketForm.value = props.data
      }
   })

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
      },
      ticket_stock: {
         field: 'ticket_stock',
         title: 'Ticket Stock',
         hasError: false
      }
   })

   const validateThisPage = () => 
   {
      let validationStatus = false
      for(let item in validationFor.value){
         let isValid = ticketForm.value[item]
         validationFor.value[item].hasError = !isValid
         validationStatus = isValid
      }
      
      if(ticketForm.value.ticket_stock == 'limited' && ticketForm.value.stock_limit==null){
         validationStatus = false
      }

      return validationStatus
   }

   const emit = defineEmits()
   const save = async (payload) => {
      if(!validateThisPage()){
         toast.error("Required field must not be empty!", {
            timeout: 2000,
            position: "top-center",
         })
         return
      }

      payload.user_id = props.userId
      let res = await saveTicket(payload, getEventId())
      if(res.statusText == 'OK'){
         toast.success("Ticket created!", {
            timeout: 2000,
            position: "top-center",
         })

         resetTicketForm()
         getTickets(getEventId())
         props.callback()
         emit('update:modelValue', false)
         return
      }
      toast.error("Something went wrong!", {
         timeout: 2000,
         position: "top-center",
      })
   }

   const update = (data) => {
      let res = updateTicket(data, data.id)
      if(res){
         toast.success("Ticket updated!", {
            timeout: 2000,
            position: "top-center",
         })
         getTickets(getEventId())
         emit('update:modelValue', false)
         return
      }
      toast.error("Something went wrong!", {
         timeout: 2000,
         position: "top-center",
      })
   }
</script>

<style scoped>
.screen-overlay .create-ticket .content{
   width: 100%;
   height: 94%;
   overflow-y: auto;
}
</style>