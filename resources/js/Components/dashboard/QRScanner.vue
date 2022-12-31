<template>
    <div v-if="modelValue" class="fixed top-0 left-0 right-0 bottom-0 grid items-center justify-center bg-white bg-opacity-50 backdrop-blur-md z-50">
        <i 
            @click="() => {
                $emit('update:modelValue', false);
                camera = false
            }" 
            class="fa-solid exit fa-xmark absolute top-4 right-4 text-4xl cursor-pointer hover:text-red-600"
        ></i>
        <div>
            <p v-if="initError" class=" text-center mt-2 text-white py-2 px-4 w-full text-lg font-bold bg-red-500">
                {{ initError }}
            </p>

            <div class="grid justify-center">
                <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
                    <!-- <button @click="switchCamera">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0z"/><path d="M9 3h6l2 2h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4l2-2zm5.684 15.368-.895-1.79A4 4 0 0 1 8 13h2.001L7.839 8.677a6 6 0 0 0 6.845 9.69zM9.316 7.632l.895 1.79A4 4 0 0 1 16 13h-2.001l2.161 4.323a6 6 0 0 0-6.845-9.69z"/></svg>
                    </button> -->
                    <div v-show="showScanConfirmation"></div>
                </qrcode-stream>
            </div>
            <p v-if="result" class="decode-result text-center mt-4">Last result: <b>{{ result }}</b></p>
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

    const props = defineProps({
        isCameraOpen: Boolean,
        modelValue: {
            type: Boolean,
            default: false
        }
    })

    const noRearCamera = ref(false)
    const noFrontCamera = ref(false)
    const result = ref(null);
    const camera = ref(props.isCameraOpen);
    const showScanConfirmation = ref(false);
    const apiResponse = ref({type: '', message: ''})
    const successAudioElement = ref()
    const errorAudioElement   = ref()
    const status = {
        success: 'bg-green-500',
        error: 'bg-red-500'
    }
    const initError = ref('')
    async function onInit (promise) {
        try {
            await promise
        } catch (error) {
            if (error.name === 'NotAllowedError') {
                initError.value = "ERROR: you need to grant camera access permission"
            } else if (error.name === 'NotFoundError') {
                initError.value = "ERROR: no camera on this device"
            } else if (error.name === 'NotSupportedError') {
                initError.value = "ERROR: secure context required (HTTPS, localhost)"
            } else if (error.name === 'NotReadableError') {
                initError.value = "ERROR: is the camera already in use?"
            } else if (error.name === 'OverconstrainedError') {
                initError.value = "ERROR: installed cameras are not suitable"
            } else if (error.name === 'StreamApiNotSupportedError') {
                initError.value = "ERROR: Stream API is not supported in this browser"
            } else if (error.name === 'InsecureContextError') {
                initError.value = 'ERROR: Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.';
            } else {
                initError.value = `ERROR: Camera error (${error.name})`;
            }
        } finally {
            showScanConfirmation.value = camera === false
        }
    }

    const onDecode = async (content) => 
    {
        let { guest_name, guest_id, ticket_id, ticket_number } = content ? JSON.parse(content) : {}
        result.value = guest_name && `${guest_name} - ${ticket_number}`

        // ticket_number
        let { type, message } = await axios.post('checkin', {ticket_number}).then(res=>res.data)
        apiResponse.value.type = type
        apiResponse.value.message = message

        if(type == 'success'){
            successAudioElement.value.play()
        }else{
            errorAudioElement.value.play()
        }

        pause()
        setTimeout(unpause, 5000)
    }

    const unpause = () => {
        camera.value = true
    }
    const pause = () => {
        camera.value = false
    }
    const switchCamera = () => {
      switch (this.camera) {
        case 'front':
          camera = 'rear'
          break
        case 'rear':
          camera = 'front'
          break
      }
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