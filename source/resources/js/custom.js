import * as animations from "./libs/animations"

export const test = function () {
    console.log('Test custom script...');
}

export const hideAlert = function () {
    document.addEventListener('click', function (e) {
        if (e.target) {
            if (e.target.getAttribute('role') === 'alert') {
                animations.fadeOutAndRemove(e.target);
            }
        }
    });
}

export const hideAllAlerts = function () {
    setTimeout(function () {
        Array.from(document.getElementsByClassName("alert")).forEach(
            function (element, index, array) {
                animations.fadeOutAndRemove(element);
            }
        );
    }, 3000);
}