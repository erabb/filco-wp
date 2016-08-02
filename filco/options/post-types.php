<?php  
/*
register_post_type('custom-type', array(
	'labels' => array(
		'name'	 => __('Custom Types', 'crb'),
		'singular_name' => __('Custom Type', 'crb'),
		'add_new' => __('Add New', 'crb'),
		'add_new_item' => __('Add new Custom Type', 'crb'),
		'view_item' => __('View Custom Type', 'crb'),
		'edit_item' => __('Edit Custom Type', 'crb'),
		'new_item' => __('New Custom Type', 'crb'),
		'view_item' => __('View Custom Type', 'crb'),
		'search_items' => __('Search Custom Types', 'crb'),
		'not_found' =>  __('No custom types found', 'crb'),
		'not_found_in_trash' => __('No custom types found in trash', 'crb'),
	),
	'public' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => true,
	'_edit_link' =>  'post.php?post=%d',
	'rewrite' => array(
		'slug' => 'custom-type',
		'with_front' => false,
	),
	'query_var' => true,
	'supports' => array('title', 'editor', 'page-attributes'),
));
*/

register_post_type('crb_work', array(
	'labels' => array(
		'name'	 => __('Work', 'crb'),
		'singular_name' => __('Work', 'crb'),
		'add_new' => __('Add New', 'crb'),
		'add_new_item' => __('Add new Work', 'crb'),
		'view_item' => __('View Work', 'crb'),
		'edit_item' => __('Edit Work', 'crb'),
		'new_item' => __('New Work', 'crb'),
		'view_item' => __('View Work', 'crb'),
		'search_items' => __('Search Work', 'crb'),
		'not_found' =>  __('No Work found', 'crb'),
		'not_found_in_trash' => __('No Work found in trash', 'crb'),
	),
	'public' => true,
	'exclude_from_search' => false,
	'show_ui' => true,
	'hierarchical' => false,
	'rewrite' => array(
		'slug' => 'work',
		'with_front' => false,
	),
	'menu_icon' => 'dashicons-list-view',
	'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
));

