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
import { get } from 'lodash'

const isUniqCustomUrl = ref(true)
const eventsCategory = ref([
    {
        src: ArtsCulture,
        name: "Arts Culture",
        slug: "arts-culture",
        isSelected: false
    },
    {
        src: Business,
        name: "Business",
        slug: "business",
        isSelected: false
    },
    {
        src: Career,
        name: "Career",
        slug: "career",
        isSelected: false
    },
    {
        src: Aid,
        name: 'Charity & Aid',
        slug: "charity-and-aid",
        isSelected: false
    },
    {
        src: ChildrenYouth,
        name: "Children & Youth",
        slug: "children-and-youth",
        isSelected: false
    },
    {
        src: Community,
        name: "Community",
        slug: "community",
        isSelected: false
    },
    {
        src: FashionDesign,
        name: "Fashion & Design",
        slug: "fashion-and-design",
        isSelected: false
    },
    {
        src: FoodDrink,
        name: "Food & Drink",
        slug: "food-and-drink",
        isSelected: false
    },
    {
        src: Government,
        name: "Government",
        slug: "government",
        isSelected: false
    },
    {
        src: Investments,
        name: "Investments",
        slug: "investments",
        isSelected: false
    },
    {
        src: MediaFilm,
        name: "Media & Film",
        slug: "media-and-film",
        isSelected: false
    },
    {
        src: MusicPerformances,
        name: "Concerts",
        slug: "concerts",
        isSelected: false
    },
    {
        src: SchoolsEducation,
        name: "Schools & Education",
        slug: "schools-and-education",
        isSelected: false
    },
    {
        src: SpiritualityReligion,
        name: "Spirituality & Religion",
        slug: "spirituality-and-religion",
        isSelected: false
    },
    {
        src: SportsFitness,
        name: "Sports & Fitness",
        slug: "sports-and-fitness",
        isSelected: false
    },
    {
        src: StartupsSmallBusiness,
        name: "Startups & Small Business",
        slug: "startups-and-small-business",
        isSelected: false
    },
    {
        src: TechnologyScience,
        name: "Technology & Science",
        slug: "technology-and-science",
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
    terms_and_conditions: null,
    audience: null,
    attention: null,
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
    settings: {
        streetName: null,
        houseNumber: null,
        postcode: null,
        city: null,
        country: null
    }
})

export default function useEvent(){
    const setActiveEvent = (item) => {
        eventsCategory.value.forEach(event => {
            event.isSelected = (event.slug == item.slug)
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
    const getEventGuest = async (event_id) => {
        let { data } = await axios.get(`event-guest/${event_id}`)
        return data
    }

    const get_banner = (images) => {
        let img = images.find(item => {
            return item.type=='banner'
        })
        if(!get(img, 'path')) return null
        return img.path
    }
    const convertToSlug = (Text) => 
    {
        Text = Text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'')
            .replace(/--/g, '-')
        return Text
    }

    let timeoutId = null
    const validateCustomUrl = (e) => 
    {
        clearTimeout(timeoutId)
        timeoutId = setTimeout(async () => {
            let data = {
                url: e.target.value
            }
            let res = await axios.post('custom-url-validation', data).then(({data}) => data)
            
            isUniqCustomUrl.value = res.status
        })
    }
    return {
        eventsCategory,
        setActiveEvent,
        eventTypes,
        setActiveEventType,
        eventForm,
        getParams,
        getEventId,
        getEvent,
        getEventGuest,
        get_banner,
        convertToSlug,
        validateCustomUrl,
        isUniqCustomUrl
    }
}