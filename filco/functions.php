<?php
$template_dir = get_template_directory_uri();
define('CRB_THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);

# Enqueue JS and CSS assets on the front-end
add_action('wp_enqueue_scripts', 'crb_wp_enqueue_scripts');
function crb_wp_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue Comments JS file
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
}


add_action('after_setup_theme', 'crb_setup_theme');

# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if (!function_exists('crb_setup_theme')) {
	function crb_setup_theme() {
		# Make this theme available for translation.
		load_theme_textdomain( 'crb', get_template_directory() . '/languages' );

		# Common libraries
		include_once(CRB_THEME_DIR . 'lib/common.php');
		include_once(CRB_THEME_DIR . '/lib/carbon-fields/carbon-fields.php');
		include_once(CRB_THEME_DIR . '/lib/carbon-validator/carbon-validator.php');
		include_once(CRB_THEME_DIR . '/lib/admin-column-manager/carbon-admin-columns-manager.php');

		add_action('carbon_register_fields', 'crb_attach_theme_options');

		if ( !function_exists('wpthumb') ) {
			include_once(CRB_THEME_DIR . 'includes/wp-thumb/wpthumb.php');
		}
		include_once(CRB_THEME_DIR . 'includes/images.php');
		
		# Theme supports
		add_theme_support('automatic-feed-links');
		add_theme_support('menus');
		add_theme_support('post-thumbnails');
		add_theme_support('wpthumb-crop-from-position');
	}
}

# Attach Custom Post Types and Custom Taxonomies
add_action('init', 'crb_attach_post_types_and_taxonomies', 0);
function crb_attach_post_types_and_taxonomies() {
	# Attach Custom Post Types
	include_once(CRB_THEME_DIR . 'options/post-types.php');

	# Attach Custom Taxonomies
	include_once(CRB_THEME_DIR . 'options/taxonomies.php');
}

function crb_attach_theme_options() {
	# Attach fields
	include_once(CRB_THEME_DIR . 'options/theme-options.php');
	include_once(CRB_THEME_DIR . 'options/custom-fields.php');
}

// Return link target, depending of checkbox field
function crb_the_target( $field = '' ) {
	echo crb_return_target($field);
}

function crb_return_target( $field = '' ) {
	$target = '';
	if ( !empty($field) ) {
		$target = 'target="_blank"';
	}

	return $target;
}

// Includes
function crb_get_fragment( $template, $fragment_passed_args = array() ) {
	include( locate_template( $template . '.php' ) );
}

function crb_get_blog_url() {
	$page_for_posts = get_option('page_for_posts');

	if( !empty($page_for_posts) ) {
		return get_permalink( $page_for_posts );
	} else {
		return home_url('/');
	}
}

function crb_get_post_type( $post = null ) {
	if ( is_page_template('templates/recipes.php') ) {
		return 'crb_recipe';
	} elseif ( is_page_template('templates/tips.php') ) {
		return 'crb_tip';
	} elseif ( is_home() ) {
		return 'post';
	}

	if ( $post = get_post( $post ) ) {
		return $post->post_type;
	}

	return false;
}

add_filter('excerpt_more', 'crb_new_excerpt_more');
function crb_new_excerpt_more( $more ) {
	return '...';
}

add_filter( 'excerpt_length', 'crb_custom_excerpt_length', 999 );
function crb_custom_excerpt_length( $length ) {
	return 8;
}

// Finds the first page ID, using specific Template
function crb_get_id_from_template($template_name) {
	$gallery_template_pages = get_posts(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'posts_per_page' => 1,
		'meta_value' => $template_name,
		'fields' => 'ids'
	));

	if ( !empty($gallery_template_pages[0]) ) {
		return $gallery_template_pages[0];
	}

	return 0;
}

function crb_get_current_related_page() {
	$paged = crb_request_param('related-posts-page');

	if ( !$paged ) {
		$paged = 1;
	} else {
		$paged = absint($paged);
	}

	return $paged;
}

function crb_get_next_posts_page_link($max_page = 0) {
	$paged = crb_get_current_related_page();

	$nextpage = intval($paged) + 1;

	if ( !$max_page || $max_page >= $nextpage ) {
		return add_query_arg('related-posts-page', $nextpage);
	}
}

function crb_column_render_featured($post_id) {
	$crb_post_is_featured = carbon_get_post_meta($post_id, 'crb_post_is_featured');
	if ( !empty($crb_post_is_featured) && $crb_post_is_featured == 'yes' ) {
		echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/tick.png" alt="" width="32" height="32" />';
	}

	return '';
}

function crb_get_post_type_nice_name() {
	$post_type = crb_get_post_type();
	$post_type = str_replace('crb_', '', $post_type);
	$post_type = str_replace('_', ' ', $post_type);
	$post_type = ucfirst($post_type);

	return $post_type;
}

// Hide Reorder for specific post types
add_action( 'admin_menu', 'crb_hide_post_type_order', 99 );
function crb_hide_post_type_order() {
	remove_submenu_page('edit.php', 'order-post-types-post');
	remove_submenu_page('edit.php?post_type=crb_recipe', 'order-post-types-crb_recipe');
	remove_submenu_page('edit.php?post_type=crb_tip', 'order-post-types-crb_tip');
}


function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
remove_filter( 'the_title', 'wptexturize' );


/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    
    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
   
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

add_image_size( 'work-size', 800, 600, true );


?>