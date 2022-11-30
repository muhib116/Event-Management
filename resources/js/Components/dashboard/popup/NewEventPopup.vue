<template>
    <div v-if="modelValue" id="screen_overlay" class="screen-overlay show">
        <div id="create_new_event" class="create-new-event show">
            <!-- exit creat new -->
            <i @click="$emit('update:modelValue', false)" class="fa-solid exit fa-xmark"></i>
            <!-- create new event elements -->
            <div class="title">New Event</div>
            <div class="options">
                <div class="option">
                    <i class="fa-regular fa-calendar-check"></i>
                    <h3>Live event</h3>
                    <p>An event that takes place at a physical location and attendees join in person</p>
                    <div class="button">Select</div>
                </div>
                <div class="option">
                    <i class="fa-solid fa-desktop"></i>
                    <h3>Online event</h3>
                    <p>A virtual event that takes place online and attendees join using web conferencing services</p>
                    <div class="button">Select</div>
                </div>
            </div>
            <Link href="create/event" class="continue">Continue</Link>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3'
    const props = defineProps({
        modelValue: {
            type: Boolean,
            default: false
        }
    })
</script>

<style lang="scss" scoped>

</style>