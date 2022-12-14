<template>
    <div class="event-details event-page event-item" data-item="details"> 
        <h2>Event Details</h2>
        <div class="element">
            <label for="name">*Event Name</label>
            <input name="name" :class="validationFor.name.hasError && 'border-red-500'" type="text" v-model="eventForm.name">
        </div>
        <div class="element">
            <label for="name">*Describe your event</label>
            <textarea rows="15" :class="validationFor.description.hasError && 'border-red-500'" v-model="eventForm.description"></textarea>
        </div>
        <div class="element">
            <label for="location">*Location of event</label>
            <input name="location" :class="validationFor.location.hasError && 'border-red-500'" v-model="eventForm.location" type="text" placeholder="Full Adress">
        </div>
        <div class="element">
            <label for="map_link">Location map link</label>
            <input name="map_link" v-model="eventForm.map_link" type="text" placeholder="Map link">
        </div>

        <div class="element">
            <label for="location">*Use Custom URL</label>
            <div class="input-container">
                <div class="startup">tix.africa/discover/</div>
                <input name="url" type="url" :class="validationFor.url.hasError && 'border-red-500'" required v-model="eventForm.url">
            </div>
        </div>
        <div class="element">
            <label for="location">*Location tips</label>
            <input 
                name="location" 
                type="text" required 
                placeholder="Use an uber, it's the green building on the left, etc"
                :class="validationFor.locationTips.hasError && 'border-red-500'"
                v-model="eventForm.locationTips"
            >
        </div>
        <div class="element">
            <label for="location">Video Link</label>
            <input 
                name="video_link" 
                type="text" required 
                placeholder="Video link"
                v-model="eventForm.video_link"
            >
        </div>
        <h3>What kind of event is it?</h3>
        <p>Select the applicable category for your event</p>


        <!-- desktop kind of event -->
        <div class="kind-of-event ">
            <div 
                v-for="item in eventsCategory" 
                :key="item.name" 
                class="type" :class="(item.isSelected&&'active')"
                @click="() => {
                    setActiveEvent(item)
                    eventForm.eventCategory = item.name
                }"
            >
                <img :src="item.src" />
                <span class="name">
                    {{ item.name }}
                </span>
            </div>
        </div>


        <!-- mobile kind of event -->
        <div class="element mobile">
            <select v-model="eventForm.eventCategory">
                <option v-for="item in eventsCategory" :key="'event-'+item.name" :value="item.name">
                    {{ item.name }}
                </option>
            </select>
        </div>



        <h3>When is your event?</h3>
        <p class="mb-4">Select all the dates of your event</p>
        <div class="when">
            <div class="element">
                <label for="location">*Select TimeZone</label>
                <select :class="validationFor.timezone.hasError && 'border-red-500'" v-model="eventForm.timezone">
                    <option data-time-zone-id="1" data-gmt-adjustment="GMT-12:00" data-use-daylight="0" value="-12">(GMT-12:00) International Date Line West</option>
                    <option data-time-zone-id="2" data-gmt-adjustment="GMT-11:00" data-use-daylight="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
                    <option data-time-zone-id="3" data-gmt-adjustment="GMT-10:00" data-use-daylight="0" value="-10">(GMT-10:00) Hawaii</option>
                    <option data-time-zone-id="4" data-gmt-adjustment="GMT-09:00" data-use-daylight="1" value="-9">(GMT-09:00) Alaska</option>
                    <option data-time-zone-id="5" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                    <option data-time-zone-id="6" data-gmt-adjustment="GMT-08:00" data-use-daylight="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
                    <option data-time-zone-id="7" data-gmt-adjustment="GMT-07:00" data-use-daylight="0" value="-7">(GMT-07:00) Arizona</option>
                    <option data-time-zone-id="8" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                    <option data-time-zone-id="9" data-gmt-adjustment="GMT-07:00" data-use-daylight="1" value="-7">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                    <option data-time-zone-id="10" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Central America</option>
                    <option data-time-zone-id="11" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Central Time (US &amp; Canada)</option>
                    <option data-time-zone-id="12" data-gmt-adjustment="GMT-06:00" data-use-daylight="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                    <option data-time-zone-id="13" data-gmt-adjustment="GMT-06:00" data-use-daylight="0" value="-6">(GMT-06:00) Saskatchewan</option>
                    <option data-time-zone-id="14" data-gmt-adjustment="GMT-05:00" data-use-daylight="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                    <option data-time-zone-id="15" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                    <option data-time-zone-id="16" data-gmt-adjustment="GMT-05:00" data-use-daylight="1" value="-5">(GMT-05:00) Indiana (East)</option>
                    <option data-time-zone-id="17" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                    <option data-time-zone-id="18" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
                    <option data-time-zone-id="19" data-gmt-adjustment="GMT-04:00" data-use-daylight="0" value="-4">(GMT-04:00) Manaus</option>
                    <option data-time-zone-id="20" data-gmt-adjustment="GMT-04:00" data-use-daylight="1" value="-4">(GMT-04:00) Santiago</option>
                    <option data-time-zone-id="21" data-gmt-adjustment="GMT-03:30" data-use-daylight="1" value="-3.5">(GMT-03:30) Newfoundland</option>
                    <option data-time-zone-id="22" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Brasilia</option>
                    <option data-time-zone-id="23" data-gmt-adjustment="GMT-03:00" data-use-daylight="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
                    <option data-time-zone-id="24" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Greenland</option>
                    <option data-time-zone-id="25" data-gmt-adjustment="GMT-03:00" data-use-daylight="1" value="-3">(GMT-03:00) Montevideo</option>
                    <option data-time-zone-id="26" data-gmt-adjustment="GMT-02:00" data-use-daylight="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
                    <option data-time-zone-id="27" data-gmt-adjustment="GMT-01:00" data-use-daylight="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
                    <option data-time-zone-id="28" data-gmt-adjustment="GMT-01:00" data-use-daylight="1" value="-1">(GMT-01:00) Azores</option>
                    <option data-time-zone-id="29" data-gmt-adjustment="GMT+00:00" data-use-daylight="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                    <option data-time-zone-id="30" data-gmt-adjustment="GMT+00:00" data-use-daylight="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                    <option data-time-zone-id="31" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                    <option data-time-zone-id="32" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                    <option data-time-zone-id="33" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                    <option data-time-zone-id="34" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                    <option data-time-zone-id="35" data-gmt-adjustment="GMT+01:00" data-use-daylight="1" value="1">(GMT+01:00) West Central Africa</option>
                    <option data-time-zone-id="36" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Amman</option>
                    <option data-time-zone-id="37" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                    <option data-time-zone-id="38" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Beirut</option>
                    <option data-time-zone-id="39" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Cairo</option>
                    <option data-time-zone-id="40" data-gmt-adjustment="GMT+02:00" data-use-daylight="0" value="2">(GMT+02:00) Harare, Pretoria</option>
                    <option data-time-zone-id="41" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                    <option data-time-zone-id="42" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Jerusalem</option>
                    <option data-time-zone-id="43" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Minsk</option>
                    <option data-time-zone-id="44" data-gmt-adjustment="GMT+02:00" data-use-daylight="1" value="2">(GMT+02:00) Windhoek</option>
                    <option data-time-zone-id="45" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                    <option data-time-zone-id="46" data-gmt-adjustment="GMT+03:00" data-use-daylight="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                    <option data-time-zone-id="47" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Nairobi</option>
                    <option data-time-zone-id="48" data-gmt-adjustment="GMT+03:00" data-use-daylight="0" value="3">(GMT+03:00) Tbilisi</option>
                    <option data-time-zone-id="49" data-gmt-adjustment="GMT+03:30" data-use-daylight="1" value="3.5">(GMT+03:30) Tehran</option>
                    <option data-time-zone-id="50" data-gmt-adjustment="GMT+04:00" data-use-daylight="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
                    <option data-time-zone-id="51" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Baku</option>
                    <option data-time-zone-id="52" data-gmt-adjustment="GMT+04:00" data-use-daylight="1" value="4">(GMT+04:00) Yerevan</option>
                    <option data-time-zone-id="53" data-gmt-adjustment="GMT+04:30" data-use-daylight="0" value="4.5">(GMT+04:30) Kabul</option>
                    <option data-time-zone-id="54" data-gmt-adjustment="GMT+05:00" data-use-daylight="1" value="5">(GMT+05:00) Yekaterinburg</option>
                    <option data-time-zone-id="55" data-gmt-adjustment="GMT+05:00" data-use-daylight="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                    <option data-time-zone-id="56" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
                    <option data-time-zone-id="57" data-gmt-adjustment="GMT+05:30" data-use-daylight="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                    <option data-time-zone-id="58" data-gmt-adjustment="GMT+05:45" data-use-daylight="0" value="5.75">(GMT+05:45) Kathmandu</option>
                    <option data-time-zone-id="59" data-gmt-adjustment="GMT+06:00" data-use-daylight="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
                    <option data-time-zone-id="60" data-gmt-adjustment="GMT+06:00" data-use-daylight="0" value="6">(GMT+06:00) Astana, Dhaka</option>
                    <option data-time-zone-id="61" data-gmt-adjustment="GMT+06:30" data-use-daylight="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
                    <option data-time-zone-id="62" data-gmt-adjustment="GMT+07:00" data-use-daylight="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                    <option data-time-zone-id="63" data-gmt-adjustment="GMT+07:00" data-use-daylight="1" value="7">(GMT+07:00) Krasnoyarsk</option>
                    <option data-time-zone-id="64" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                    <option data-time-zone-id="65" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
                    <option data-time-zone-id="66" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                    <option data-time-zone-id="67" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Perth</option>
                    <option data-time-zone-id="68" data-gmt-adjustment="GMT+08:00" data-use-daylight="0" value="8">(GMT+08:00) Taipei</option>
                    <option data-time-zone-id="69" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                    <option data-time-zone-id="70" data-gmt-adjustment="GMT+09:00" data-use-daylight="0" value="9">(GMT+09:00) Seoul</option>
                    <option data-time-zone-id="71" data-gmt-adjustment="GMT+09:00" data-use-daylight="1" value="9">(GMT+09:00) Yakutsk</option>
                    <option data-time-zone-id="72" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Adelaide</option>
                    <option data-time-zone-id="73" data-gmt-adjustment="GMT+09:30" data-use-daylight="0" value="9.5">(GMT+09:30) Darwin</option>
                    <option data-time-zone-id="74" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Brisbane</option>
                    <option data-time-zone-id="75" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                    <option data-time-zone-id="76" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Hobart</option>
                    <option data-time-zone-id="77" data-gmt-adjustment="GMT+10:00" data-use-daylight="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
                    <option data-time-zone-id="78" data-gmt-adjustment="GMT+10:00" data-use-daylight="1" value="10">(GMT+10:00) Vladivostok</option>
                    <option data-time-zone-id="79" data-gmt-adjustment="GMT+11:00" data-use-daylight="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                    <option data-time-zone-id="80" data-gmt-adjustment="GMT+12:00" data-use-daylight="1" value="12">(GMT+12:00) Auckland, Wellington</option>
                    <option data-time-zone-id="81" data-gmt-adjustment="GMT+12:00" data-use-daylight="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                    <option data-time-zone-id="82" data-gmt-adjustment="GMT+13:00" data-use-daylight="0" value="13">(GMT+13:00) Nuku'alofa</option>
                </select>
            </div>

            <div class="element">
                <label for="location">*Start date</label>
                <div class="date-time">
                    <input :class="validationFor.start_date.hasError && 'border-red-500'" v-model="eventForm.start_date" type="date">
                    <input :class="validationFor.start_time.hasError && 'border-red-500'" v-model="eventForm.start_time" type="time">
                </div>
            </div>
            <div class="element">
                <label for="location">*End date</label>
                <div class="date-time">
                    <input :class="validationFor.end_date.hasError && 'border-red-500'" v-model="eventForm.end_date" type="date">
                    <input :class="validationFor.end_time.hasError && 'border-red-500'" v-model="eventForm.end_time" type="time">
                </div>
            </div>
        </div>



        <h2>Social details</h2>
        <div class="element"> 
            <div class="input-container">
                <div class="startup"><i class="fa-solid fa-link"></i></div>
                <input v-model="eventForm.website" name="Website" type="url" placeholder="Your Website URL">
            </div>
        </div>
        <div class="element"> 
            <div class="input-container">
                <div class="startup"><i class="fa-brands fa-instagram"></i></div>
                <input v-model="eventForm.instagram" name="instagram" type="url" placeholder="Your Instagram Handle">
            </div>
        </div>
        <div class="element"> 
            <div class="input-container">
                <div class="startup"><i class="fa-brands fa-twitter"></i></div>
                <input v-model="eventForm.twitter" name="twitter" type="url" placeholder="Your Twitter Handle">
            </div>
        </div>
        <div class="element"> 
            <div class="input-container">
                <div class="startup"><i class="fa-brands fa-facebook-f"></i></div>
                <input v-model="eventForm.facebook" name="facebook" type="url" placeholder="Your Facebook Handle">
            </div>
        </div>
        <!-- Continue Buttons -->
        <div class="save-or-cancel">
            <Link class="button save" :href="route('dashboard')">Cancel</Link>
            <Link v-show="eventId" class="button save bg-red" :href="route('appearance', eventId)">Continue</Link>
            <div v-show="!eventId" class="button save bg-red" @click="validateThisPage">Continue</div>
        </div>
    </div>
