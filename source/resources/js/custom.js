import datepicker from "js-datepicker";
import naja from "naja";
import netteForms from "nette-forms";
import * as bootstrap from "bootstrap";

export const test = function () {
    console.log('Test custom script...');
}

function fadeOutEffect(element) {
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

export const hideAlert = function () {
    document.addEventListener('click', function (e) {
        if (e.target) {
            if (e.target.getAttribute('role') === 'alert') {
                fadeOutEffect(e.target);
            }
        }
    });
}

export const hideAllAlerts = function () {
    setTimeout(function () {
        Array.from(document.getElementsByClassName("alert")).forEach(
            function (element, index, array) {
                fadeOutEffect(element);
            }
        );
    }, 3000);
}

export const initModal = function () {
    // var myModal = document.getElementById('myModal')
    // var myInput = document.getElementById('myInput')
    //
    // if (myModal) {
    //     myModal.addEventListener('shown.bs.modal', function () {
    //         myInput.show()
    //     })
    // }
}

export const initDatepicker = function () {
    Array.from(document.getElementsByClassName('date-picker')).forEach(
        function (element) {
            datepicker(element, {
                startDay: 1,
                formatter: (input, date, instance) => {
                    input.value = date.toLocaleDateString();
                }
            });
        }
    )
}

export const initAjax = function () {
    naja.snippetHandler.addEventListener('afterUpdate', (event) => {
        if (event.detail.snippet.id === 'snippet--modal') {
            const modals = document.getElementsByClassName('modal');
            Array.from(modals).forEach((modal) => {
                if (modal.classList.contains('close-after-submit')) {
                    Array.from(document.getElementsByClassName('modal-backdrop')).forEach(
                        backdrop => {
                            backdrop.classList.remove('show');
                            backdrop.classList.remove('hide');
                        }
                    )
                    setTimeout(() => {
                        modal.click();
                        const body = document.getElementsByTagName('body')[0];
                        while(body.attributes.length > 0)
                            body.removeAttribute(body.attributes[0].name);

                        Array.from(document.getElementsByClassName('modal-backdrop')).forEach(
                            backdrop => {
                                backdrop.remove();
                            }
                        )

                    }, 150)

                }
            })
        }
    });

    window.Nette = netteForms;
    document.addEventListener('DOMContentLoaded', naja.initialize.bind(naja));
    netteForms.initOnLoad();
}