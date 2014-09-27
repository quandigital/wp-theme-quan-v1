<?php

//l18n
add_action('after_setup_theme', 'quan_l18n');
function quan_l18n(){
    load_theme_textdomain( 'quan', get_template_directory() . '/languages' );
}

function dumpit( $var, $dump = 'export', $return = false ) {
	$text = '<code><pre>';
	switch( $dump ) {
		case 'export' : 
			$text .= var_export( $var, true );
			break;
		case 'html' : 
			$text .= htmlentities( var_export( $var, true ) );
			break;
	}
	$text .= '</pre></code>';
	if ( $return ) {
		return $text;
	} else {
		echo $text;
	}
}

//php ini settings
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

// Remove empty paragraph tags
function removeEmptyParagraphs( $content ) {
    $content = str_replace("<p></p>","",$content);
    return $content;
}
add_filter( 'the_content', 'removeEmptyParagraphs', 9999 );
remove_filter('the_excerpt', 'wpautop'); 

// Disable WordPress version reporting as a basic protection against attacks
function remove_generators() {
	return '';
}		

add_filter('the_generator','remove_generators');

add_filter('the_generator', create_function('', 'return "";'));
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


/**
	ENQUEUE SCRIPTS
******/
add_action( 'wp_enqueue_scripts', 'quan_add_scripts' );

function quan_add_scripts() {
	wp_register_script( 'modernizr', get_template_directory_uri() .  '/js/custom.modernizr.js', false, '', false );
	wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://code.jquery.com/jquery-latest.min.js' );
    wp_register_script( 'cookie', get_template_directory_uri() .  '/js/jquery.cookie.js', array( 'jquery' ), '', true );
    wp_register_script( 'scrollspy', get_template_directory_uri() .  '/js/scrollspy.js', array( 'jquery' ), '', true );
    wp_register_script( 'quan_scrollspy', get_template_directory_uri() .  '/js/quan-scrollspy.js', array( 'jquery', 'scrollspy', 'livequery' ), '', true );
    wp_register_script( 'livequery', get_template_directory_uri() .  '/js/livequery.js', array( 'jquery' ), '', true );
    wp_register_script( 'smartresize', get_template_directory_uri() .  '/js/smartresize.js', array( 'jquery' ), '0.1', true );
    wp_register_script( 'smoothscroll', get_template_directory_uri() .  '/js/smoothscroll.js', array( 'jquery' ), '', true );
    wp_register_script( 'app', get_template_directory_uri() .  '/js/app.js', array( 'jquery', 'smartresize', 'fittext', 'lang' ), '', true );
    wp_register_script( 'ajaxposts_home', get_template_directory_uri() .  '/js/ajaxposts-home.js', array( 'jquery' ), '', true );
    wp_register_script( 'spin', get_template_directory_uri() .  '/js/spin.min.js', '', '', true );
    wp_register_script( 'ajaxposts', get_template_directory_uri() .  '/js/ajaxposts.js', array( 'jquery' ), '', true );
    wp_register_script( 'lang', get_template_directory_uri() .  '/js/lang.js', array( 'jquery' ), '', false );
    wp_register_script( 'fittext', get_template_directory_uri() .  '/js/fittext.js', array( 'jquery' ), '', true );
    wp_register_script( 'send-message', get_template_directory_uri() .  '/js/send.js', array( 'jquery' ), '', true );
    wp_register_script( 'frontpage', get_template_directory_uri() .  '/js/frontpage-lang.js', array( 'jquery' ), '', true );

    //styles
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
    wp_enqueue_style( 'app', get_template_directory_uri() . '/css/app.css', 'normalize' );
    
	wp_enqueue_script( array(
		'jquery',
		'modernizr',
		'smartresize',
		'smoothscroll',
		'normalize',
		'app',
		'cookie',
		'lang',
		'fittext'
	) );

	if( is_single() ) {
		wp_enqueue_script( array(
			'scrollspy',
			'livequery',
			'quan_scrollspy',
			'comment-reply'
			)
		);
	}

	if( is_home() ) {
		wp_enqueue_script( array(
			'ajaxposts_home',
			'spin'
			)
		);	
	}

	if( ! is_home() ) {
		wp_enqueue_script( array(
			'ajaxposts'
			)
		);	
	}

	if( is_page_template( 'contact.php' ) ) {
		wp_enqueue_script( array(
			'send-message'
			)
		);
	}

	if( is_front_page() ) {
		wp_enqueue_script( array(
			'frontpage'
			)
		);	
	}

	//pass wordpress url to jquery
	wp_localize_script( 'ajaxposts', 'ajaxpost_localization', array(
		'blog_url' => get_permalink( get_option( 'page_for_posts' ) )
	) );

	wp_localize_script( 'send-message', 'message_localization', array(
		'send_php' => get_template_directory_uri() . '/send.php'
	) );

	wp_localize_script( 'ajaxposts_home', 'ajaxpost_home_localization', array(
		'nothing_here' => '<div id="nothing-here">' . __( 'Nothing here yet. We are working on new blogposts.', 'quan' ) . '</div>'
	) );
	
}
	
