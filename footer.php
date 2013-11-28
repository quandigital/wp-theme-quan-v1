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

		<div class="legal">
			<span>&copy; 2013 <a href="<?php bloginfo( 'wpurl' ); ?>"><?php bloginfo( 'name' ); ?></a>
		</div>

		<div class="to-top"> 
			<a href="#main"><span data-icon="h"></span></a>
		</div>
		<?php wp_footer(); ?>