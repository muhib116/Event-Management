<template>
    <main class="dashboard">
        <h1 class="text-4xl -m-5 mb-8 px-3 text-center border-b pb-4 border-slate-200 font-black">Welcome to {{ user.type }}  panel</h1> 

        <Widgets />

        <h1 class="text-3xl font-black flex flex-wrap justify-between items-center">
            Your events
            <button class="py-2 px-4 bg-blue-500 text-white rounded-md text-sm font-semibold flex gap-2 items-center justify-center">
                <i class="fas fa-qrcode"></i>
                Check in
            </button>
        </h1>
        <p class="decode-result">Last result: <b>{{ result }}</b></p>
        <!-- <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
            <div v-show="showScanConfirmation" class="scan-confirmation">
                
            </div>
        </qrcode-stream> -->
        <div class="events">

            <div @click="showEventPopup = true" v-show="user.type == 'organizer'" class="create-new cursor-pointer">
                <svg width="20px" height="20px" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"/>
                </svg>
                <p>Create new event</p>
            </div>
            
            <EventCard v-for="(event, index) in events.data" :key="index" :event="event" />
        </div>
        <div class="mt-10 flex justify-center" v-if="events.links && events.data.length">
            <div class="flex flex-wrap -mb-1">
                <div v-for="(link, inde) in events.links" :key="inde">
                    <div v-if="link.url === null" :key="Math.random()+Math.random()" class="mr-1 mb-1 px-4 py-3 bg-white text-sm leading-4 text-gray-800 border rounded" v-html="link.label" />
                    <Link :key="inde" v-else :class="{ 'bg-orange-600 text-white border-orange-600': link.active, 'text-black': !link.active }" class="block mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded bg-white hover:bg-orange-100 hover:border-orange-600 hover:text-black focus:border-orange-500 focus:text-orange-500" :href="link.url">
                        <span v-html="link.label"></span>
                    </Link>
                </div>
            </div>
        </div>
        <div v-else>
            No event found
        </div>

        <NewEventPopup v-model="showEventPopup" />
    </main>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import { reactive, ref } from 'vue'
    import EventCard from './EventCard.vue';
    import NewEventPopup from './popup/NewEventPopup.vue'
    import Widgets from './Widgets.vue' 

    const showEventPopup = ref(false)
    const result = ref(null);
    const camera = ref('auto');
    const showScanConfirmation = ref(false);
    const props = defineProps({
        events: {
            typeof: Array
        },
        user: {
            type: Object,
            default: {}
        }
    });

    async function onInit (promise) {
      try {
        await promise
      } catch (e) {
        console.error(e)
      } finally {
        showScanConfirmation.value = camera.value === "off"
      }
    }

    async function onDecode (content) {
      this.result = content

      this.pause()
      await this.timeout(500)
      this.unpause()
    }

    function unpause () {
      camera.value = 'auto'
    };
    function pause () {
      camera.value = 'off'
    }
    function timeout (ms) {
      return new Promise(resolve => {
        window.setTimeout(resolve, ms)
      })
    }

</script>

<style lang="scss" scoped>
</style>