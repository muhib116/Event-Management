// The nextStep butoon var
let nextStepButton = document.querySelectorAll('.continue-buttons .button.continue');
let allEventSteps = document.querySelectorAll('.event-creation'); 
// loop through all buttons to toggle hide classes
nextStepButton.forEach((e , index) => {
    e.addEventListener('click' , function () {
        console.log(index);
        allEventSteps[index].classList.add('hide');
        allEventSteps[index + 1].classList.remove('hide'); 
    })
});