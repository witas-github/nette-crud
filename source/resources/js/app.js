import naja from 'naja';
import netteForms from 'nette-forms';
import * as custom from './custom';

window.Nette = netteForms;
document.addEventListener('DOMContentLoaded', naja.initialize.bind(naja));
netteForms.initOnLoad();

custom.test();
custom.hideAlert();
custom.hideAllAlerts();
custom.initModal();
custom.initDatepicker();

