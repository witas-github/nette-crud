import * as animations from './animations';

export const initModal = function () {
    Array.from(document.getElementsByClassName('modal-close')).forEach(
        function (element) {
            element.addEventListener('click', function() {
                const modal = document.getElementById(element.getAttribute('data-target'));
                animations.fadeOutAndRemove(modal);
            })
        }
    )
}