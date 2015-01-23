$(document).ready(function() {
    var $container = $('.navbar-container');

    $container.on('affix.bs.affix', function() {
        $('.content').css('padding-top', $container.height());
    });

    $container.on('affix-top.bs.affix', function (){
        $('.content').css('padding-top', 0);
    });

    $(window).on('load', function() {
        $container.affix({
            offset: {
                top: $container.offset().top
            }
        });
    });
});
