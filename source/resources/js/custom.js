import * as animations from "./libs/animations"

export const hideAlert = function () {
    document.addEventListener('click', function (e) {
        if (e.target) {
            if (e.target.getAttribute('role') === 'alert') {
                animations.fadeOutAndRemove(e.target);
            }
        }
    });
}