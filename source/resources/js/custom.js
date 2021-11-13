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