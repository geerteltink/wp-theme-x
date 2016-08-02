$(document).ready(function() {
    var $container = $('.navbar-container');
    var $sibling = $container.next();

    $container.on('affix.bs.affix', function() {
        $sibling.css('margin-top', $container.height());
    });

    $container.on('affix-top.bs.affix', function (){
        $sibling.css('margin-top', 0);
    });

    $(window).on('load', function() {
        $container.affix({
            offset: {
                top: $container.offset().top
            }
        });
    });
});
