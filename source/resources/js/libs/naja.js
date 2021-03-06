import naja from "naja";
import netteForms from "nette-forms";

import { initDatepicker } from "./datepicker";
import { initModal } from "./modal";
import { hideAllAlerts } from "../custom";

export const initAjax = function () {
    naja.snippetHandler.addEventListener('afterUpdate', (event) => {
        if (event.detail.snippet.id === 'snippet--modal') {
            initDatepicker();
            initModal();
        }
    });

    naja.snippetHandler.addEventListener('afterUpdate', (event) => {
        if (event.detail.snippet.id === 'snippet--flashes') {
            hideAllAlerts();
        }
    });

    naja.uiHandler.addEventListener('interaction', (event) => {
        const {element} = event.detail;
        const question = element.dataset.confirm;
        if (question && ! window.confirm(question)) {
            event.preventDefault();
        }
    });

    naja.addEventListener('start', (event) => {
        const spinner = document.getElementById('spinner');
        spinner.classList.add('fade-in');
        spinner.classList.add('show');

        setTimeout(function(){
            spinner.classList.remove('fade-in');
        }, 100);

    });

    naja.addEventListener('complete', (event) => {
        const spinner = document.getElementById('spinner');
        spinner.classList.add('fade-out');

        setTimeout(function(){
            spinner.classList.remove('show');
            spinner.classList.remove('fade-out');
        },200)

    });

    window.Nette = netteForms;
    document.addEventListener('DOMContentLoaded', naja.initialize.bind(naja));
    netteForms.initOnLoad();
}