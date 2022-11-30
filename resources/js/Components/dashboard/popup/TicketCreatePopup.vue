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
                 <div class="button free active">Free</div>
                 <div class="button paid">Paid</div>
                 <div class="button invite-only">Invite only</div>
              </div>
              <div class="element">
                 <label for="name">*Ticket Name</label>
                 <input name="name" type="text">
              </div>
              <div class="element">
                 <label for="name">Stock</label>
                 <div class="two-columns">
                    <select id="tickets_stock">
                       <option value="limited">Limited Stock</option>
                       <option value="unlimited">Unlimited Stock</option>
                    </select>
                    <input type="number" id="tickets_stock_input">
                 </div>
              </div>
              <div class="element pricing hide" id="ticket_price">
                 <label for="paid">Price</label>
                 <div class="two-columns">
                    <input type="text" value="$" disabled="">
                    <input type="number">
                 </div>
              </div>
              <div class="element">
                 <label for="name">*Purchase Limit</label>
                 <select name="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                 </select>
              </div>
              <div class="element">
                 <label for="name">*Ticket description</label>
                 <textarea name="Ticket description"></textarea>
              </div>
              <div class="element perks" id="perks">
                 <input type="text" placeholder="Perks for this ticket" id="perks_input"> 
                 <div class="add-perk" id="add_perk">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </div>
              </div>
              <div class="element">
                 <div class="two-columns">
                    <input type="checkbox" name="perk checkbox">
                    <label for="perk checkbox">Transfer fees to guest</label>
                 </div>
              </div>
              <h6 class="additional-information-heading">Do you want to collect additional information?</h6>
              <div class="element">
                 <label for="question">Custom question</label>
                 <input type="text" name="question"> 
              </div>
              <div class="element">
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
                 <div class="button">continue</div>
              </div>
           </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, watchEffect } from 'vue'
    const props = defineProps({
        showPopup: {
            default: 'Test'
        },
        modelValue: {
            type: Boolean
        }
    })
</script>

<style lang="scss" scoped>

</style>