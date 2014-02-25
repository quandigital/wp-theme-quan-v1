<?php
	
	/*
	Template Name: Team Template 
	*/

	if ( !function_exists('get_editable_roles') ) {
		require_once( ABSPATH . '/wp-admin/includes/user.php' );
	}
	

	/*
		get roles and then get users by roles
	*/
		// $roles = array();
		// foreach( get_editable_roles() as $role_name => $role_info) {
		// 	$roles[] = $role_name;
		// }

	/*
		get only editors
	*/
		$editors = get_users( array( 'role' => 'editor', 'fields' => 'all_with_meta' ) );

	/*
		get authors
	*/
		$authors = get_users( array( 'role' => 'author', 'fields' => 'all_with_meta' ) );

	/*
		merge the arrays (wordpress does not give us the option to select both at a time)
		write them to new array and add the hierarchy meta value

	*/

		$mergedusers = array_merge( $editors, $authors );
		$users = array();
		foreach( $mergedusers as $user ) {
			$users[] = array( 
				'id'           => $user->ID, 
				'display_name' => $user->display_name, 
				'hierarchy'    => get_user_meta( $user->ID, 'quan_hierarchy', true ) 
			);
		}

		shuffle( $users );
		usort( $users, function( $a, $b ) {
		    return $b['hierarchy'] - $a['hierarchy'];
		});

	get_header();

	echo '<div class="team-container">';
		echo '<div class="team">';

			foreach( $users as $user ) :
				// dumpit( $user );
				$user_id  = $user['id'];

				if( ! get_user_meta( $user_id, 'author_image', true ) ) 
					continue;

		?>			
				<li class="author">
						
					<?php

						$job           = get_user_meta( $user_id, 'job', true );
						$twitter       = get_user_meta( $user_id, 'twitter', true );
						$xing          = get_user_meta( $user_id, 'xing', true );
						$linkedin      = get_user_meta( $user_id, 'linkedin', true );
						$googleplus    = get_user_meta( $user_id, 'quan_googleplus', true );
						$custom_1_url  = get_user_meta( $user_id, 'quan_custom_1', true );
						$custom_1_name = get_user_meta( $user_id, 'quan_custom_1_name', true );
						$custom_2_url  = get_user_meta( $user_id, 'quan_custom_2', true );
						$custom_2_name = get_user_meta( $user_id, 'quan_custom_2_name', true );

					
					the_author_image( $user_id );
					
					echo '<div class="name">';
						echo $user['display_name'];
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
					if( isset( $googleplus ) && ! empty( $googleplus ) ) :
				?>			
						<div class="social"><a href="<?php echo $googleplus; ?>" target="_blank"><span class="google">Google+</span></a></div>
				<?php 
					endif;
					if( isset( $custom_1_url ) && isset( $custom_1_name ) && ! empty( $custom_1_url ) && ! empty( $custom_1_name ) ) :
				?>			
						<div class="social"><a href="<?php echo $custom_1_url; ?>" target="_blank"><?php echo $custom_1_name; ?></a></div>
				<?php 
					endif; 
					if( isset( $custom_2_url ) && isset( $custom_2_name ) && ! empty( $custom_2_url ) && ! empty( $custom_2_name ) ) :
				?>			
						<div class="social"><a href="<?php echo $custom_2_url; ?>" target="_blank"><?php echo $custom_2_name; ?></a></div>
				<?php 
					endif; 
					echo '</div>';
				?>
				</li>	
			<?php
			endforeach;
		echo '</div>';
	echo '</div>';
	
	get_footer();

