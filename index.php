<?php

	/*
	fallback for everything
	*/

	get_header(); 

	if( have_posts() ) :
		echo '<div class="main-loop-container"><div class="main-loop">';
		while( have_posts() ) :
			the_post();

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

			echo '<li class="index-post">';
				echo '<a class="postlink" href="' . get_permalink() . '"></a>';
				if( has_post_thumbnail() ) {
					the_post_thumbnail( $thumb_size );
				} else {

					echo '<img src="' . get_stylesheet_directory_uri() . '/images/dummy-' . $dummy_size . '.png" alt="" />';
				}
?>
			
				<div class="index_post-text">
					
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p>
							<?php
								$excerpt = get_field( 'quan_excerpt' );
								if( $excerpt ) {
									echo $excerpt;
								}
							?>
						</p>
					
				</div>
			</li>
<?php
		endwhile;
		echo '</div></div>';
	endif;

get_footer(); 