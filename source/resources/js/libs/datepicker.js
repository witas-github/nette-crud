import datepicker from "js-datepicker";

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