let moment = require('moment');
let insurantHimself = null;
let confirmContract = null;
const INSURANCE_MAXIMA = 'maxima';
const PRICE_URGENT_MAXIMA = 'maximaUrgent';
const PRICE_URGENT_MAXIMA_MID = 'maximaUrgentMid';
const PRICE_URGENT_MAXIMA_OLD = 'maximaUrgentOld';
const PRICE_MAXIMA = 'maxima';
const PRICE_MAXIMA_MEDIUM = 'maximaMedium';
const PRICE_MAXIMA_YOUNG = 'maximaYoung';
const PRICE_MAXIMA_OLD = 'maximaOld';
const INSURANCE_UNIQA = 'uniqa';
const PRICE_UNIQA = 'uniqa';
const PRICE_UNIQA_MEDIUM = 'uniqaMedium';
const PRICE_UNIQA_CHILD = 'uniqaChild';
const PRICE_UNIQA_YOUNG = 'uniqaYoung';
const PRICE_UNIQA_OLD = 'uniqaOld';
const PRICE_UNIQA_SENIOR = 'uniqaSenior';
const PRICE_UNIQA_MID = 'uniqaMid';
const INSURANCE_PVZP = 'pvzp';
const PRICE_PVZP = 'pvzp';
const PRICE_PVZP_MEDIUM = 'pvzpMedium';
const PRICE_PVZP_CHILD = 'pvzpChild';
const PRICE_PVZP_YOUNG = 'pvzpYoung';
const PRICE_PVZP_OLD = 'pvzpOld';
const PRICE_PVZP_SENIOR = 'pvzpSenior';
const PRICE_PVZP_MID = 'pvzpMid';
const INSURANCE_ERGO = 'ergo';
const PRICE_ERGO = 'ergo';
const PRICE_ERGO_MEDIUM = 'ergoMedium';
const PRICE_ERGO_YOUNG = 'ergoYoung';
const PRICE_ERGO_OLD = 'ergoOld';
const COMPLEX_INSURANCE = 'complex';
const URGENT_INSURANCE = 'urgent';

let startMonth = moment(moment().year() + '-' + (moment().month() + 1) + '-01');
let insuranceSelected = null;
let insuranceType = null;
let insurancePriceListIndex = null;
let insurancePriceListIndexDefault = null;
let priceListAll = null;

$(document).ready(function () {
    priceListAll = JSON.parse(atob($('#insurance-price').data('array')));
    $('#insurance_dateBirth_year').val(null);
    checkInsuranceAndType();
    checkDefaultPriceIndex(priceListAll);
    $('#insurance_startDate').val(moment().format('YYYY-MM-DD'));
    setDate();
    setPrice(priceListAll[insurancePriceListIndexDefault]);
    setTotalAmount();
});

$('#insurance_insuranceDuration').change(function () {
    setDate();
    if (insurancePriceListIndex !== null) {
        setPrice(priceListAll[insurancePriceListIndex]);
    } else {
        setPrice(priceListAll[insurancePriceListIndexDefault]);
    }
    setTotalAmount();
});

$('#insurance_startDate').change(function () {
    setDate();
});

