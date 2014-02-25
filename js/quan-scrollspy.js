
    $(document).ready(function(){
        if( viewport().width > 640 ) {
            if( typeof( quanSharesHigher ) == 'undefined' || quanSharesHigher === false ) {
                quanSpy( $('#sidebar').offset().top - ( $('header').height() + $('#top').height() + $('#wpadminbar').height() + 20 ) );
            }
        } 
    });

    $(window).smartresize(function(){
        if( viewport().width < 641 ) {
            $('#sidebar').removeAttr('style').removeClass('locked');
            $('.entry_author_image').show();
            $('#sidebar .author img').fadeTo(500,1);
        } else {
            if( typeof( quanSharesHigher ) != 'undefined' && quanSharesHigher === true ) {
                console.log( 'hells' );

                if( viewport().height > $('#sidebar').outerHeight() + 250 ) {
                    quanSpy( $('#sidebar').offset().top - ( $('header').height() + $('#top').height() + $('#wpadminbar').height() + 20 ) );
                }
            } else {
                quanSpy( $('#sidebar').offset().top - ( $('header').height() + $('#top').height() + $('#wpadminbar').height() + 20 ) );
            }
        }
    });

function quanSpy( minScroll ) {
    $('#sidebar').scrollspy({
        min: minScroll,
        max: 9999999,
        onEnter: function(element, position) {
            if( $(window).width() > 640 ) {
                $('#sidebar').css({ 'position': 'fixed', 'width': $('#main .content').width()/3 + 'px', 'margin-left': $('#main .content').width()/3*2 }).addClass('locked');
                $('#sidebar .author img').fadeTo(500,0);
                setTimeout(function(){
                    $('.entry_author_image').hide();
                }, 350 );
            }
        },
        onLeave: function(element, position) {
            $('#sidebar').removeAttr('style').removeClass('locked');
            $('.entry_author_image').show();
            $('#sidebar .author img').fadeTo(500,1);
        }
    });
}