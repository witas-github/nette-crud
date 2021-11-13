import * as animations from "./libs/animations"

export const hideAlertByClick = function () {
    document.addEventListener('click', function (e) {
        if (e.target) {
            if (e.target.getAttribute('role') === 'alert') {
                animations.fadeOutAndRemove(e.target);
            }
        }
    });
}

export const hideAllAlerts = function () {
    Array.from(document.getElementsByClassName("alert")).forEach(
        async function (element, index, array) {
            setTimeout(async () => {
                await animations.fadeOutAndRemove(element);
            }, 2000 * (index + 1))
        }
    );
}