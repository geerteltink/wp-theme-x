$(document).ready(function() {
    $('.navbar-container').affix({
        offset: {
            top: $('.navbar-container').offset().top - $(document).scrollTop() - 30
        }
    });

    $('.navbar-container').on('affix.bs.affix', function() {
        $('.content').css('padding-top', $('.navbar-container').height());
    });

    $('.navbar-container').on('affix-top.bs.affix', function (){
        $('.content').css('padding-top', 0);
    });
});
