// toggle active for kind of event
let kindOfEvent = document.querySelectorAll('.kind-of-event .type'); 
kindOfEvent.forEach( type => {
    type.onclick = function () {
        for (let i = 0; i < kindOfEvent.length; i++) {
            kindOfEvent[i].classList.remove('active');
            type.classList.add('active');
        }
    }
});