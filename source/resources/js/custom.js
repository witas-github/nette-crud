export const test = function(){
    console.log('Test custom');
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

export const modalInit = function() {
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })
}

export const createModalWrapper = function() {

}