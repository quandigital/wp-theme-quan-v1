		</div> <?php //main container ?>

		<?php
		//the border or frame
		//shame on presentational markup
	?>
		<div id="left"></div>
		<div id="right"></div>
		<div id="top"></div>
		<div id="bottom"></div>

		<div id="frame"></div>
		<div id="inner-frame"></div>

		<footer>
			<div class="legal">
				<span>&copy; 2013 <a href="<?php bloginfo( 'wpurl' ); ?>"><?php bloginfo( 'name' ); ?></a>
			</div>
		</footer>
		
		<div class="social-menu">
			<div class="mail">
				<a href="mailto:info@quandigital.com"><span class="ion-ios7-email"></span> <span>Write us an email</span></a>
			</div>
			<div class="phone">
				<a href="tel:+4917645164460"><span class="ion-ios7-telephone"></span> <span>Talk to us</span></a>
			</div>
			<div class="facebook">
				<a href="https://www.facebook.com/quandigital" target="_blank">
					<span class="ion-social-facebook"></span> <span>Like us on facebook</span>
				</a>
			</div>
			<div class="twitter">
				<a href="https://twitter.com/quandigital" target="_blank">
					<span class="ion-social-twitter"></span> <span>Follow us on twitter</span>
				</a>
			</div>
			<div class="gplus">
				<a href="https://plus.google.com/115674308506276261482/posts" target="_blank">
					<span class="ion-social-googleplus-outline"></span> <span>Add us to your circles</span>
				</a>
			</div>
		</div>

		<div class="to-top"> 
			<a href="#main"><span data-icon="h"></span></a>
		</div>

		<script>
			window.realResolution = window.devicePixelRatio || Math.round(window.screen.availWidth / document.documentElement.clientWidth);
			document.cookie='resolution='+Math.max(screen.width,screen.height)+ "," + realResolution +'; path=/';
		</script>

		<?php wp_footer(); ?>