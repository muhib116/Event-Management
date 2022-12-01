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
                        formData.ticketType = item.name
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
                 <input v-model="formData.ticket_name" name="name" type="text">
              </div>
              <div class="element">
                 <label for="name">Stock</label>
                 <div class="two-columns">
                    <select v-model="formData.ticket_stock" id="tickets_stock">
                       <option value="limited">Limited Stock</option>
                       <option value="unlimited">Unlimited Stock</option>
                    </select>
                    <input v-if="(formData.ticket_stock == 'limited')" v-model="formData.stock_limit" type="number" id="tickets_stock_input">
                 </div>
              </div>
              <div v-if="formData.ticketType == 'paid'" class="element pricing" id="ticket_price">
                 <label for="paid">Price</label>
                 <div class="two-columns">
                    <input type="text" value="$" disabled="">
                    <input v-model="formData.price" type="number">
                 </div>
              </div>

              <div class="element">
                 <label for="name">*Purchase Limit</label>
                 <select v-model="formData.purchase_limit" name="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                 </select>
              </div>
              <div class="element">
                 <label for="name">*Ticket description</label>
                 <textarea v-model="formData.ticket_description" name="Ticket description"></textarea>
              </div>
              <div class="element perks" id="perks">
                 <input v-model="formData.perks" type="text" placeholder="Perks for this ticket" id="perks_input"> 
                 <div class="add-perk" id="add_perk">
                    + Add
                </div>
              </div>
              <div class="element- mb-6">
                 <div class="two-columns">
                    <input type="checkbox" >
                    <label for="perk checkbox">Transfer fees to guest</label>
                 </div>
              </div>
              <h6 class="additional-information-heading">Do you want to collect additional information?</h6>
              <div class="element">
                 <label for="question">Custom question</label>
                 <input type="text" name="question"> 
              </div>
              <div class="element-">
                 <div class="two-columns">
                    <input type="checkbox" name="perk checkbox">
                    <label for="perk checkbox">Make this question required</label>
                 </div>
              </div>
              <div class="add-other-question">
                 <a href="#">Add an other question</a> 
                 <img src="../../../assets/images/star-bars.svg" alt="move-pro icon">
              </div>
              <div class="buttons">
                 <div class="button btn-light">skip</div>
                 <div class="button" @click="test">continue</div>
              </div>
           </div>
        </div>
    </div>
</template>

<script setup>
   import useEvent from '@/Pages/useEvent';
   const { formData, ticketTypes } = useEvent()
    const props = defineProps({
        showPopup: {
            default: 'Test'
        },
        modelValue: {
            type: Boolean
        }
    })

   const test = () => {
      console.log(formData.value)
   }
</script>

<style scoped>
</style>