<?php

	//custom index page for job openings at quan

	get_header();

	echo '<h1 data-popup="' . __( 'That\'s morse code for a 404', 'quan' ) . '">&middot;&middot;&middot;&middot;- ----- &middot;&middot;&middot;&middot;-</h1>';

	echo '<p>' . __( 'Unfortunately what you were looking for is no longer here.', 'quan' ) . '<br /><a href="' . get_bloginfo( 'wpurl' ) . '">' . __( 'Click here to go back home', 'quan' ) . '</a>.</p>';
	echo '<div class="shipwreck-404">';
		include(  get_template_directory() . '/images/shipwreck-large.svg' );
	echo '</div>';

	get_footer();