// always define ajaxurl
add_action('wp_head','pi_ajaxurl');

function pi_ajaxurl() {
?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
<?php
}

add_action('admin_menu','wphidenag');

function wphidenag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}

/**
 * Inserts an array of strings into a file (.htaccess ), placing it between
 * BEGIN and END markers. Replaces existing marked info. Retains surrounding
 * data. Creates file if none exists.
 *
 * @param array|string $insertion
 * @return bool True on write success, false on failure.
 */

add_action( 'admin_init', 'add_htaccess' );

function add_htaccess($insertion) {
    $htaccess_file = ABSPATH.'.htaccess';
    $insertion = array(
    	'AddType application/vnd.ms-fontobject .eot',
		'AddType font/ttf .ttf',
		'AddType font/otf .otf',
		'AddType application/font-woff .woff',
		'AddType application/x-font-woff .woff',
		'php_value upload_max_filesize 64M',
		'php_value post_max_size 64M'
    	);
    return insert_with_markers($htaccess_file, 'Font-MIME-Type', $insertion);
}

//register header menu
add_action( 'init', 'quan_header_menu' );

function quan_header_menu() {
	register_nav_menus( 
		array(
			'header-menu' => 'Header Menu',
			'footer-menu' => 'Footer Menu'
		)
	);
}

function quan_comments_display($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
	?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		
		<div class="comment-author vcard">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php $build_link = '<a href="' . $comment->comment_author_url . '" rel="nofollow external" class="url" target="_blank">' . $comment->comment_author . '</a>'; ?>
			<?php printf( '<span class="fn">%s', $build_link ) ?>
				 <span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time(), 'quan' ) ?></a><?php edit_comment_link( __( '(Edit)', 'quan' ),'  ','' );
					?>
				</span>
			</span>
		</div>
	<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'quan' ) ?></em>
		<br />
	<?php endif; ?>

	<?php comment_text() ?>

	<div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
	</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
        }

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );

function sgr_filter_image_sizes( $sizes) {
		
	unset( $sizes['thumbnail']);
	unset( $sizes['medium']);
	unset( $sizes['large']);
	
	return $sizes;
}

add_filter('intermediate_image_sizes_advanced', 'sgr_filter_image_sizes');

require_once('aq_resizer.php');

add_theme_support( 'post-thumbnails' );


// add_action('wp_footer', 'show_template');
function show_template( $return = false ) {
    global $template;
    switch ( $return ) {
    	case false:
    		print_r( $template );
    		break;
    	case true :
    		return( $template );
    		break;
    }
}


add_action( 'wp_ajax_nopriv_quan_query_posts', 'quan_load_posts' );
add_action( 'wp_ajax_quan_query_posts', 'quan_load_posts' );

