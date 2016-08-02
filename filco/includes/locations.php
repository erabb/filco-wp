<?php

// Generate location categories for custom select field options
function crb_get_location_categories_options() {
	$location_category_terms = get_terms('crb_location_category', array(
		'hide_empty'        => true, 
		'number'            => '', 
	));

	$ids = wp_list_pluck($location_category_terms, 'term_id');
	$names = wp_list_pluck($location_category_terms, 'name');

	return array_combine($ids, $names);
}

// Calculate the closest location, based on the current location.
function crb_get_closests_locations($lat, $lng, $cat = 3) {
	global $wpdb;

	$result = $wpdb->get_results(
		"SELECT posts.ID,
			( 3959 * acos( cos( radians('$lat') ) * 
			cos( radians( postmeta_lat.meta_value ) ) * 
			cos( radians( postmeta_lng.meta_value ) - 
			radians('$lng') ) + 
			sin( radians('$lat') ) * 
			sin( radians( postmeta_lat.meta_value ) ) ) ) 
		AS distance 
		FROM $wpdb->posts AS posts
			INNER JOIN  $wpdb->postmeta AS postmeta_lat
				ON posts.ID = postmeta_lat.post_id
			INNER JOIN  $wpdb->postmeta AS postmeta_lng
				ON posts.ID = postmeta_lng.post_id
			INNER JOIN $wpdb->term_relationships AS tr
				ON posts.ID = tr.object_id
			INNER JOIN $wpdb->term_taxonomy AS tt
				ON tr.term_taxonomy_id = tt.term_taxonomy_id
			INNER JOIN $wpdb->terms AS t
				ON tt.term_id = t.term_id
		WHERE postmeta_lat.meta_key = '_crb_location_map-lat'
			AND postmeta_lng.meta_key = '_crb_location_map-lng'
			AND tt.taxonomy = 'crb_location_category'
			AND t.term_id = $cat
		ORDER BY distance ASC LIMIT 200"
	);
	return $result;
}

// Generate locations data
function crb_get_locations_data() {
	// Required post/get params to work
	$zip = crb_request_param('zip');
	$lat = crb_request_param('lat');
	$lng = crb_request_param('lng');
	$is_params_valid = !empty($zip) && !empty($lat) && !empty($lng);
	
	// Generate locations count (per column)
	$crb_locations_per_page = carbon_get_the_post_meta('crb_locations_per_page');
	$locations_count = 5;
	if ( !empty($crb_locations_per_page) ) {
		$locations_count = absint($crb_locations_per_page);
	}

	$location_queries = array();
	$markers = array();
	$columns = array('left', 'right');
	foreach ($columns as $column) {
		if ( !$is_params_valid ) {
			continue;
		}

		// Find the closest location to the currently used one
		$crb_locations_taxonomy = carbon_get_the_post_meta('crb_locations_' . $column . '_taxonomy');

		$closest_locations = crb_get_closests_locations($lat, $lng, $crb_locations_taxonomy);
		$closest_locations = wp_list_pluck($closest_locations, 'ID');

		//Protect against arbitrary paged values
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		// Hold all locations, displayed on the map here
		$location_queries[$column] = new WP_Query(array(
			'post_type' => 'crb_location',			
			'post__in' => $closest_locations,
			'orderby' => 'post__in',			
			/*'orderby' => array(
				'post__in' => 'ASC',
				'menu_order' => 'ASC',
			),*/
			'posts_per_page' => $paged * $locations_count, // Limit the visible locations to all locations until the current page
		));
		
		// Hold locations from the current page, displayed as content, used inside ajax
		$location_queries[$column . '-limited'] = new WP_Query(array(
			'post_type' => 'crb_location',			
			'post__in' => $closest_locations,
			'orderby' => 'post__in',			
			/*'orderby' => array(
				'post__in' => 'ASC',
				'menu_order' => 'ASC',
			),*/
			'posts_per_page' => $locations_count,
			'paged' => $paged,
		));

		// Markers
		while ( $location_queries[$column]->have_posts() ) { $location_queries[$column]->the_post();
			$crb_location_map = carbon_get_the_post_meta('crb_location_map', 'map');
			if ( empty($crb_location_map) ) {
				continue;
			}

			$marker_lat = $crb_location_map['lat'];
			$marker_lng = $crb_location_map['lng'];
			$markers[$column . '-map-' . $location_queries[$column]->current_post] = array(
				'lat' => $marker_lat,
				'lng' => $marker_lng,
			);
		}
		wp_reset_postdata();
	}

	if ( !empty($markers) ) {
		$markers = json_encode($markers);
	}

	$form_class = '';
	$content_class = '';
	if ( $is_params_valid ) {
		$form_class = 'hidden';
	} else {
		$content_class = 'hidden';
	}

	// Prepare next post link
	$max_num_pages_array = wp_list_pluck($location_queries, 'max_num_pages');
	$left_max_num_pages = !empty($max_num_pages_array['left-limited']) ? $max_num_pages_array['left-limited'] : 0;
	$right_max_num_pages = !empty($max_num_pages_array['right-limited']) ? $max_num_pages_array['right-limited'] : 0;

	$max_num_pages = max($left_max_num_pages, $right_max_num_pages);

	$next_posts_link = get_next_posts_page_link($max_num_pages);
	if ( !empty($next_posts_link) ) {
		$next_posts_link = add_query_arg(
			array(
				'zip' => $zip,
				'lat' => $lat,
				'lng' => $lng,
			), 
			$next_posts_link
		);
	}

	return array($markers, $location_queries, $form_class, $content_class, $next_posts_link);
}