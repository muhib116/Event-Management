import { ref } from 'vue'

const ticketList = ref([])

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
        questions: [],
        settings: {
            isHidden: false
        },
    }

    const ticketForm = ref({...defaultData})

    const resetTicketForm = () => {
        ticketForm.value = {...defaultData}
    }

    const getEventId = () => {
        let urlData = window.location.pathname.split('/')
        return urlData.at(-1)
    }

    const saveTicket = async (data, eventId) => {
        let { data: op } = await axios.post(`create/ticket/${eventId}`, data)
        return op.status
    }

    const updateTicket = async (payload, id) => {
        let { data } = await axios.post(`update/ticket/${id}`, payload)
        return data.status
    }

    const getTickets = async (eventId) => {
        let { data } = await axios.get(`get/tickets/${eventId}`)
        ticketList.value = data
    }

    const deleteTicket = (ticketId) => {
        return axios.get(`delete/ticket/${ticketId}`)
    }

    const duplicateTicket = (ticketId) => {
        return axios.get(`duplicate/ticket/${ticketId}`)
    }

    return {
        ticketTypes,
        ticketForm,
        placeholderQuestion,
        questions,
        ticketList,
        getEventId,
        saveTicket,
        getTickets,
        resetTicketForm,
        updateTicket,
        duplicateTicket,
        deleteTicket,
    }
}