// get all variables to make ticket
let trigger_make_ticket = document.querySelector('#trigger_make_ticket');
let make_ticket = document.querySelector('#make_ticket');
let screen_overlay = document.querySelector('#screen_overlay');
let exit_create_ticket = document.querySelector('#exit_create_ticket');
let body = document.querySelector('#body'); 
// triggre make ticket
trigger_make_ticket.onclick = function() {
    screen_overlay.style.display = "block";
    make_ticket.classList.remove('hide');
    body.classList.add('no-scroll');
} 
// exit make ticket
exit_create_ticket.onclick = function() {
    screen_overlay.style.display = "none";
    make_ticket.classList.add('hide');
    body.classList.remove('no-scroll');
} 