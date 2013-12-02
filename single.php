<?php
	
	//single article template

	get_header();

	echo '<div class="content">';
			if( have_posts() ) : 
				while (have_posts()) : 
					the_post(); 

				the_title( '<h1>', '</h1>' );

				echo '<div class="meta">';
					echo '<span class="date">' . __( 'Published on: ') . get_the_date( "m/d/Y" ) . '</span>';
				echo '</div>';

				echo '<article>';
						the_content();
				echo '</article>';

				endwhile; 
			endif; 
		
		get_sidebar();
		
		comments_template();

	echo '</div>';

	get_footer();
?>