function quan_load_posts() {
	$query_strings = $_POST[ 'query_strings' ];
	if( isset( $query_strings['cat_id'] ) ) {
		$cat_id = $query_strings['cat_id'];
		$cat_id = str_replace( 'cat-', '', $cat_id );
	}
	if( isset( $query_strings['tag_id'] ) ) {
		$tag_id = $query_strings['tag_id'];
		$tag_id = str_replace( 'tag-', '', $tag_id );
	}
	if( isset( $query_strings['lang'] ) ) {
		$query_lang = $query_strings['lang'];
		$lang = explode(', ', $query_lang );
	}
	if( isset( $query_strings['twitter'] ) ) {
		$twitter = $query_strings['twitter'];
	}

	if( isset( $twitter ) && $twitter === 'true' ) {
		$posttypes = array( 'post', 'quan_tweets' );
	} else {
		$posttypes = array( 'post' );
	}

	$args = array(
		'post_type'      => $posttypes,
		'posts_per_page' => -1,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
	);

	if( isset( $cat_id ) ) {
		$args['cat'] = $cat_id;
	}

	if( isset( $tag_id ) ) {
		$args['tag_id'] = $tag_id;
	}

	if( isset( $lang ) ) {
		$taxquery = array(
				array(
					'taxonomy' => 'language',
					'field'    => 'slug',
					'terms'    => $lang,
				)
			
		);
		$args['tax_query'] = $taxquery;
			
	}

	$ajax_query = new WP_Query( $args );

	$ajax_ids = array();

	if( $ajax_query->have_posts() ) :
		while( $ajax_query->have_posts() ) :
			$ajax_query->the_post();

			$ajax_ids[] = get_the_id();

		endwhile;
	endif;
	
	// echo json_encode( $args );
	echo json_encode( $ajax_ids );

	die();

}

add_action( 'personal_options_update', 'quan_transfer_gplus_authorurl' );
add_action( 'edit_user_profile_update', 'quan_transfer_gplus_authorurl' );

function quan_transfer_gplus_authorurl( $user_id ) {
	$user_login = get_the_author_meta('user_login', $user_id);
    $author_links = get_option('apau_author_links');
	
    if( isset( $_POST['googleplus'] ) && ! empty( $_POST['googleplus'] ) ) {
    	if( $_POST['googleplus'] == $author_links[$user_login] ) {
    		die();
    	} else {
    		$author_links[$user_login] = $_POST['googleplus'];
    	}
    }

	update_option( 'apau_author_links', $author_links );    

    // error_log( $log . "\n", 3, get_theme_root() . '/sailor-quan/debug.log' );
}

add_action( 'after_setup_theme', 'quan_contact_email' );

function quan_contact_email() {
	update_option( 'quan_contact_email', 'mail@quandigital.com' );
}


//customize the excerpt
function custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	$readmore  = "\n";
	$readmore .= '<a href="' . get_permalink() . '">';
	$readmore .= __( 'Details', 'quan' );
	$readmore .= '</a>';

	return $readmore;
}
add_filter('excerpt_more', 'new_excerpt_more');


function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

function quan_job_excerpt() {
	$content = get_the_content_with_formatting();
	 
	 //remove any new lines already in there
    $content = str_replace("\n", "", $content);

    //remove all <p>
    $content = str_replace("<p>", "", $content);

    //replace it just with a random string that should not occur anywhere else
    $content = str_replace("</p>", "::|::", $content);      

    $content_array = explode( '::|::', $content );
	
	return '<p>' . $content_array[0] . '</p><a class="job-details" href="' . get_permalink() . '">' . __( 'Details', 'quan' ) . ' &rarr;</a>';
}

/**
 * Auto-subscribe or unsubscribe an Edit Flow user group when a post changes status
 *
 * @see http://editflow.org/extend/auto-subscribe-user-groups-for-notifications/
 *
 * @param string $new_status New post status
 * @param string $old_status Old post status (empty if the post was just created)
 * @param object $post The post being updated
 * @return bool $send_notif Return true to send the email notification, return false to not
 */
function efx_auto_subscribe_usergroup( $new_status, $old_status, $post ) {
    global $edit_flow;
 
    // When the post is first created, the group copy editors will automatically follow this post
    if ( in_array( $new_status, array( 'pitch', 'pending' ) ) ) {
        $copyeditors = get_term_by( 'slug', 'ef-usergroup-copy-editors', 'ef_usergroup' );
        $usergroup_ids_to_follow = $copyeditors->term_id;
        $edit_flow->notifications->follow_post_usergroups( $post->ID, $usergroup_ids_to_follow, true );
    }
 
    // Return true to send the email notification
    return $new_status;
}

add_filter( 'ef_notification_status_change', 'efx_auto_subscribe_usergroup', 10, 3 );


