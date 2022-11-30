// Get needed vars for Account filter 
var list = document.querySelectorAll('.filter-item') ; 
var itemboxes = document.querySelectorAll('.account-item') ;    
// filter loop goes here
for (let i = 0; i < list.length; i++) {
    list[i].addEventListener('click' , function () {
        for (let j = 0; j < list.length; j++) {
        list[j].classList.remove('active')  ;       
        }   
        this.classList.add('active') ;
    datafilter = this.getAttribute("data-filter") ;
    for (let k = 0; k < itemboxes.length; k++) { 
        itemboxes[k].classList.add('hide') ;
        if (itemboxes[k].getAttribute('data-item') == datafilter || datafilter == "all") {
            itemboxes[k].classList.remove('hide')
        }
    }
    })
} 