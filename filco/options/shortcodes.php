<?php

/**
 * Returns current year
 *
 * @uses [year]
 */
add_shortcode('year', 'crb_shortcode_year');
function crb_shortcode_year() {
	return date('Y');
}

/**
 * Example Shortcode
 */
/*add_shortcode('example', 'crb_shortcode_example');
function crb_shortcode_example($atts, $content) {
	$atts = shortcode_atts(
		array(
			'example_attribute' => 'example_value',
		),
		$atts, 'example'
	);

	ob_start();
	?>
	<div class="shortcode-">
		<!-- -->
	</div>
	<?php
	$html = ob_get_clean();

	return $html;
}*/

/**
 * Button Shortcode
 */
add_shortcode('button', 'crb_shortcode_button');
add_shortcode('button-change', 'crb_shortcode_button');
// add_shortcode('button-white', 'crb_shortcode_button');
function crb_shortcode_button($atts, $content, $shortcode) {
	$atts = shortcode_atts(
		array(
			'link' => '#',
			'target' => '',
		),
		$atts, 'button'
	);

	$button_settings = array(
		'classes' => array(
			'button' => 'btn',
			'button-change' => 'button-change',
		)
	);

	$target = '';
	if ( !empty($atts['target']) ) {
		$target = 'target="_' . esc_attr($atts['target']) . '"';
	}

	ob_start();
	?>
	<a
		href="<?php echo esc_url($atts['link']); ?>"
		class="<?php echo $button_settings['classes'][$shortcode]; ?>"
		<?php echo $target; ?>
	>
		<?php echo $content; ?>
	</a>
	<?php
	$html = ob_get_clean();

	return $html;
}

/**
 * Zip Shortcode
 */
add_shortcode('zip', 'crb_shortcode_zip');
function crb_shortcode_zip($atts, $content, $shortcode) {
	$html = '';
	$zip = crb_request_param('zip');
	if ( !empty($zip) ) {
		$html = $zip;
	}
	
	return $html;
}