/**
 * Limit custom statuses based on user role
 * In this example, we limit the statuses available to the
 * 'contributor' user role
 *
 * @see http://editflow.org/extend/limit-custom-statuses-based-on-user-role/
 *
 * @param array $custom_statuses The existing custom status objects
 * @return array $custom_statuses Our possibly modified set of custom statuses
 */
function efx_limit_custom_statuses_by_role( $custom_statuses ) {
 
    $current_user = wp_get_current_user();
    switch( $current_user->roles[0] ) {
        // Only allow a contributor to access specific statuses from the dropdown
        case 'author':
            $permitted_statuses = array(
                    'pitch',
                    'draft',
                    'pending'
                );
            // Remove the custom status if it's not whitelisted
            foreach( $custom_statuses as $key => $custom_status ) {
                if ( !in_array( $custom_status->slug, $permitted_statuses ) )
                    unset( $custom_statuses[$key] );
            }
            break;
    }
    return $custom_statuses;
}
add_filter( 'ef_custom_status_list', 'efx_limit_custom_statuses_by_role' );

/**
 * Hide the "Publish" button until a post is ready to be published
 * In this example, we only show the "Publish button" until the post has the "Pending" status
 *
 * @see http://editflow.org/extend/hide-the-publish-button-for-certain-custom-statuses/
 */
function efx_hide_publish_button_until() {
 
    if ( ! function_exists( 'EditFlow' ) )
        return;
 
    if ( ! EditFlow()->custom_status->is_whitelisted_page() )
        return;
 
    // Show the publish button if the post has one of these statuses
    $show_publish_button_for_status = array(
            'pending',
            // The statuses below are WordPress' public statuses
            'future',
            'publish',
            'schedule',
            'private',
        );
    if ( ! in_array( get_post_status(), $show_publish_button_for_status ) ) {
        ?>
        <style>
            #publishing-action { display: none; }
        </style>
        <?php
    }
}
add_action( 'admin_head', 'efx_hide_publish_button_until' );


function efx_only_allow_status( $custom_statuses ) {
	$screen = get_current_screen();
    $current_user = wp_get_current_user();
    $status = get_post_status();

   
    if( $screen->base == 'post' && $screen->action == 'add' && $screen->post_type == 'post' ) { //new post screen
	    switch( $current_user->roles[0] ) {
	        // Only allow pitch for author
	        case 'author':
	            $permitted_statuses = array(
	                    'pitch'
	                );
	            // Remove the custom status if it's not whitelisted
	            foreach( $custom_statuses as $key => $custom_status ) {
	                if ( !in_array( $custom_status->slug, $permitted_statuses ) )
	                    unset( $custom_statuses[$key] );
	            }
	            break;
	    }
	} elseif( $screen->base == 'post' && $screen->action == '' && $screen->post_type == 'post' && $status = 'assigned' ) { //should be the edit screen
		switch( $current_user->roles[0] ) {
	        // Only allow a contributor to access specific statuses from the dropdown
	        case 'author':
	            $permitted_statuses = array(
	                    'pitch',
	                    'draft',
	                    'pending'
	                );
	            // Remove the custom status if it's not whitelisted
	            foreach( $custom_statuses as $key => $custom_status ) {
	                if ( !in_array( $custom_status->slug, $permitted_statuses ) )
	                    unset( $custom_statuses[$key] );
	            }
	            break;
	    }
	} elseif( $screen->base == 'post' && $screen->post_type == 'quan_jobs' ) { 
		switch( $current_user->roles[0] ) {
	        // Only allow a contributor to access specific statuses from the dropdown
	        case 'author':
	            $permitted_statuses = array(
	                    'pitch',
	                    'draft',
	                    'pending'
	                );
	            // Remove the custom status if it's not whitelisted
	            foreach( $custom_statuses as $key => $custom_status ) {
	                if ( !in_array( $custom_status->slug, $permitted_statuses ) )
	                    unset( $custom_statuses[$key] );
	            }
	            break;
	    }
	}

    return $custom_statuses;
}

add_filter( 'ef_custom_status_list', 'efx_only_allow_status', 10, 3 );

// add_action('admin_head', 'my_admin_add_page');

function my_admin_add_page() {
	$status = get_post_status();

	echo '<code><pre>';
		var_dump($status);
	echo '</pre></code>';
}