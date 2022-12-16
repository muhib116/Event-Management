import { ref } from 'vue'
export default function useTicket()
{
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

    const placeholderQuestion = {
        question: '',
        isRequired: false
    }
    const questions = ref([
        { ...placeholderQuestion }
    ])

    const defaultData = {
        ticketType: null,
        ticket_name: null,
        ticket_stock: null,
        stock_limit: null,
        price: null,
        purchase_limit: null,
        ticket_description: null,
        perks: null,
        isTransferFeesToGuest: null,
        questions: null,
        settings: {},
    }

    const ticketForm = ref({...defaultData})

    const resetTicketForm = () => {
        ticketForm.value = {...defaultData}
    }

    const getEventId = () => {
        let urlData = window.location.pathname.split('/')
        return urlData.at(-1)
    }

    const saveTicket = (data, eventId) => {
        return axios.post(`create/ticket/${eventId}`, data)
    }

    const deleteTicket = (eventId) => {
        return axios.post(`delete/ticket/${eventId}`)
    }

    const getTickets = async (eventId) => {
        let { data } = await axios.get(`get/tickets/${eventId}`)
        return data
    }

    return {
        ticketTypes,
        ticketForm,
        placeholderQuestion,
        questions,
        getEventId,
        saveTicket,
        getTickets,
        resetTicketForm
    }
}