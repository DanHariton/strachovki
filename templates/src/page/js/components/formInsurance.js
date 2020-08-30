let insuranceDuration = document.querySelector('#insurance_insuranceDuration');
let insuranceStartDate = document.querySelector('#insurance_startDate');
let insuranceEndDate = document.querySelector('#insurance_endDate');
let insurancePrice = document.querySelector('#insurance_price');
console.log('kuku');
let moment = require('moment');

$('#insurance_insuranceDuration').change(function () {
    let endDate = moment($('#insurance_startDate').val()).add($('#insurance_insuranceDuration').val(), 'M');
    $('#insurance_endDate').val(endDate.subtract(1, 'days').format('YYYY-MM-DD'));
});

