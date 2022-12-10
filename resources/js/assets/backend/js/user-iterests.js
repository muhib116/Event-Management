// Get all user interests variables
let user_interests = document.querySelectorAll('#user_interests .type');
// choose 3 user interests function
user_interests.forEach( e => {
    e.onclick = function () {
        let active_user_interests = document.querySelectorAll('#user_interests .type.active');
        if (e.classList.contains('active')) {
            e.classList.remove('active');
        } else {
            if (active_user_interests.length == 3) {
                alert('Select a maximum of 3 interests')
            } else {
                e.classList.add('active');
            }
        }
    }
});