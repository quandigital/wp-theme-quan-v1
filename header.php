	
<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php bloginfo( 'name' ); ?></title>

	<?php wp_head(); ?>
	<script>
		var $ = jQuery.noConflict();
		if (window.navigator.msMaxTouchPoints) {
			$( 'html' ).removeClass( 'no-touch' ).addClass( 'touch' );
		}
	</script>
	<!--script src="http://192.168.2.50:8080/target/target-script-min.js#anonymous"></script-->
</head>
<body <?php body_class(); ?>>
	
	<header>
		<a href="<?php bloginfo( 'wpurl' ); ?>"><img src="<?php echo get_template_directory_uri() . '/images/QuanDigital.svg'; ?>" alt="" height="100" /></a>
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
					<ul id="category-menu" class="menu">
						<li id="cat-all"><a class="ajax" href="<?php get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php _e( 'All Posts' ); ?></a></li>
					    <?php foreach ( $categories as $cat ) { ?>
						    <li id="cat-<?php echo $cat->term_id; ?>"><a class="category-<?php echo $cat->slug; ?> ajax" href="<?php echo get_category_link( $cat->cat_ID ); ?>"><?php echo $cat->name; ?></a></li>
					    <?php } ?>
					</ul>
				</div>
		</div>
	</header>
	

	<div id="main" class="main-container">	