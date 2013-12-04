<?php
	
	//single article template

	get_header();

	echo '<div class="content">';
			if( have_posts() ) : 
				while (have_posts()) : 
					the_post(); 

				the_title( '<h1>', '</h1>' );

				echo '<div class="meta">';
					echo '<span class="date">' . __( 'Published') . ' ' . get_the_date( "m/d/Y" ) . '</span> <span>' . _x( 'in', 'quan', 'in category ???' ) . ' ' . get_the_category_list(",") . '</span>';
				echo '</div>';

				echo '<article>';

					if( isset( $_COOKIE['resolution'] ) ) {
						$cookie_val = explode( ",", $_COOKIE['resolution'] );
						$screen     = $cookie_val[0] * $cookie_val[1];
						if( $screen <= 480 ) {
							$thumb_size = 'small';
							$dummy_size = '480x270';
						} elseif( $screen <= 960 ) {
							$thumb_size = 'medium';
							$dummy_size = '960x540';
						} elseif( $screen <= 1920 ) {
							$thumb_size = 'large';
							$dummy_size = '1920x1080';
						} else {
							$thumb_size = 'xlarge';
							$dummy_size = '3840x2160';
						}
					} else {
						$thumb_size = 'large';
						$dummy_size = '1920x1080';
					}

					if( has_post_thumbnail() ) {
						the_post_thumbnail( $thumb_size );
					}
					
					the_content();
				echo '</article>';

				endwhile; 
			endif; 
		
		get_sidebar();
		
		comments_template();

	echo '</div>';

	get_footer();
?>