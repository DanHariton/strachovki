let moment = require('moment');

$('#insurance_edit_insuranceDuration').change(function () {
    let endDate = moment($('#insurance_edit_startDate').val()).add($('#insurance_edit_insuranceDuration').val(), 'M');
    $('#insurance_edit_endDate').val(endDate.subtract(1, 'days').format('YYYY-MM-DD'));
    let price = JSON.parse(atob($('#insurance-price').data('array')));
    switch ($('#insurance_edit_insuranceDuration').val())
    {
        case "3":
            $('#insurance_edit_price').val(price.threeMonth);
            break;
        case "4":
            $('#insurance_edit_price').val(price.fourMonth);
            break;
        case "5":
            $('#insurance_edit_price').val(price.fiveMonth);
            break;
        case "6":
            $('#insurance_edit_price').val(price.sixMonth);
            break;
        case "7":
            $('#insurance_edit_price').val(price.sevenMonth);
            break;
        case "8":
            $('#insurance_edit_price').val(price.eightMonth);
            break;
        case "9":
            $('#insurance_edit_price').val(price.nineMonth);
            break;
        case "10":
            $('#insurance_edit_price').val(price.tenMonth);
            break;
        case "11":
            $('#insurance_edit_price').val(price.elevenMonth);
            break;
        case "12":
            $('#insurance_edit_price').val(price.year);
            break;
        default:
            $('#insurance_edit_price').val(price.twoYears);
            break;
    }
});
