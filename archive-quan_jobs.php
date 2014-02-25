<?php

	//custom index page for job openings at quan

	get_header();

	$jobs_query = new WP_Query( array(
		'post_type'   => 'quan_jobs'
		) );

	echo '<div class="job-listings">';

		if( $jobs_query->have_posts() ) {
			echo '<h1>';
				_e( 'Job Openings at Quan Digital GmbH', 'quan' );
			echo '</h1>';

			while( $jobs_query->have_posts() ) {

				echo '<article>';
					$jobs_query->the_post();
					the_title( '<h2><a href="' . get_permalink() . '">', '</a></h2>' );
					echo quan_job_excerpt();
				echo '</article>';
			}
		}

	echo '</div>';

	get_footer();