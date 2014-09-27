<?php

	/*
	fallback for everything
	*/

	get_header(); 

	if( have_posts() ) :
		echo '<div class="main-loop-container"><div class="main-loop">';
		while( have_posts() ) :
			the_post();

				//write all ids to an array, we'll then use to filter the list
				$ids[] = get_the_ID();

				$posttype = $post->post_type;

				//post container
				echo '<li id="post-' . get_the_ID() . '" ' . ( $posttype == 'quan_tweets' ? 'class="index-tweet">' : 'class="index-post">' );
				echo '<div class="type"></div>';

					//if there is a cookie on the screen size, use the right image
					if( isset( $_COOKIE['resolution'] ) ) {
						$cookie_val = explode( ",", $_COOKIE['resolution'] );
						$screen     = $cookie_val[0] * $cookie_val[1];


						if( $screen <= 480 ) {
							$height     = 270;
							$width      = 480;
							$dummy_size = '480x270';
						} elseif( $screen <= 960 ) {
							$height     = 540;
							$width      = 960;
							$dummy_size = '960x540';
						} elseif( $screen <= 1920 ) {
							$height     = 1080/3;
							$width      = 1920/3;
							$dummy_size = '1920x1080';
						} else {
							$height     = 2160/3;
							$width      = 3840/3;
							$dummy_size = '3840x2160';
						}
					//else use the largest we have
					} else {
						$thumb_size = 'large';
						$dummy_size = '1920x1080';
					}
								
					echo '<a class="postlink" href="' . get_permalink() . '"></a>';

					echo '<div class="post-image">';
						if( has_post_thumbnail() ) {
							echo '<img src="' . aq_resize( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ), $width, $height, true )  . '" alt="" class="index-post-img" />';
						} else {
							echo '<img src="' . get_stylesheet_directory_uri() . '/images/dummy-' . $dummy_size . '.png" alt="" class="index-post-img" />';
						}

						//image attribution
						if( get_field( 'quan_img_license_url' ) || get_field( 'quan_img_license_name' ) || get_field( 'quan_img_url' ) || get_field( 'quan_img_name' ) ) {
							echo '<div class="attribution">';
								if( get_field( 'quan_img_url' ) ) {	
									echo '<a href="' . get_field( 'quan_img_url' ) . '" target="_blank" class="' . get_field( 'quan_img_link_color' ) . '"><span>' . get_field( 'quan_img_name' ) . '</span></a>';
								}
								if( get_field( 'quan_img_license_url' ) && get_field( 'quan_img_license_name' ) ) {
									if( in_array( get_field( 'quan_img_license_name' ), array( 'cc', 'CC', 'CreativeCommons', 'Creative Commons', 'creative commons', 'creativecommons' ) ) ) {
										$anchor = '<img src="' . get_stylesheet_directory_uri() . '/images/cc.png' . '" alt="cc" class="cc" />';
									} else {
										$anchor = '<span>' . get_field( 'quan_img_license_name' ) . '</span>';
									}
									echo '<a href="' . get_field( 'quan_img_license_url' ) . '" target="_blank" class="' . get_field( 'quan_img_link_color' ) . '">' . $anchor . '</a>';	
								}
							echo '</div>'; //.attribution

						}

						
					echo '</div>'; //.post-image
?>
			
				<div class="index-post-text">
						
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
					<div class="index-post-author tweet-author"> <?php //the tweet-author class does not make sense at all here, but it really simplyfies the jquery process (I should maybe change this sometime) ?>
						<a href="<?php the_permalink(); ?>">
							<?php
								the_author_image_size( 100, 100, get_the_author_meta( 'ID' ) );
							?>
						</a>
						<div class="display-name">
							<a href="<?php the_permalink(); ?>"><?php the_author(); ?></a>
						</div>

					</div>
			</li>
<?php
		endwhile;
		echo '</div></div>';
	endif;

get_footer(); 