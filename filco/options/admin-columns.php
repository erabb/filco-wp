<?php

Carbon_Admin_Columns_Manager::modify_columns('post', array('post', 'crb_recipe', 'crb_tip') )
	->sort( array('cb', 'crb-thumbnail-column') )
	->add( array(
		Carbon_Admin_Column::create('Thumbnail')
			->set_name( 'crb-thumbnail-column' )
			->set_callback('crb_column_render_post_thumbnail')
			->set_width(100),
));

Carbon_Admin_Columns_Manager::modify_columns('post', array('post', 'crb_recipe', 'crb_tip') )
	->add( array(
		Carbon_Admin_Column::create('Featured')
			->set_name( 'crb-featured-column' )
			->set_callback('crb_column_render_featured'),
));