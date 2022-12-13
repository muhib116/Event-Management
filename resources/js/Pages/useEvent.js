import { ref } from 'vue'
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

const ticketTypes = ref([
    {
        name: 'Free',
        isSelected: true
    },
    {
        name: 'Paid',
        isSelected: false
    },
    {
        name: 'Invite only',
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
        bannerImage: '',
        imageOne: '',
        imageTwo: '',
        imageThree: ''
    }
})

const ticketForm = ref({
    ticketType: null,
    ticket_name: null,
    ticket_stock: null,
    purchase_limit: null,
    ticket_description: null,
    perks: null,
    isTransferFeesToGuest: null,
    stock_limit: null,
    price: null,
    questions: null
})

const insertedEventId = ref(null)

const formDataForFileUpload = ref(new FormData())

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

    return {
        eventsCategory,
        setActiveEvent,
        eventTypes,
        setActiveEventType,
        formDataForFileUpload,
        ticketTypes,
        eventForm,
        insertedEventId
    }
}