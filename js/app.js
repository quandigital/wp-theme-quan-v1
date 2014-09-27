// $(document).foundation();

window.scrolled  = $('body').scrollTop();
window.tscrolled = window.pageYOffset;
var headerHeight = $('header').height();

$(document).ready(function(){
	sidebarHeight();
	scrollspy();
	if( $(document).width() >= 626 ) {
		if( $('header').hasClass('small-fixed') ) {
			$('header').removeClass('small-fixed');
		}
	}

	$('#main').css( 'padding-bottom', $('footer').outerHeight() );

	$('#menu-handle').click(function(e){
		if( ! $(this).hasClass('show') ) {
			$(this).addClass('show');
			$('.menu li').css('display', 'block');
			$('header').height( $('.menu-header-container').height() );
		} else {
			$(this).removeClass('show');
			$('.menu li').css('display', 'none');
			$('header').height( 80 );
		}
	});

	twitterImages();

});

$(window).load(function(){
	tweetAuthorPosition();
	$('#story').fitText(1);
    $('#wetell').fitText();
})

$(window).smartresize(function(){
	sidebarHeight();

	if( viewport().width > 640 ) {
		if( $('header').hasClass('small-fixed') ) {
			$('header').removeClass('small-fixed');
			$('#main').css('padding-top', '' );	
		}
	} else {
		if( ! $('header').hasClass('small-fixed') ) {
			scrollspy();
		}
	}
	twitterImages();
	tweetAuthorPosition();
});

$(document).scroll(function(){
	setTimeout(function(){
		scrolled  = $('body').scrollTop();
		tscrolled = window.pageYOffset;
		scrollspy();
	}, 0);
});


function scrollspy() {
	if( $('html').hasClass('touch') ) {
		var distScrolled = tscrolled;
	} else {
		var distScrolled = scrolled;
	}

	// console.log( distScrolled );

	if( distScrolled > headerHeight ) {
		$('header').addClass('scrolled-shadow');
		if( $('header').css('position') !== 'fixed' ) {
			$('header').css('position', 'fixed');
			$('header').addClass('small-fixed');
			if( viewport().width < 641 ) {
				$('#main').css('padding-top', headerHeight + 80);
			}
		}
	}

	if( distScrolled <= headerHeight ) {
		if( $('header').hasClass('scrolled-shadow') ) {
			$('header').removeClass('scrolled-shadow');
		}
		if( $('header').hasClass('small-fixed') ) {
			$('header').removeClass('small-fixed');
			$('.menu li').removeAttr('style');
			$('header').removeAttr('style');
		}
		if( viewport().width < 640 ) {
			if( $('header').css('position') == 'fixed' ) {
				$('header').css('position', 'static');
			}
			$('#main').css('padding-top', '' );	
		}
	}
}

function twitterImages() {
	setTimeout(function(){
		$('.tweet-attachment').css({
			'height': $('.tweet-attachment').width() * 0.5625
		});
	}, 20);
}

function tweetAuthorPosition() {
	//only on per row, don't need to adjust the height
	if( viewport().width < 640 ) {
		resetHeights();
	}
	//medium size --> two per row
	if( viewport().width >= 640 && viewport().width < 1024 ) {
		resetHeights();
		setTimeout(function(){
			$('.main-loop li:even').each(function(){
				//if the first element is visible
				if( $(this).css( 'display' ) !== 'none' ) {
					$(this).css( 'height', '' );
					var firstLi   = $(this);
					var heights   = [];
					heights[0]    = firstLi.height();
					var maxHeight = firstLi.height();

					firstLi.css({
						'height': maxHeight,
					});

					//if there is also a second element in the row
					if( $(this).next().css( 'display' ) !== 'none' ) {
						var secondLi = $(this).next();
						heights[1]   = secondLi.outerHeight();
						maxHeight    = Math.max.apply( Math, heights );

						firstLi.css({
							'height': maxHeight,
						});
						secondLi.css({
							'height': maxHeight,
						});
					}
				}
			});
		}, 20);
	}
	//three per row
	if( viewport().width > 1024 ) {
		resetHeights();
		setTimeout(function(){
			var i = 0;
			$('.main-loop li').each(function(){
				i++;
				if( i % 3 !== 1 ) {
					return;
				}
				
				//if the first element is visible
				if( $(this).css( 'display' ) !== 'none' ) {
					$(this).css( 'height', '' );
					var firstLi   = $(this);
					var heights   = [];
					heights[0]    = firstLi.height();
					var maxHeight = firstLi.height();

					firstLi.css({
						'height': maxHeight,
					});

					//if there is also a second element in the row
					if( $(this).next().css( 'display' ) !== 'none' ) {
						var secondLi = $(this).next();
						heights[1]   = secondLi.outerHeight();
						maxHeight    = Math.max.apply( Math, heights );

						firstLi.css({
							'height': maxHeight,
						});
						secondLi.css({
							'height': maxHeight,
						});

						//if there are three in the row
						if( $(this).next().next().css( 'display' ) !== 'none' ) {
							var thirdLi = $(this).next().next();
							heights[2]  = thirdLi.outerHeight();
							maxHeight   = Math.max.apply( Math, heights );
							firstLi.css({
								'height': maxHeight,
							});			
							secondLi.css({
								'height': maxHeight,
							});
							thirdLi.css({
								'height': maxHeight,
							});
						} 
					} 
				}
			});
		}, 20);
	}
}

function resetHeights() {
	$('.main-loop li').each(function(){
		$(this).css({
			'height': '', 
			'padding-bottom': '20px'
		});
		$('.tweet-author, .index-post-author').css({
			// 'position':'relative',
			// 'bottom': '',
		});
	});
}

function viewport() {
    var e = window, a = 'inner';
    if (!('innerWidth' in window )) {
        a = 'client';
        e = document.documentElement || document.body;
    }
    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

function sidebarHeight() {
	if( viewport().width > 640 ) {
		if( $(window).scrollTop() < 250 ) {
			var viewHeight = $('#sidebar').outerHeight();
		} else {
			var viewHeight = $('#sidebar').outerHeight() + 250;
		}

		if( viewport().height < viewHeight ) {
			var shares = $('.article-share>div');

			shares.each( function() {
				$(this).css('display', 'inline');
				$(this).find('span').css('display', 'none');
			});
			$('.article-share').css( 'text-align', 'center' );

			quanSharesHigher = true;

		} else {
			if( typeof( quanSharesHigher ) != 'undefined' && quanSharesHigher === true ) {
				var shares = $('.article-share>div');

				shares.each( function() {
					$(this).css('display', 'block');
					$(this).find('span').css('display', 'inline');
				});

				$('.article-share').css( 'text-align', '' );

				quanSharesHigher = false;
			}
			quanSharesHigher = false;
		}
	}
}