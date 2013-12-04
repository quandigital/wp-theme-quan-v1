// $(document).foundation();

window.scrolled  = $('body').scrollTop();
window.tscrolled = window.pageYOffset;
var headerHeight = $('header').height();

$(document).ready(function(){
	scrollspy();
	if( $(document).width() >= 626 ) {
		if( $('header').hasClass('small-fixed') ) {
			$('header').removeClass('small-fixed');
		}
	}

	$('#main').css( 'padding-bottom', $('footer').outerHeight() );

	$('#menu-header a').click(function(e){

	});
});

$(window).smartresize(function(){
	if( $(document).width() >= 626 ) {
		if( $('header').hasClass('small-fixed') ) {
			$('header').removeClass('small-fixed');
		}
	} else {
		if( ! $('header').hasClass('small-fixed') ) {
			$('header').addClass('small-fixed');
			$('header').css('position', 'fixed');
		}
	}
});

$(document).scroll(function(){
	setTimeout(function(){
		scrolled  = $('body').scrollTop();
		tscrolled = window.pageYOffset;
		scrollspy();
	}, 300);
});


function scrollspy() {
	if( $('html').hasClass('touch') ) {
		var distScrolled = tscrolled;
	} else {
		var distScrolled = scrolled;
	}

	console.log( scrolled );

	if( distScrolled > headerHeight ) {
		$('header').addClass('scrolled-shadow');
		if( $('header').css('position') !== 'fixed' ) {
			$('header').css('position', 'fixed');
			$('header').addClass('small-fixed');
		}
	}

	if( distScrolled === 0 ) {
		if( $('header').hasClass('scrolled-shadow') ) {
			$('header').removeClass('scrolled-shadow');
		}
		if( $('header').hasClass('small-fixed') ) {
			$('header').removeClass('small-fixed');
		}
		if( $(document).width() < 626 ) {
			if( $('header').css('position') === 'fixed' ) {
				$('header').css('position', 'static');
			}		
		}
	}

	// if( $(document).width() > )
}
