import { ref } from 'vue'
 
const totalQuantity = ref(0)
const totalPrice = ref(0)
const cards = ref({})
const commission = ref(0) //in percentage

export default function useTicket() {
    const addCardData = (ticket, cards, quantity) => {
        let _commission = (ticket.isTransferFeesToGuest) ? commission.value : 0
        let cardData = {
            id: ticket.id,
            name: ticket.ticket_name,
            type: ticket.ticketType,
            isTransferFeesToGuest: ticket.isTransferFeesToGuest,
            quantity: quantity.value,
            price: ticket.price,
            fees: (ticket.price/100) * _commission
        }
        cards.value[`ticket_${ticket.id}`] = cardData

        if(cards.value[`ticket_${ticket.id}`].quantity == 0){
            delete cards.value[`ticket_${ticket.id}`]
        }
    }

    const getTotal = (cards) => 
    {
        totalQuantity.value = 0
        totalPrice.value = 0
        for(let key in cards){
            totalQuantity.value += cards[key].quantity
            totalPrice.value += (cards[key].price * cards[key].quantity)
        }

        return totalPrice
    }

    const getTotalWithFees = (cards) => 
    {
        totalQuantity.value = 0
        totalPrice.value = 0
        for(let key in cards){
            totalQuantity.value += cards[key].quantity
            totalPrice.value += (cards[key].price + cards[key].fees) * cards[key].quantity
        }

        totalPrice.value = +totalPrice.value.toFixed(2)

        return totalPrice
    }

    const getTotalCommission = (cards) => 
    {
        let totalCommission = 0
        for(let key in cards){
            totalCommission += cards[key].fees * cards[key].quantity
        }

        return totalCommission
    }

    const getTicketPrice = (ticket) => {
        if(ticket.isTransferFeesToGuest){
            return (ticket.price + ((ticket.price/100)*commission.value)).toFixed(2)
        }

        return ticket.price
    }

    return {
        cards,
        addCardData,
        getTotal,
        getTotalWithFees,
        totalQuantity,
        totalPrice,
        commission,
        getTicketPrice,
        getTotalCommission
    }
}