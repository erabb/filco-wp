<?php

# Custom hierarchical taxonomy (like categories)
/*register_taxonomy(
	'custom_taxonomy', # Taxonomy name
	array('post_type'), # Post Types
	array( # Arguments
		'labels'            => array(
			'name'              => __('Custom Taxonomies', 'crb'),
			'singular_name'     => __('Custom Taxonomy', 'crb'),
			'search_items'      => __('Search Custom Taxonomies', 'crb'),
			'all_items'         => __('All Custom Taxonomies', 'crb'),
			'parent_item'       => __('Parent Custom Taxonomy', 'crb'),
			'parent_item_colon' => __('Parent Custom Taxonomy:', 'crb'),
			'view_item'         => __('View Custom Taxonomy', 'crb'),
			'edit_item'         => __('Edit Custom Taxonomy', 'crb'),
			'update_item'       => __('Update Custom Taxonomy', 'crb'),
			'add_new_item'      => __('Add New Custom Taxonomy', 'crb'),
			'new_item_name'     => __('New Custom Taxonomy Name', 'crb'),
			'menu_name'         => __('Custom Taxonomies', 'crb'),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'custom-taxonomy' ),
	)
);

# Custom non-hierarchical taxonomy (like tags)
register_taxonomy(
	'custom_taxonomy', # Taxonomy name
	array('post_type'), # Post Types
	array( # Arguments
		'labels'            => array(
			'name'                       => __('Custom Taxonomies', 'crb'),
			'singular_name'              => __('Custom Taxonomy', 'crb'),
			'search_items'               => __('Search Custom Taxonomies', 'crb'),
			'popular_items'              => __('Popular Custom Taxonomies', 'crb'),
			'all_items'                  => __('All Custom Taxonomies', 'crb'),
			'view_item'                  => __('View Custom Taxonomy', 'crb'),
			'edit_item'                  => __('Edit Custom Taxonomy', 'crb'),
			'update_item'                => __('Update Custom Taxonomy', 'crb'),
			'add_new_item'               => __('Add New Custom Taxonomy', 'crb'),
			'new_item_name'              => __('New Custom Taxonomy Name', 'crb'),
			'separate_items_with_commas' => __('Separate Custom Taxonomies with commas', 'crb'),
			'add_or_remove_items'        => __('Add or remove Custom Taxonomies', 'crb'),
			'choose_from_most_used'      => __('Choose from the most used Custom Taxonomies', 'crb'),
			'not_found'                  => __('No Custom Taxonomies found.', 'crb'),
			'menu_name'                  => __('Custom Taxonomies', 'crb'),
		),
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'custom-taxonomy' ),
	)
);
*/

register_taxonomy(
	'crb_location_category', # Taxonomy name
	array('crb_location'), # Post Types
	array( # Arguments
		'labels'            => array(
			'name'              => __('Categories', 'crb'),
			'singular_name'     => __('Category', 'crb'),
			'search_items'      => __('Search Categories', 'crb'),
			'all_items'         => __('All Categories', 'crb'),
			'parent_item'       => __('Parent Category', 'crb'),
			'parent_item_colon' => __('Parent Category:', 'crb'),
			'view_item'         => __('View Category', 'crb'),
			'edit_item'         => __('Edit Category', 'crb'),
			'update_item'       => __('Update Category', 'crb'),
			'add_new_item'      => __('Add New Category', 'crb'),
			'new_item_name'     => __('New Category Name', 'crb'),
			'menu_name'         => __('Categories', 'crb'),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'location-category' ),
	)
);

register_taxonomy(
	'crb_recipe_type', # Taxonomy name
	array('crb_recipe'), # Post Types
	array( # Arguments
		'labels'            => array(
			'name'              => __('Chicken Types', 'crb'),
			'singular_name'     => __('Chicken Type', 'crb'),
			'search_items'      => __('Search Chicken Types', 'crb'),
			'all_items'         => __('All Chicken Types', 'crb'),
			'parent_item'       => __('Parent Chicken Type', 'crb'),
			'parent_item_colon' => __('Parent Chicken Type:', 'crb'),
			'view_item'         => __('View Chicken Type', 'crb'),
			'edit_item'         => __('Edit Chicken Type', 'crb'),
			'update_item'       => __('Update Chicken Type', 'crb'),
			'add_new_item'      => __('Add New Chicken Type', 'crb'),
			'new_item_name'     => __('New Chicken Type Name', 'crb'),
			'menu_name'         => __('Chicken Types', 'crb'),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'public'            => true,
		'rewrite'           => array( 'slug' => 'recipe-type' ),
	)
);

register_taxonomy(
	'crb_live_type', # Taxonomy name
	array('crb_live'), # Post Types
	array( # Arguments
		'labels'            => array(
			'name'              => __('Live Event Types', 'crb'),
			'singular_name'     => __('Live Event Type', 'crb'),
			'search_items'      => __('Search Live Event Types', 'crb'),
			'all_items'         => __('All Live Event Types', 'crb'),
			'parent_item'       => __('Parent Live Event Type', 'crb'),
			'parent_item_colon' => __('Parent Live Event Type:', 'crb'),
			'view_item'         => __('View Live Event Type', 'crb'),
			'edit_item'         => __('Edit Live Event Type', 'crb'),
			'update_item'       => __('Update Live Event Type', 'crb'),
			'add_new_item'      => __('Add New Live Event Type', 'crb'),
			'new_item_name'     => __('New Live Event Type Name', 'crb'),
			'menu_name'         => __('Live Event Types', 'crb'),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'public'            => true,
		'rewrite'           => array( 'slug' => 'event-type' ),
	)
);

register_taxonomy(
	'crb_tip_type', # Taxonomy name
	array('crb_tip'), # Post Types
	array( # Arguments
		'labels'            => array(
			'name'              => __('Types', 'crb'),
			'singular_name'     => __('Type', 'crb'),
			'search_items'      => __('Search Types', 'crb'),
			'all_items'         => __('All Types', 'crb'),
			'parent_item'       => __('Parent Type', 'crb'),
			'parent_item_colon' => __('Parent Type:', 'crb'),
			'view_item'         => __('View Type', 'crb'),
			'edit_item'         => __('Edit Type', 'crb'),
			'update_item'       => __('Update Type', 'crb'),
			'add_new_item'      => __('Add New Type', 'crb'),
			'new_item_name'     => __('New Type Name', 'crb'),
			'menu_name'         => __('Types', 'crb'),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tip-type' ),
	)
);