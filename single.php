<?php
	
	//single article template

	get_header();

	echo '<div class="content">';
			if( have_posts() ) : 
				while (have_posts()) : 
					the_post(); 

				the_title( '<h1>', '</h1>' );

		echo '<article>';
				the_content();
		echo '</article>';

				endwhile; 
			endif; 
	echo '</div>';

	get_sidebar();

	get_footer();
?>