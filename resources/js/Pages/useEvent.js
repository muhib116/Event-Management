import { ref } from 'vue'
import axios from 'axios'
import ArtsCulture from "../assets/images/svgs/art.svg"
import Business from '../assets/images/svgs/business.svg'
import Career from '../assets/images/svgs/career.svg'
import Aid from '../assets/images/svgs/aid.svg'
import ChildrenYouth from "../assets/images/svgs/5.svg"
import Community from "../assets/images/svgs/6.svg"
import FashionDesign from "../assets/images/svgs/7.svg"
import FoodDrink from "../assets/images/svgs/8.svg"
import Government from "../assets/images/svgs/9.svg"
import Investments from "../assets/images/svgs/10.svg"
import MediaFilm from "../assets/images/svgs/11.svg"
import MusicPerformances from "../assets/images/svgs/12.svg"
import SchoolsEducation from "../assets/images/svgs/13.svg"
import SpiritualityReligion from "../assets/images/svgs/14.svg"
import SportsFitness from "../assets/images/svgs/15.svg"
import StartupsSmallBusiness from "../assets/images/svgs/16.svg"
import TechnologyScience from "../assets/images/svgs/17.svg"

const eventsCategory = ref([
    {
        src: ArtsCulture,
        name: "Arts Culture",
        isSelected: false
    },
    {
        src: Business,
        name: "Business",
        isSelected: false
    },
    {
        src: Career,
        name: "Career",
        isSelected: false
    },
    {
        src: Aid,
        name: 'Charity & Aid',
        isSelected: false
    },
    {
        src: ChildrenYouth,
        name: "Children & Youth",
        isSelected: false
    },
    {
        src: Community,
        name: "Community",
        isSelected: false
    },
    {
        src: FashionDesign,
        name: "Fashion & Design",
        isSelected: false
    },
    {
        src: FoodDrink,
        name: "Food & Drink",
        isSelected: false
    },
    {
        src: Government,
        name: "Government",
        isSelected: false
    },
    {
        src: Investments,
        name: "Investments",
        isSelected: false
    },
    {
        src: MediaFilm,
        name: "Media & Film",
        isSelected: false
    },
    {
        src: MusicPerformances,
        name: "Music & Performances",
        isSelected: false
    },
    {
        src: SchoolsEducation,
        name: "Schools & Education",
        isSelected: false
    },
    {
        src: SpiritualityReligion,
        name: "Spirituality & Religion",
        isSelected: false
    },
    {
        src: SportsFitness,
        name: "Sports & Fitness",
        isSelected: false
    },
    {
        src: StartupsSmallBusiness,
        name: "Startups & Small Business",
        isSelected: false
    },
    {
        src: TechnologyScience,
        name: "Technology & Science",
        isSelected: false
    }
])

const eventTypes = ref([
    {
        name: 'Single Event',
        isSelected: false
    },
    {
        name: 'Recurring Event',
        isSelected: false
    },
    {
        name: 'One-on-One',
        isSelected: false
    },
])

const eventForm = ref({
    eventType: null,
    name: null,
    description: null,
    location: null,
    url: null,
    locationTips: null,
    map_link: null,
    video_link: null,
    eventCategory: null,
    timezone: null,
    start_date: null,
    start_time: null,
    end_date: null,
    end_time: null,
    website: null,
    instagram: null,
    twitter: null,
    facebook: null,
    settings: {}
})

export default function useEvent(){
    const setActiveEvent = (item) => {
        eventsCategory.value.forEach(event => {
            event.isSelected = (event.name == item.name)
        })
    }

    const setActiveEventType = (item) => {
        eventTypes.value.forEach(type => {
            type.isSelected = (type.name == item.name)
        })
    }

    const _urlParams = new URLSearchParams(window.location.search);
    const getParams = (key) => _urlParams.get(key)    
    
    const getEventId = () => {
        let urlData = window.location.pathname.split('/')
        return urlData.at(-1)
    }

    const getEvent = async (event_id) => {
        let { data } = await axios.get(`event/${event_id}`)
        return data
    }

    return {
        eventsCategory,
        setActiveEvent,
        eventTypes,
        setActiveEventType,
        eventForm,
        getParams,
        getEventId,
        getEvent
    }
}