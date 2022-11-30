// ticket kinds vars
let ticket_kinds = document.querySelectorAll('.kind-of-ticket .button');
let free_ticket = document.querySelector('.kind-of-ticket .button.free');
let paid_ticket = document.querySelector('.kind-of-ticket .button.paid');
let invite_only_ticket = document.querySelector('.kind-of-ticket .button.invite-only');
let ticket_price = document.querySelector('#ticket_price');
// tickets stock vars
let tickets_stock = document.querySelector('#tickets_stock'); 
let tickets_stock_input = document.querySelector('#tickets_stock_input'); 
// function to toggle active class 
ticket_kinds.forEach( e => {
    e.onclick = function () {
        if (e.classList.contains('invite-only')) {
            tickets_stock.setAttribute('disabled' , '');
            tickets_stock_input.setAttribute('disabled' , ''); 
            if (free_ticket.classList.contains('active')) {
                invite_only_ticket.classList.add('active');
            }
        } 
        else if (e.classList.contains('invite-only')) { 
            tickets_stock.removeAttribute('disabled'); 
            tickets_stock_input.removeAttribute('disabled');  
            if (paid_ticket.classList.contains('active')) {
                invite_only_ticket.classList.add('active');
            }
        } 
        else {
            for (let i = 0; i < ticket_kinds.length; i++) {
                tickets_stock.removeAttribute('disabled');
                tickets_stock_input.removeAttribute('disabled'); 
                ticket_kinds[i].classList.remove('active');
            };
        }
        e.classList.add('active');  
        if (paid_ticket.classList.contains('active')) {
            ticket_price.classList.remove('hide');
        } else {
            ticket_price.classList.add('hide');
        }
    }
}); 