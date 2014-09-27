<?php
	
	//single article template

	get_header();

	echo '<div class="content">';
			if( have_posts() ) : 
				while (have_posts()) : 
					the_post(); 

				the_title( '<h1>', '</h1>' );

				echo '<div class="meta">';
					echo '<span class="date">' . __( 'Published') . ' ' . get_the_date( "m/d/Y" ) . '</span>';
					//' <span>' . _x( 'in', 'in category xyz', 'quan' ) . ' ' . get_the_category_list(",") . '</span>'; //if we ever want categories back
				echo '</div>';

				echo '<article>';

					//get the abstract if lang is not english
					if( $postlang !== 'en' ) :
						if( get_field( 'quan_abstract' ) ) :

					?>
							<div class="abstract">
								<h2>Abstract</h2>
								<p><?php the_field( 'quan_abstract' ); ?></p>
							</div>
					<?php
						endif;
					endif;

					the_content();
				echo '</article>';

				endwhile; 
			endif; 
		
		get_sidebar();
		
		comments_template();

	echo '</div>';

	get_footer();