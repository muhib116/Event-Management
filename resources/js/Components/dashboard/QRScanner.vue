<template>
    <div class="fixed top-0 left-0 right-0 bottom-0 grid items-center justify-center bg-white bg-opacity-50 backdrop-blur-md z-50">
        <div>
            <div class="grid justify-center">
                <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
                    <div v-show="showScanConfirmation"></div>
                </qrcode-stream>
            </div>
            <p class="decode-result text-center mt-4">Last result: <b>{{ result }}</b></p>
            <p class=" text-center mt-2 text-white py-2 px-4 w-full text-lg font-bold" :class="status[apiResponse.type]">
                {{ apiResponse.message }}
            </p>

            <audio ref="errorAudioElement">
                <source :src="errorAudio" type="audio/ogg" />
            </audio>

            <audio ref="successAudioElement">
                <source :src="successAudio" type="audio/mp3" />
            </audio>
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios'
    import { ref, onMounted } from 'vue'
    import errorAudio from '@/assets/audio/error.ogg'
    import successAudio from '@/assets/audio/success.mp3'

    const result = ref(false);
    const camera = ref('auto');
    const showScanConfirmation = ref(false);
    const apiResponse = ref({type: '', message: ''})
    const successAudioElement = ref()
    const errorAudioElement   = ref()
    const status = {
        success: 'bg-green-500',
        error: 'bg-red-500'
    }

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
        let { guest_name, guest_id, ticket_id, ticket_number } = JSON.parse(content)
        result.value = `${guest_name} - ${ticket_number}`

        // ticket_number
        let { type, message } = await axios.post('checkin', {ticket_number}).then(res=>res.data)
        apiResponse.value.type = type
        apiResponse.value.message = message

        if(type == 'success'){
            successAudioElement.value.play()
        }else{
            errorAudioElement.value.play()
        }

        // pause()
        // await timeout(500)
        // unpause()
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

<style>
    .qrcode-stream-camera,
    .qrcode-stream-overlay{
        width: 250px !important;
        display: block;
        aspect-ratio: 1/1;
    }
</style>