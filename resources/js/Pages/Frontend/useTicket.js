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
        clearTimeout(timeoutId)
        timeoutId = setTimeout(() => {
            totalQuantity.value = 0
            totalPrice.value = 0
            for(let key in cards){
                totalQuantity.value += cards[key].quantity
                totalPrice.value += (cards[key].price * cards[key].quantity)
            }

        }, 500)
        return totalPrice.value
    }

    let timeoutId = null
    const getTotalWithFees = (cards) => 
    {
        clearTimeout(timeoutId)
        timeoutId = setTimeout(() => {
            totalQuantity.value = 0
            totalPrice.value = 0

            for(let key in cards){
                totalQuantity.value += Number(cards[key].quantity)
                totalPrice.value += (Number(cards[key].price) + Number(cards[key].fees)) * Number(cards[key].quantity)
            }

            totalPrice.value = totalPrice.value != NaN ? Number(totalPrice.value) : 0
        }, 500)
        return totalPrice.value.toFixed(2)
    }

    const getTotalCommission = (cards) => 
    {
        let totalCommission = 0
        for(let key in cards){
            totalCommission += cards[key].fees * cards[key].quantity
        }
        return totalCommission != NaN ? Number(totalCommission) : 0
    }

    const getTicketPrice = (ticket) => {
        if(ticket.isTransferFeesToGuest){
            let price = (Number(ticket.price) + ((Number(ticket.price)/100)*Number(commission.value)))
            // console.log(price)

            return price != NaN ? Number(price) : 0
        }

        return ticket.price
    }

    const getTicketPriceWithoutCommission = (ticket) => {
        if(ticket.isTransferFeesToGuest){
            let price = Number(ticket.price)
            return price != NaN ? Number(price) : 0
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
        getTicketPriceWithoutCommission,
        getTotalCommission
    }
}