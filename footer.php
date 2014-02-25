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
				<span>&copy; 2013 <a href="<?php bloginfo( 'wpurl' ); ?>"><?php bloginfo( 'name' ); ?></a></span>
			</div>
		</footer>
		
		<div class="social-menu">
			<div class="mail">
				<a href="mailto:info@quandigital.com"><span class="ion-ios7-email"></span> <span><?php _e( 'Write us an e-mail', 'quan' ); ?></span></a>
			</div>
			<div class="phone">
				<a href="<?php _ex( 'tel:+123456789', 'public phone number for your country', 'quan' ); ?>"><span class="ion-ios7-telephone"></span> <span><?php _e( 'Talk to us', 'quan' ); ?></span></a>
			</div>
			<!--div class="blog">
				<a href="<?php echo get_bloginfo( 'wpurl' ) . '/blog'; ?>"><span class="ion-bookmark"></span> <span><?php _e( 'Read our blog', 'quan' ); ?></span></a>
			</div>
			<div class="facebook">
				<a href="https://www.facebook.com/quandigital" target="_blank">
					<span class="ion-social-facebook"></span> <span><?php _e( 'Like us on  facebook', 'quan' ); ?></span>
				</a>
			</div>
			<div class="twitter">
				<a href="https://twitter.com/quandigital" target="_blank">
					<span class="ion-social-twitter"></span> <span><?php _e( 'Follow us on twitter', 'quan' ); ?></span>
				</a>
			</div>
			<div class="gplus">
				<a href="https://plus.google.com/115674308506276261482/posts" target="_blank">
					<span class="ion-social-googleplus-outline"></span> <span><?php _e( 'Add us to your circles', 'quan' ); ?></span>
				</a>
			</div-->
			<div class="legal">
				<a href="<?php echo get_bloginfo( 'wpurl' ) . '/impressum'; ?>"><span class="ion-information"></span> <span><?php _e( 'Read the legal stuff', 'quan' ); ?></span></a>
			</div>
		</div>

		<script>
			window.realResolution = window.devicePixelRatio || Math.round(window.screen.availWidth / document.documentElement.clientWidth);
			document.cookie='resolution='+Math.max(screen.width,screen.height)+ "," + realResolution +'; path=/';
		</script>

		<?php wp_footer(); ?>