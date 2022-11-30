<template>
    <div v-if="modelValue" id="screen_overlay" class="screen-overlay show">
        <div id="create_box_office" class="create-box-office show">
            <!-- exit creat new -->
            <i @click="$emit('update:modelValue', false)" id="exit_create_box_office" class="fa-solid exit fa-xmark"></i>
            <!-- create new event elements -->
            <h3>Upgrade to create a box office</h3>
            <p>on the tix pro plan, you get access to our most loved features including:</p>
            <ul>
                <li>No fees on free tickets</li>
                <li>3.5% + ₦100 fee per paid ticket</li>
                <li>Create recurring events</li>
                <li>Create one on one events</li>
                <li>Unlimited custom fields on checkout</li>
            </ul>
            <p>Tix pro costs NGN4,000 per month. you can pay monthly or annually and cancel at any time.</p>
            <div class="button">Get tix pro</div>
            <a href="#" class="continue-free" id="continue_free">Continue to tix free</a>
        </div>
    </div>
</template>

<script setup>
    import { ref, watchEffect } from 'vue'
    const props = defineProps({
        modelValue: {
            type: Boolean,
            default: false
        }
    })
</script>