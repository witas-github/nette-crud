import datepicker from "js-datepicker";

export const test = function(){
    console.log('Test custom script...');
}

function fadeOutEffect(element){
    let fadeEffect = setInterval(function () {
        if (!element.style.opacity) {
            element.style.opacity = 1;
        }
        if (element.style.opacity > 0) {
            element.style.opacity -= 0.1;
        } else {
            clearInterval(fadeEffect);
            element.remove();
        }
    }, 100);
}

export const hideAlert = function(){
    document.addEventListener('click',function(e){
        if(e.target){
            if (e.target.getAttribute('role') === 'alert') {
                fadeOutEffect(e.target);
            }
        }
    });
}

export const hideAllAlerts = function(){
    setTimeout( function() {
        Array.from(document.getElementsByClassName("alert")).forEach(
            function(element, index, array) {
                fadeOutEffect(element);
            }
        );
    }, 3000);
}

export const initModal = function() {
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    if (myModal) {
        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    }
}

export const initDatepicker = function() {
Array.from(document.getElementsByClassName('date-picker')).forEach(
    function(element){
        datepicker(element,{
            startDay: 1,
            formatter: (input, date, instance) => {
                input.value = date.toLocaleDateString();
            }
        });
    }
)




}