</template>



<script setup>
    import axios from 'axios';
    import { ref, watch } from 'vue'
    import useEvent from '../../../Pages/useEvent.js'
    import { Link } from '@inertiajs/inertia-vue3'

    const props = defineProps({
        callback: {
            type: Function
        }
    })

    const {
        eventsCategory, 
        setActiveEvent,
        eventForm
    } = useEvent()

    let validationFor = ref({
        name: {
            field: 'name',
            title: 'Event Name',
            hasError: false
        },
        description: {
            field: 'description',
            title: 'Event Description',
            hasError: false
        },
        location: {
            field: 'location',
            title: 'Event Location',
            hasError: false
        },
        url: {
            field: 'url',
            title: 'Custom URL',
            hasError: false
        },
        locationTips: {
            field: 'locationTips',
            title: 'Location Tips',
            hasError: false
        },
        timezone: {
            field: 'timezone',
            title: 'Time Zone',
            hasError: false
        },
        start_date: {
            field: 'start_date',
            title: 'Start Date',
            hasError: false
        },
        start_time: {
            field: 'start_time',
            title: 'Start Time',
            hasError: false
        },
        end_date: {
            field: 'end_date',
            title: 'End Date',
            hasError: false
        },
        end_time: {
            field: 'end_time',
            title: 'End Time',
            hasError: false
        }
    })

    
    const eventId = ref(null)
    const validateThisPage = () => 
    {
        let validationStatus = false
        for(let item in validationFor.value){
            let validate = eventForm.value[item]
            validationFor.value[item].hasError = !validate
            validationStatus = validate
        }

        if(validationStatus){
            saveEvent(eventForm.value)
        }
    }

    const saveEvent = async (payload) => {
        
        let { data } = await axios.post('store/event/online-event', payload)
        if(data.id){
            eventId.value = data.id
        }
    }

    watch(eventForm, () => {
        validateThisPage()
    }, {deep: true})
</script>

<style scoped>
    .event-details .element textarea {
        color: var(--dark);
        background-color: #fff;
        background-image: none;
        border-radius: 6px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        height: 140px;
        outline: 0;
        padding: 15px 15px;
        transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
        width: 100%;
    }
</style>