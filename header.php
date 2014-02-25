<?php 	
	include( WP_CONTENT_FOLDERNAME . '/lang.php' ); 
	if( is_single() && $post->post_type == 'post' ) {
		$postlang = wp_get_post_terms( $post->ID, 'language' );
		$postlang = $postlang[0]->slug;
	}
	if( ! isset( $postlang ) ) {
		$postlang = $lang;
	}
?>

<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="<?php echo is_single() ? $postlang : $lang ; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo is_single() ? $postlang : $lang ; ?>"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php bloginfo( 'name' ); ?></title>

	<?php wp_head(); ?>
	<script>
		var $ = jQuery.noConflict();
		if(window.navigator.msMaxTouchPoints) {
			$( 'html' ).removeClass( 'no-touch' ).addClass( 'touch' );
		}
	</script>
</head>
<body <?php body_class(); ?>>

	
	<header>
		<a href="<?php bloginfo( 'wpurl' ); ?>"><img src="<?php echo get_template_directory_uri() . '/images/QuanDigital.svg'; ?>" alt="" height="100" width="135" /></a>
		<div>
			<?php //wp_nav_menu( array( 'theme_location' => 'header-menu' ) );
				$categories = get_categories( array( 'hide_empty' => 0 ) ); 
				if( is_home() ) {
					$home_page = '';
				} else {
					$home_page = get_permalink( get_option( 'page_for_posts' ) );
				}
			?>
				<div class="menu-header-container">
					<div id="menu-handle" class="menu-small-handle ion-grid"></div>
					<ul id="category-menu" class="menu">
						<?php
							//Hardcoded menu, bad stuff but ok for now
							$jobs = wp_count_posts( 'quan_jobs' );
							$jobs_open = $jobs->publish;
						?>
							<li><a href="<?php echo get_bloginfo( 'wpurl' ); ?>/blog"><?php _ex( 'Blog', 'Please replace any spaces by &amp;nbsp;', 'quan' ); ?></a></li>
							<li><a href="<?php echo get_bloginfo( 'wpurl' ); ?>/team"><?php _ex( 'Team', 'Please replace any spaces by &amp;nbsp;', 'quan' ); ?></a></li>
							<li><a href="<?php echo get_bloginfo( 'wpurl' ); ?>/tour"><?php _ex( 'Take&nbsp;the&nbsp;Tour', 'Please replace any spaces by &amp;nbsp;', 'quan' ); ?></a></li>
							<?php
								if( $jobs_open > 0 ) : 
							?>
								<li><a href="<?php echo get_bloginfo( 'wpurl' ); ?>/jobs"><?php _ex( 'Jobs', 'Please replace any spaces by &amp;nbsp;', 'quan' ); ?><span class="job-count"><?php echo $jobs_open; ?></span></a></li>	
							<?php
								endif;
							?>
							<li><a href="<?php echo get_bloginfo( 'wpurl' ); ?>/contact"><?php _ex( 'Contact', 'Please replace any spaces by &amp;nbsp;', 'quan' ); ?></a></li>
						<!-- <li id="cat-all"><a class="ajax" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e( 'All Posts', 'quan' ); ?></a></li>
					    <?php foreach ( $categories as $cat ) { ?>
						    <li id="cat-<?php echo $cat->term_id; ?>"><a class="category-<?php echo $cat->slug; ?> ajax" href="<?php echo get_category_link( $cat->cat_ID ); ?>"><?php echo $cat->name; ?></a></li>
					    <?php } ?> -->
					</ul>
				</div>
		</div>
	</header>
	

	<div id="main" class="main-container">	
	