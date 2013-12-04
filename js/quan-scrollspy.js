$(document).ready(function() {
    //build the offset top
    var minScroll = $('#sidebar').offset().top - ( $('header').height() + $('#top').height() + $('#wpadminbar').height() + 20 );
    $('#sidebar').scrollspy({
        min: minScroll,
        max: 9999999,
        onEnter: function(element, position) {
            $('#sidebar').css({ 'position': 'fixed', 'width': $('#main .content').width()/3 + 'px', 'margin-left': $('#main .content').width()/3*2 }).addClass('locked');
            $('#sidebar .author img').fadeTo(500,0);
            setTimeout(function(){
                $('.entry_author_image').hide();
            }, 350 );
        },
        onLeave: function(element, position) {
            $('#sidebar').removeAttr('style').removeClass('locked');
            $('.entry_author_image').show();
            $('#sidebar .author img').fadeTo(500,1);
        }
    });
});