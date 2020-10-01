let moment = require('moment');

$('#insurance_edit_startDate').change(function () {
    let endDate = moment($('#insurance_edit_startDate').val()).add($('#insurance_edit_insuranceDuration').val(), 'M');
    $('#insurance_edit_endDate').val(endDate.subtract(1, 'days').format('YYYY-MM-DD'));
})

$('#insurance_edit_insuranceDuration').change(function () {
    let endDate = moment($('#insurance_edit_startDate').val()).add($('#insurance_edit_insuranceDuration').val(), 'M');
    $('#insurance_edit_endDate').val(endDate.subtract(1, 'days').format('YYYY-MM-DD'));
});
