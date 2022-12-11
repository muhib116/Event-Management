/////////////////////////////////////
// show and hide the creat new tab //
/////////////////////////////////////

///+++ GET VARIABLES +++///
// screen overlay variable
let screen_overlay = document.querySelector('#screen_overlay');
// create new event variables
let create_new_event = document.querySelector('#create_new_event');
let triggre_create_new = document.querySelector('#triggre_create_new');
let exit_create_new = document.querySelector('#exit_create_new');
// create box office variables 
let create_box_office = document.querySelector('#create_box_office');
let triggre_create_box_office = document.querySelector('#triggre_create_box_office'); 
let exit_create_box_office = document.querySelector('#exit_create_box_office');
let continue_free = document.querySelector('#continue_free');

///+++ START FUNCTIONS +++///
/// Toggle Show/Hide for create new event ///
triggre_create_new.onclick = function () {
    screen_overlay.classList.add('show');
    create_new_event.classList.add('show');
    body.classList.add('no-scroll');
} 
exit_create_new.onclick = function () {
    screen_overlay.classList.remove('show');
    create_new_event.classList.remove('show');
    body.classList.remove('no-scroll');
} 
/// Toggle Show/Hide for create box office /// 
triggre_create_box_office.onclick = function () {
    screen_overlay.classList.add('show');
    create_box_office.classList.add('show');
    body.classList.add('no-scroll');
} 
exit_create_box_office.onclick = function () {
    screen_overlay.classList.remove('show');
    create_box_office.classList.remove('show');
    body.classList.remove('no-scroll');
} 
continue_free.onclick = function () {
    screen_overlay.classList.remove('show');
    create_box_office.classList.remove('show');
    body.classList.remove('no-scroll');
}  


///////////////////////////////////////
// Toggle selection for create event //
///////////////////////////////////////

///+++ GET VARIABLES +++///
let create_new_options = document.querySelectorAll('#create_new_event .options .option');
create_new_options.forEach( option => {
    option.onclick = function () {
        for (let i = 0; i < create_new_options.length; i++) {
            create_new_options[i].classList.remove('selected');
            option.classList.add('selected');
        }
    }
});
