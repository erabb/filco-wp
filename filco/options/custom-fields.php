<?php

/* ==========================================================================
	# Tip - Post Type
========================================================================== */
Carbon_Container::factory('custom_fields', __('Details', 'crb'))
	->show_on_post_type('crb_work')
	->add_fields(array(
		Carbon_Field::factory('select', 'crb_work_type', __('Work type?', 'crb'))
			->add_options(array(
				'video' => 'Video',
				'image' => 'Image',
				'3d' => '3D Model'
			)),
		Carbon_Field::factory('text', 'crb_vimeo_id', __('Vimeo ID', 'crb')),
		Carbon_Field::factory('text', 'crb_order', __('Work Order', 'crb')),
		Carbon_Field::factory('select', 'crb_featured', __('Feature on the homepage?', 'crb'))
			->add_options(array(
				'yes' => 'Yes',
				'no' => 'No'
			)),

	));