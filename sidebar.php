<?php
	//the author sidebar
?>
	<aside id="sidebar">
		<div class="author">
			<h3><?php _e( 'Written by' ); ?></h3>
				
			<?php
				$aut_id = get_the_author_meta( 'ID' );

				$job      = get_user_meta( $aut_id, 'job', true );
				$twitter  = get_user_meta( $aut_id, 'twitter', true );
				$xing     = get_user_meta( $aut_id, 'xing', true );
				$linkedin = get_user_meta( $aut_id, 'linkedin', true );
			
			the_author_image();
			
			echo '<div class="name">';
				the_author();
			echo '</div>';

			echo '<div class="job">';
				echo $job;
			echo '</div>';

			echo '<div class="socials">';
			if( isset( $twitter ) && ! empty( $twitter ) ) :
?>			
				<div class="social"><a href="https://www.twitter.com/<?php echo $twitter; ?>" target="_blank">@<?php echo $twitter; ?></a></div>
<?php 
			endif; 
			if( isset( $xing ) && ! empty( $xing ) ) :
?>			
				<div class="social"><a href="<?php echo $xing; ?>" target="_blank">XING</a></div>
<?php 
			endif; 
			if( isset( $linkedin ) && ! empty( $linkedin ) ) :
?>			
				<div class="social"><a href="<?php echo $linkedin; ?>" target="_blank">Linked<span class="ion-social-linkedin"></span></a></div>
<?php 
			endif; 
			echo '</div>';
?>
		</div>	

		<?php 

		// Better than the async shares and completely Datenschutzkonform

		?>	

		<div class="article-share">
			<?php $share_title = urlencode(get_the_title()); ?>
			<h3>Share</h3>

			<div class="facebook">
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" data-popup="true"><i class="ion-social-facebook"></i> <span><?php _e( 'on facebook' ); ?></span></a>
			</div>	
			<div class="twitter">
				<a href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&source=tweetbutton&text=<?php echo $share_title; ?>&url=<?php the_permalink(); ?>" data-popup="true"><i class="ion-social-twitter"></i> <span><?php _e( 'on twitter' ); ?></span></a>
			</div>
			<div class="gplus">
				<a href="https://plusone.google.com/_/+1/confirm?hl=de&url=<?php the_permalink(); ?>&title=<?php echo $share_title; ?>')" data-popup="true">
				<i class="ion-social-googleplus-outline"></i> <span><?php _e( 'on google+' ); ?></span></a>
			</div>
		</div>

		<?php
			//show tags if post has any

			if( has_tag() ) :
				$tags = get_the_tags();
				
				usort( $tags, function ($a, $b) {
					if ( $a->count == $b->count ) {
						return 0;
					}

					return( $a->count > $b->count ) ? - 1 : 1;
				});
		?>

			<div class="tags">
			<h3>Tags</h3>
				<?php
					foreach( $tags as $tag ) {
						echo '<span class="single-tag">';
							echo '<a href="' . get_bloginfo( 'wpurl' ) . '?tag=' . $tag->slug . '">' . $tag->name . '</a>';
						echo '</span>' . "\n";
					}
				?>
			</div>

		<?php
			endif; 
		?>
	</aside>