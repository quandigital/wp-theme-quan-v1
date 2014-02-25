
		</div> <?php //end main container ?>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="./js/send.js"></script>
		<script>
			window.docH         = $(window).height();
			window.docW         = $(window).width();

			$('html').addClass( 'h' + docH );
			$('html').addClass( 'w' + docW );
			if( docW > 1260 && docH > 700 ) {
				$('html').removeClass('fail').addClass('pass');
				$('body').addClass('dontshow');
				$('html').prepend('<div id="wait"></div>');
			
				document.write('<script src="./js/skrollr.min.js"><\/script>');
				document.write('<!--[if lt IE 9]><script src="skrollr.ie.min.js"></script><![endif]-->');
				document.write('<script src="./js/skrollr.menu.js"><\/script>');
				document.write('<script src="./js/smartresize.js"><\/script>');
				document.write('<script src="./js/fittext.js"><\/script>');
				document.write('<script src="./js/jquery.cookie.js"><\/script>');
				document.write('<script src="./js/raphael.js"><\/script>');
				document.write('<script src="./js/globals.js"><\/script>'); 
				document.write('<script src="./js/map.js"><\/script>'); 
				document.write('<script src="./js/islands.js"><\/script>'); 
				document.write('<script src="./js/load.js"><\/script>'); 
			} else {
				document.write('<script src="./js/small.js"><\/script>'); 
			}
		</script>
	</body>
</html>