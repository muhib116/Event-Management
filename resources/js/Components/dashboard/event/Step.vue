<template>
    <div class="steps" :style="{ '--width': step==2 ? '50%' : step==3 ? '100%' : 0 }">
        <div class="step first">
           <div class="icon active">
              <i v-if="(step<=3)" class="fa-solid fa-check"></i>
           </div>
           <span>Details</span>
        </div>
        <div class="step second">
           <div class="icon active">
              <i v-if="(step<=3 && step>=2)" class="fa-solid fa-check"></i>
           </div>
           <span>Appearance</span>
        </div>
        <div class="step third">
           <div class="icon active">
              <i v-if="(step==3)" class="fa-solid fa-check"></i>
           </div>
           <span>Tickets</span>
        </div>
     </div>
</template>

<script setup>
    defineProps({
        step: {
            default: 1
        }
    })
</script>

<style scoped>
.event-creation .steps .step.first{
    margin-left: -10px;
}
.event-creation .steps .step.third{
    margin-right: -10px;
}
.event-creation.step-3 .steps:before{
    width: var(--width);
}
</style>