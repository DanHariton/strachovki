let moment = require('moment');
let insurantHimself = null;
let confirmContract = null;

$(document).ready(function () {
   $('#insurance_startDate').val(moment().format('YYYY-MM-DD'));
    setDate();
    setPrice();
    setTotalAmount();
});

$('#insurance_insuranceDuration').change(function () {
    setDate();
    setPrice();
    setTotalAmount();
});

$('#insurance_startDate').change(function () {
    setDate();
});

function setTotalAmount() {
    $('#insurance-total-amount').empty();
    let totalMonth = $('#insurance_insuranceDuration').val();
    let totalAmount = $('#insurance_price').val();
    let text = '';
    if (totalMonth === '3' || totalMonth === '4') {
        text = ' ' + totalAmount + ' Kč / ' + totalMonth + ' месяца';
    } else {
        text = ' ' + totalAmount + ' Kč / ' + totalMonth + ' месяцев';
    }
    $('#insurance-total-amount').append(text);
}

function setDate() {
    let endDate = moment($('#insurance_startDate').val()).add($('#insurance_insuranceDuration').val(), 'M');
    $('#insurance_endDate').val(endDate.subtract(1, 'days').format('YYYY-MM-DD'));
}

function setPrice() {
    let price = JSON.parse(atob($('#insurance-price').data('array')));
    switch ($('#insurance_insuranceDuration').val())
    {
        case "3":
            $('#insurance_price').val(price.threeMonth);
            break;
        case "4":
            $('#insurance_price').val(price.fourMonth);
            break;
        case "5":
            $('#insurance_price').val(price.fiveMonth);
            break;
        case "6":
            $('#insurance_price').val(price.sixMonth);
            break;
        case "7":
            $('#insurance_price').val(price.sevenMonth);
            break;
        case "8":
            $('#insurance_price').val(price.eightMonth);
            break;
        case "9":
            $('#insurance_price').val(price.nineMonth);
            break;
        case "10":
            $('#insurance_price').val(price.tenMonth);
            break;
        case "11":
            $('#insurance_price').val(price.elevenMonth);
            break;
        case "12":
            $('#insurance_price').val(price.year);
            break;
        default:
            $('#insurance_price').val(price.twoYears);
            break;
    }
}

$('#info-confirmation-check-box').click(function () {
   if ($('#info-confirmation-check-box').hasClass('fa-circle')) {
       $('#info-confirmation-check-box').removeClass('fa-circle color-red').addClass('fa-check-circle fa-check-circle color-green');
       confirmContract = true;
   } else {
       $('#info-confirmation-check-box').removeClass('fa-check-circle fa-check-circle color-green').addClass('fa-circle color-red');
       confirmContract = false;
   }
   checkStatusOrder();
});


$('#insurance_startDate').change(function () {
    if (moment($('#insurance_startDate').val()).month() < moment().month()) {
        alert('Веберите актуальную дату');
        $('#insurance_startDate').val(moment().format('YYYY-MM-DD'));
    }
});

$('#insurantChoseLeft').click(function () {
    insurantHimself = true;
    $('#insurant-data').slideUp();
    $('#insurantChoseLeft').addClass('chosedInsurant');
    $('#insurantChoseRight').removeClass('chosedInsurant');
    $('#insurance_nameInsurant').val($('#insurance_clientName').val());
    $('#insurance_snameInsurant').val($('#insurance_clientSName').val());
    $('#insurance_emailInsurant').val($('#insurance_clientEmail').val());
    $('#insurance_mobileInsurant').val($('#insurance_clientMobile').val());
    $('#insurance_townInsurant').val($('#insurance_town').val());
    $('#insurance_streetInsurant').val($('#insurance_street').val());
    $('#insurance_postCodeInsurant').val($('#insurance_postCode').val());
    $('#insurance_genderInsurant').val($('#insurance_gender').val());
    $('#insurance_dateBirthInsurant_day').val($('#insurance_dateBirth_day').val());
    $('#insurance_dateBirthInsurant_month').val($('#insurance_dateBirth_month').val());
    $('#insurance_dateBirthInsurant_year').val($('#insurance_dateBirth_year').val());
    checkStatusOrder();
});

$('#insurantChoseRight').click(function () {
    insurantHimself = false;
    $('#insurant-data').slideDown();
    $('#insurantChoseRight').addClass('chosedInsurant');
    $('#insurantChoseLeft').removeClass('chosedInsurant');
    $('#insurance_nameInsurant').val("");
    $('#insurance_snameInsurant').val("");
    $('#insurance_emailInsurant').val("");
    $('#insurance_mobileInsurant').val("");
    $('#insurance_townInsurant').val("");
    $('#insurance_streetInsurant').val("");
    $('#insurance_postCodeInsurant').val("");
    $('#insurance_genderInsurant').val("");
    $('#insurance_dateBirthInsurant_day').val("");
    $('#insurance_dateBirthInsurant_month').val("");
    $('#insurance_dateBirthInsurant_year').val("");
    checkStatusOrder();
});

function checkStatusOrder() {
    console.log(confirmContract);
    if (insurantHimself !== null && confirmContract) {
        $('#insurance_save').removeClass('hide');
    } else {
        $('#insurance_save').addClass('hide');
    }
}

