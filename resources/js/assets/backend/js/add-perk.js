// get button and container and the main input vars
let add_perk = document.querySelector('#add_perk');
let perks_container = document.querySelector('#perks');
let perks_input = document.querySelector('#perks_input'); 
// start function
let perksCounter = 0;
add_perk.onclick = function () {
    if (perks_input.value == "") {
        alert('Please type something first')
    } else {
        const created_perk = document.createElement("input");
        created_perk.value = perks_input.value;
        perks_container.appendChild(created_perk);
        perks_container.insertBefore(created_perk, perks_container.children[perksCounter]);
        perks_input.value = "";
        perksCounter++ 
    }
}
