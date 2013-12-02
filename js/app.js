// $(document).foundation();

window.scrolled  = $('body').scrollTop();
window.tscrolled = window.pageYOffset;
$(document).ready(function(){
	scrollspy();
});

$(window).smartresize(function(){
	// scrollspy();
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
	scrolled  = $('body').scrollTop();
	tscrolled = window.pageYOffset;
	scrollspy();
});


function scrollspy() {
	if( $('html').hasClass('touch') ) {
		var distScrolled = tscrolled;
	} else {
		var distScrolled = scrolled;
	}

	console.log( distScrolled );

	if( distScrolled > 50 ) {
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
}