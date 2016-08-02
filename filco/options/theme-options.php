<?php

Carbon_Container::factory('theme_options', __('Theme Options', 'crb'))
	->add_fields(array(
		Carbon_Field::factory('header_scripts', 'crb_header_script', __('Header Script', 'crb')),
		Carbon_Field::factory('footer_scripts', 'crb_footer_script', __('Footer Script', 'crb')),
	));
?>