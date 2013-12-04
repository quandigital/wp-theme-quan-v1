<?php 
	
	/* Front Page Template */

	get_header( 'front' );	
?>
	<img src="<?php echo get_stylesheet_directory_uri() . '/images/QuanDigital.svg'; ?>" alt="" />

	<nav>
		<ul>
			<li><a href="./blog">Blog</a></li>
			<li><a href="./team">Team</a></li>
			<li><a href="./tour">Take the Tour</a></li>
			<li><a href="./contact">Contact Us</a></li>
		</ul>
	</nav>
<?php
	get_footer();
