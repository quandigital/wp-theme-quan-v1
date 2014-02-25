<?php

	/*
	fallback for everything
	*/

	get_header(); 

	//the main query
	$quan_query = new WP_Query( array(
			'post_type'      => array( 'post', 'quan_tweets' ),
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => -1
			)
		);
	
	//write the ids to an array to filter them in the ajax call later on
	$ids = array();

	echo '<div id="loop">';

		//get the languages tag
		$args = array(
			'orderby'    => 'count',
			'style'      => 'none',
			'hide_empty' => 0
			);
		$langs = get_terms( 'language', $args );

		//write languages to select
		?>
		<div class="filter">
			<div> <?php //container 1 ?>
				<div> <?php //container 2 ?>
					<div class="heading"><?php _e( 'Filter Posts:', 'quan' ); ?></div>

					<div class="tweet-filter">
						<input type="checkbox" name="tweetfilter" id="tweetfilter" checked  />
						<div class="popup" data-checked="<?php _e( 'Hide Tweets', 'quan' ); ?>" data-unchecked="<?php _e( 'Show Tweets', 'quan' ); ?>" ></div>
						<div class="replacement"></div> 
					</div>

					<div class="language">
						<select id="language-filter">
						<?php
							$slugs = array();
							foreach( $langs as $lang ) {
								$slugs[] = $lang->slug;	
							}
							$slugs = implode( ', ', $slugs );

							echo '<option value="' . $slugs . '">' . __( 'All Langagues', 'quan' ) . '</option>';
							foreach( $langs as $lang ) {
								echo '<option value="' . $lang->slug . '">' . $lang->name . '</option>';
							}
						?>
						</select>
					</div>
				</div>
			</div>
		</div>
	
		<?php
		//output the posts 
		if( $quan_query->have_posts() ) :
			echo '<div class="main-loop-container"><ul class="main-loop">';
			while( $quan_query->have_posts() ) :
				$quan_query->the_post();

				//write all ids to an array, we'll then use to filter the list
				$ids[] = get_the_ID();

				$posttype = $quan_query->post->post_type;

				//post container
				echo '<li id="post-' . get_the_ID() . '" ' . ( $posttype == 'quan_tweets' ? 'class="index-tweet">' : 'class="index-post">' );
				echo '<div class="type"></div>';

				//only do the whole image thing when the post is an actual post and not a tweet
				if( $posttype == 'post' ) {
					//if there is a cookie on the screen size, use the right image
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
					//else use the largest we have
					} else {
						$thumb_size = 'large';
						$dummy_size = '1920x1080';
					}
								
					echo '<a class="postlink" href="' . get_permalink() . '"></a>';
					if( has_post_thumbnail() ) {
						the_post_thumbnail( $thumb_size );
					} else {

						echo '<img src="' . get_stylesheet_directory_uri() . '/images/dummy-' . $dummy_size . '.png" alt="" class="index-post-img" />';
					}
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
	<?php
			} else {

					$twittername = get_post_meta( $post->ID, 'quan_tweet_author_twitter', true );
					//check if we have this author in the database
					$tweetauthor = get_users( array( 'meta_key' => 'twitter', 'meta_value' => $twittername ) );
					
					//if this still does not return an author, get the tweet author
					if( empty( $tweetauthor ) ) {
						$tweetauthor = $twittername; 
					}
					
					echo '<div class="tweet-content">';	//paragraph enclosing content

					//if the tweet has an image
					$attachment = get_post_meta( $post->ID, 'quan_tweet_media_attachment', true );
					if( $attachment != '' ) {
						echo '<div class="tweet-attachment" style="background-image: url(' . $attachment . ');"></div>';
					}

					//output the content
					$content = get_the_content();
					echo '<p>' . $content . '</p>';

					echo '</div>'; //paragraph enclosing content
					// error_log( var_export( $attachment, true ) . "\n", 3, dirname(__FILE__) . '/debug.log' );


						// output the author and his image and shit
						echo '<div class="tweet-author">';
							echo '<a class="image" href="https://twitter.com/' . $twittername . '" target="_blank">';
								//if the author is an array, i.e. a user on our site
								if( is_array( $tweetauthor ) ) {
									//get their author image
									the_author_image_size( 100, 100, $tweetauthor[0]->ID );	
								} else {
									//get their twitter image
									echo '<div class="entry_author_image"><img src="' . get_post_meta( $post->ID, 'quan_tweet_avatar_url', true ) . '" alt="" /></div>';	
								}
							echo '</a>';
							if( is_array( $tweetauthor ) ) {
								echo '<div class="display-name">' . $tweetauthor[0]->display_name . '</div>';	
							} 
							echo '<a class="text" href="https://twitter.com/' . $twittername . '" target="_blank">@' . $twittername . '</a>';

							echo '<div class="intents">';
								echo '<div class="intent" data-intent="' . __( 'Favorite', 'quan' ) . '"><a href="https://twitter.com/intent/favorite?tweet_id=' . get_post_meta( $post->ID, 'quan_tweet_tweet_id', true ) . '" target="_blank"><i class="ion-star"></i></a></div>'; 
								echo '<div class="intent" data-intent="' . __( 'Retweet', 'quan' ) . '"><a href="https://twitter.com/intent/retweet?tweet_id=' . get_post_meta( $post->ID, 'quan_tweet_tweet_id', true ) . '" target="_blank"><i class="ion-loop"></i></a></div>';
								echo '<div class="intent" data-intent="' . __( 'Reply', 'quan' ) . '"><a href="https://twitter.com/intent/tweet?in_reply_to=' . get_post_meta( $post->ID, 'quan_tweet_tweet_id', true ) . '" target="_blank"><i class="ion-reply"></i></a></div>';
							echo '</div>'; //class="intents"
						echo '</div>'; //class="tweet-author"
					
					//unset the tweetauthor, so it gets newly created on each iteration
					unset( $tweetauthor );
					unset( $twittername );
				// echo '</div>';
			}
			echo '</li>';

			endwhile;
			echo '</div></div>';
		else :
			echo '<div id="nothing-here">';
			_e( 'Nothing here yet. We are working on new blogposts.', 'quan' );
			echo'</div>';
		endif;
	echo '</div>';

	// echo '<i class="ion-loading-c" id="loading"></i>';
	echo '<div id="loading-canvas"></div>';
	echo '<input type="hidden" id="postids" value="' . json_encode( $ids ) . '" />';

get_footer(); 