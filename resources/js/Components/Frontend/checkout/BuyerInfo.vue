<template>
    <div> 
        <template v-if="showForm">
            <h2>Buyer Contact Information</h2>
            <div class="eticket-box">
                <p>E-tickets will be sent to your email address, please make sure your email address is correct.</p>
            </div>
            <form @submit="handleForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="inform-cnt">
                            <label for="in1">First Name</label>
                            <input type="text" v-model="form.firstName" placeholder="First Name" class="placeholder-gray-400" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inform-cnt">
                            <label for="in2">Last Name</label>
                            <input type="text" v-model="form.lastName" placeholder="Last Name" class="placeholder-gray-400" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inform-cnt">
                            <label for="in3">Email Address</label>
                            <input type="email" v-model="form.email" placeholder="Email address" class="placeholder-gray-400" required="">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="inform-cnt">
                            <label for="in5">Phone Number</label>
                            <input type="tel" v-model="form.phone" placeholder="Phone Number" class="placeholder-gray-400" required="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="inform-btn">
                        <button class="bg-[#4F4CEE] text-white px-4 py-3 rounded" type="submit">Continue to Payment</button>
                    </div>
                </div>
            </form>
        </template>
        <div v-else class="text-red-500 text-2xl">Your card is empty</div>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import { isEmpty } from 'lodash'
    import useAuth from '@/useAuth.js'
    import axios from 'axios';
    import UseGuestInformation from '@/useGuestInformation.js'

    const { getBrowser, getIp } = UseGuestInformation()
    const props = defineProps({
        event: Object
    })
    const { 
        userInfo,
        isLoading
     } = useAuth()

    const form = ref({
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        settings: {
            browser: null,
            // ip_info: null
        },
        ip_info: {}
    })

    onMounted(async () => {
        form.value.settings.browser = getBrowser()
        let ip = await getIp();
        form.value.ip_info =  ip;
    })


    const showForm = ref(false)
    const cardData = localStorage.cards && JSON.parse(localStorage.cards)
    if(!isEmpty(cardData)){
        showForm.value = true
    }

    if(isLoading){
        const nameArray = userInfo.value.name.split(' ')
        nameArray.push('khushi')
        form.value.firstName = nameArray[0]
        form.value.lastName  = nameArray.splice(1, (nameArray.length-1)).join(' ')
        form.value.email = userInfo.value.email
    }

    const handleForm = async (e) => {
        e.preventDefault()
        let isValid = true
        for(let item in form.value){
            let data = form.value[item]
            if(data==''){
                isValid = false
            }
        }

        if(!isValid) return
        let { data } = await axios.post('guest-create', form.value)
        if(data.status){
            window.location.href = route('payment', props.event.slug)
        }
    }
</script>

<style lang="scss" scoped>

</style>