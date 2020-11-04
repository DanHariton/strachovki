$(window).on('load', function () {
    //index show content
    let $carousel = $('#carousel-home');

    let $text1 = $carousel.find('.carusel-text-1');
    let $text2 = $carousel.find('.carusel-text-2');
    let $text3 = $carousel.find('.carusel-text-3');
    let $text4 = $carousel.find('.carusel-text-4');

    $text1.delay(500).fadeIn('slow');
    $text2.delay(900).fadeIn('slow');
    $text3.delay(1300).fadeIn('slow');
    $text4.delay(1700).fadeIn('slow');
});