<?php

	/*
	fallback for everything
	*/

	get_header(); 


	$quan_query = new WP_Query( array(
			'post_type'      => 'post',
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => -1
		)
	);

	$ids = array();

	echo '<div id="loop">';
	if( $quan_query->have_posts() ) :
		echo '<div class="main-loop-container"><div class="main-loop">';
		while( $quan_query->have_posts() ) :
			$quan_query->the_post();

			//write all ids to an array, we'll then use to filter the list
			$ids[] = get_the_ID();

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

			echo '<li id="post-' . get_the_ID() . '" class="index-post">';
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
	echo '</div>';

	echo '<input type="hidden" id="postids" value="' . json_encode( $ids ) . '" />';

get_footer(); 