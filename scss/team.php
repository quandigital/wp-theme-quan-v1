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
		$users = get_users( array( 'role' => 'editor' ) );

	get_header();

	echo '<div class="team-container">';
		echo '<div class="team">';
			foreach( $users as $user ) :
				// dumpit( $user );
		?>			
				<li class="author">
						
					<?php
						$user_id  = $user->ID;

						$job      = get_user_meta( $user_id, 'job', true );
						$twitter  = get_user_meta( $user_id, 'twitter', true );
						$xing     = get_user_meta( $user_id, 'xing', true );
						$linkedin = get_user_meta( $user_id, 'linkedin', true );
					
					the_author_image( $user_id );
					
					echo '<div class="name">';
						echo $user->display_name;
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
				</li>	
			<?php
			endforeach;
		echo '</div>';
	echo '</div>';
	
	get_footer();

