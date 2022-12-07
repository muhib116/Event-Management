<template>
    <div v-if="modelValue" id="screen_overlay" class="screen-overlay show">
        <div id="create_new_event" class="create-new-event show">
            <!-- exit creat new -->
            <i @click="$emit('update:modelValue', false)" class="fa-solid exit fa-xmark"></i>
            <!-- create new event elements -->
            <div class="title">New Event</div>
            <div class="options">
                <div 
                    v-for="item in eventType" 
                    class="option" 
                    :class="item.isSelected && 'active'"
                    @click="() => {
                        eventType.forEach(event => {
                            event.isSelected = event.name == item.name
                        })
                    }"
                >
                    <i class="fa-regular fa-calendar-check"></i>
                    <h3>{{ item.name }}</h3>
                    <p>{{ item.description }}</p>
                    <div class="button">Select</div>
                </div>
            </div>
            <Link :href="`create/event/${eventType.find(item=>item.isSelected).name}`" class="continue">Continue</Link>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3'
    const eventType = ref([
        {
            name: 'Live Event',
            description: 'An event that takes place at a physical location and attendees join in person',
            isSelected: true
        }, 
        {
            name: 'Online Event',
            description: 'A virtual event that takes place online and attendees join using web conferencing services',
            isSelected: false
        }
    ])
    const props = defineProps({
        modelValue: {
            type: Boolean,
            default: false
        }
    })
</script>

<style scoped>
    .screen-overlay .create-new-event .options .option.active,
     .screen-overlay .create-new-event .options .option.active .button {
        border-color: var(--normal-orange);
    }

    .screen-overlay .create-new-event .options .option.active>*{
        color: var(--normal-orange)
    }
</style>