$('#insurance_dateBirth_year').change(function() {
   checkAge($('#insurance_dateBirth_year').val(), priceListAll);
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

function checkAge(age, priceList) {
    let diffAge = moment().diff(age, 'years', false);

    //----------------------------------------------MAXIMA-----------------------------//
    if (insuranceSelected === INSURANCE_MAXIMA) {
        if (insuranceType === COMPLEX_INSURANCE) {
            if (diffAge >= 2 && diffAge <= 17) {
                for (let i = 0; i < priceList.length; i++) {
                    if (priceList[i].name === PRICE_MAXIMA_YOUNG) {
                        insurancePriceListIndex = i;
                        setPrice(priceList[insurancePriceListIndex]);
                        break;
                    }
                }
            }
            if (diffAge >= 18 && diffAge <= 30) {
                for (let i = 0; i < priceList.length; i++) {
                    if (priceList[i].name === PRICE_MAXIMA) {
                        insurancePriceListIndex = i;
                        setPrice(priceList[insurancePriceListIndex]);
                        break;
                    }
                }
            }
            if (diffAge >= 31 && diffAge <= 50) {
                for (let i = 0; i < priceList.length; i++) {
                    if (priceList[i].name === PRICE_MAXIMA_MEDIUM) {
                        insurancePriceListIndex = i;
                        setPrice(priceList[insurancePriceListIndex]);
                        break;
                    }
                }
            }
            if (diffAge >= 51 && diffAge <= 60) {
                for (let i = 0; i < priceList.length; i++) {
                    if (priceList[i].name === PRICE_MAXIMA_OLD) {
                        insurancePriceListIndex = i;
                        setPrice(priceList[insurancePriceListIndex]);
                        break;
                    }
                }
            }
        }
        if (insuranceType === URGENT_INSURANCE) {
            if (diffAge >= 1 && diffAge <= 30) {
                for (let i = 0; i < priceList.length; i++) {
                    if (priceList[i].name === PRICE_URGENT_MAXIMA) {
                        insurancePriceListIndex = i;
                        setPrice(priceList[insurancePriceListIndex]);
                        break;
                    }
                }
            }
            if (diffAge >= 31 && diffAge <= 65) {
                for (let i = 0; i < priceList.length; i++) {
                    if (priceList[i].name === PRICE_URGENT_MAXIMA_MID) {
                        insurancePriceListIndex = i;
                        setPrice(priceList[insurancePriceListIndex]);
                        break;
                    }
                }
            }
            if (diffAge >= 66 && diffAge <= 80) {
                for (let i = 0; i < priceList.length; i++) {
                    if (priceList[i].name === PRICE_URGENT_MAXIMA_OLD) {
                        insurancePriceListIndex = i;
                        setPrice(priceList[insurancePriceListIndex]);
                        break;
                    }
                }
            }
        }
    }
    //----------------------------------------------ERGO-----------------------------//
    if (insuranceSelected === INSURANCE_ERGO) {
        if (diffAge >= 0 && diffAge <= 14) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_ERGO_YOUNG) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 15 && diffAge <= 26) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_ERGO) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 27 && diffAge <= 65) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_ERGO_MEDIUM) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 66) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_ERGO_OLD) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
    }
    //----------------------------------------------PVZP-----------------------------//
    if (insuranceSelected === INSURANCE_PVZP) {
        if (diffAge >= 0 && diffAge <= 5) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_PVZP_CHILD) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 6 && diffAge <= 14) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_PVZP_YOUNG) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 15 && diffAge <= 26) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_PVZP) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 27 && diffAge <= 44) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_PVZP_MID) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 45 && diffAge <= 59) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_PVZP_MEDIUM) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 60 && diffAge <= 69) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_PVZP_OLD) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 70) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_PVZP_SENIOR) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
    }
    //---------------------------------------UNIQA-----------------------------------//
    if (insuranceSelected === INSURANCE_UNIQA) {
        if (diffAge >= 0 && diffAge <= 4) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_UNIQA_CHILD) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 5 && diffAge <= 14) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_UNIQA_YOUNG) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 15 && diffAge <= 39) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_UNIQA) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 40 && diffAge <= 54) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_UNIQA_MID) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 55 && diffAge <= 59) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_UNIQA_MEDIUM) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 60 && diffAge <= 64) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_UNIQA_OLD) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
        if (diffAge >= 65 && diffAge <= 69) {
            for (let i = 0; i < priceList.length; i++) {
                if (priceList[i].name === PRICE_UNIQA_SENIOR) {
                    insurancePriceListIndex = i;
                    setPrice(priceList[insurancePriceListIndex]);
                    break;
                }
            }
        }
    }

}

function checkDefaultPriceIndex(priceList) {
    for (let i = 0; i < priceList.length; i++) {
        if (insuranceType === COMPLEX_INSURANCE) {
            if (priceList[i].name === PRICE_MAXIMA || priceList[i].name === PRICE_UNIQA ||
                priceList[i].name === PRICE_PVZP || priceList[i].name === PRICE_ERGO) {
                insurancePriceListIndexDefault = i;
                break;
            }
        } else {
            if (priceList[i].name === PRICE_URGENT_MAXIMA) {
                insurancePriceListIndexDefault = i;
                break;
            }
        }
    }
}

function checkInsuranceAndType() {
    insuranceSelected = $('#insurance-price').data('insurance');
    insuranceType = $('#insurance-price').data('type');
}

function setPrice(price) {
    switch ($('#insurance_insuranceDuration').val())
    {
        case "1":
            $('#insurance_price').val(price.oneMonth);
            break;
        case "2":
            $('#insurance_price').val(price.twoMonth);
            break;
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
        case "13":
            $('#insurance_price').val(price.thirteenMonth);
            break;
        case "14":
            $('#insurance_price').val(price.fourteenMonth);
            break;
        case "15":
            $('#insurance_price').val(price.fifteenMonth);
            break;
        case "16":
            $('#insurance_price').val(price.sixteenMonth);
            break;
        case "17":
            $('#insurance_price').val(price.seventeenMonth);
            break;
        case "18":
            $('#insurance_price').val(price.eighteenMonth);
            break;
        case "19":
            $('#insurance_price').val(price.nineteenMonth);
            break;
        case "20":
            $('#insurance_price').val(price.twentyMonth);
            break;
        case "21":
            $('#insurance_price').val(price.twentyOneMonth);
            break;
        case "22":
            $('#insurance_price').val(price.twentyTwoMonth);
            break;
        case "23":
            $('#insurance_price').val(price.twentyThreeMonth);
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
    if (insuranceSelected === INSURANCE_MAXIMA) {
        if (moment($('#insurance_startDate').val()) < startMonth) {
            $('#insurance_startDate').val(moment().format('YYYY-MM-DD'));
            alert('Пожулуйста, выберите актуальную дату!\n' +
            'Если вы хотите выбрать прошедшую дату, свяжитесь с нами для уточнения информации');
        }
    } else {
        if (moment($('#insurance_startDate').val()) < moment()) {
            $('#insurance_startDate').val(moment().format('YYYY-MM-DD'));
            alert('Пожалуйста, выберите актуальную дату!\n' +
                'Если вы хотите выбрать прошедшую дату, свяжитесь с нами для уточнения информации');
        }
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
    if (insurantHimself !== null && confirmContract) {
        $('#insurance_save').removeClass('hide');
    } else {
        $('#insurance_save').addClass('hide');
    }
}

