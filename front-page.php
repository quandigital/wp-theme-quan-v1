<?php 
	
	/* Front Page Template */

	get_header( 'front' );	

	$jobs = wp_count_posts( 'quan_jobs' );
	$jobs_open = $jobs->publish;
?>
	<img src="<?php echo get_stylesheet_directory_uri() . '/images/QuanDigital.svg'; ?>" alt="" height="339" width="530" />

	<nav>
		<ul>
			<li><a href="./blog"><?php _e( 'Blog', 'quan' ); ?></a></li>
			<li><a href="./team"><?php _e( 'Team', 'quan' ); ?></a></li>
			<li><a href="./tour"><?php _e( 'Take the Tour', 'quan' ); ?></a></li>
			<?php
				if( $jobs_open > 0 ) : 
			?>
				<li><a href="./jobs"><?php _e( 'Jobs', 'quan' ); ?><span class="job-count"><?php echo $jobs_open; ?></span></a></li>	
			<?php
				endif;
			?>
			<li><a href="./contact"><?php _e( 'Contact', 'quan' ); ?></a></li>
		</ul>
	</nav>

		<?php
			if( $lang == 'de' ) {
				$notlang = 'German';
			}
			if( $lang == 'fr' ) {
				$notlang = 'French';
			}
			if( $lang == 'en' ) {
				$notlang = 'English';
			}
			if( $lang == 'it' ) {
				$notlang = 'Italian';
			}
			if( $lang == 'es' ) {
				$notlang = 'Spanish';
			}

			function select_lang( $value, $lang ) {
				if( $lang == $value ) 
					echo 'selected';
			}
		?>

		<div class="notlang">
			<span><?php echo $notlang; ?> is not your language? Change it here: </span>
			<div class="select">
				<select id="lang-change">
					<option value="en" <?php select_lang( 'en', $lang ); ?>>English</option>
					<option value="fr" <?php select_lang( 'fr', $lang ); ?>>French</option>
					<option value="de" <?php select_lang( 'de', $lang ); ?>>German</option>
					<option value="it" <?php select_lang( 'it', $lang ); ?>>Italian</option>
					<option value="es" <?php select_lang( 'es', $lang ); ?>>Spanish</option>
				</select>
			</div>
		</div>
<?php
	get_footer();
