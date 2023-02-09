<template>
    <div v-if="modelValue" id="screen_overlay" class="screen-overlay show">
        <div id="create_new_event" class="create-new-event show">
            <i @click="$emit('update:modelValue', false)" class="fa-solid exit fa-xmark"></i>
            <div class="title">New Event</div>
            <div class="options">
                <div 
                    v-for="(item, index) in eventType" 
                    :key="index"
                    class="option hover:border-[var(--brand\_color)] text-[var(--brand\_color)]" 
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
                    <div class="button hover:!border-[var(--brand\_color)]">Select</div>
                </div>
            </div>
            <Link :href="`create/event/${eventType.find(item=>item.isSelected).key}`" class="continue bg-[var(--brand\_color)]">Continue</Link>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3'
    const eventType = ref([
        {
            name: 'Live Event',
            key: 'live-event',
            description: 'An event that takes place at a physical location and attendees join in person',
            isSelected: true
        }, 
        {
            name: 'Online Event',
            key: 'online-event',
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
        border-color: var(--brand_color);
    } 
     .screen-overlay .create-new-event .options .button:hover {
        border-color: var(--brand_color);
    }

    .screen-overlay .create-new-event .options .option.active>*{
        color: var(--brand_color)
    }

    .screen-overlay .create-new-event .options .option:hover i, .screen-overlay .create-new-event .options .option:hover h3, .screen-overlay .create-new-event .options .option:hover p, .screen-overlay .create-new-event .options .option:hover .button {
        color: var(--brand_color)
    }
    .screen-overlay .create-new-event .options .option:hover, .screen-overlay .create-new-event .options .option:hover .button:hover {
        color: var(--brand_color) !important
    }
    .option:hover .button {
        border-color: var(--brand_color);
    }
</style>