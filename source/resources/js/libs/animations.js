export const fadeOutAndRemove = function(element) {
    element.classList.add('fade-out');

    setTimeout(function(){
        element.remove()
    },200);

}