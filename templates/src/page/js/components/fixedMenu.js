$(window).scroll(function() {
    let $block = $('#fixed-menu');

    if($(window).scrollTop() > 60) {
        $block.removeClass('hide'); // Добавляем класс fixed. В стилях указываем для него position:fixed, height и прочее, чтобы сделать шапку фиксированной.
    } else {
        $block.addClass('hide'); // удаляем класс
    }
});