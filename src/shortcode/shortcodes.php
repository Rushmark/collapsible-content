<?php
/**
* shortcode processors
* 
* @package rushmark\collapsiblecontent\shortcode
* @since 1.0.0
* @author Chris Clarke
* @link https://www.chrisclarkewebservices.co.uk
* @license GNU-2.0+
*/
namespace rushmark\collapsiblecontent\shortcode;



// [qa question="What question would you like to ask me?" show_icon"" hide_icon""]This is my answer[/qa]
// [teaser visible_message="What question would you like to ask me?" show_icon"" hide_icon""]This is my answer[/teaser]

add_shortcode( 'qa', __NAMESPACE__ . '\process_the_shortcode' );
add_shortcode( 'teaser', __NAMESPACE__ . '\process_the_shortcode' );
/**
 * Process the Shortcode to build a list .
 *
 * @since 1.0.0
 *
 * @param array|string $user_defined_attributes User defined attributes for this shortcode instance
 * @param string|null $hidden_content Content between the opening and closing shortcode elements
 * @param string $shortcode_name Name of the shortcode
 *
 * @return string
 */
function process_the_shortcode( $user_defined_attributes, $hidden_content, $shortcode_name ) {
	$config = get_shortcode_configuration( $shortcode_name );
	
	$attributes = shortcode_atts(
		$config['defaults'],
		$user_defined_attributes,
		$shortcode_name
		);

	// do the processing
	$attributes['show_icon'] = esc_attr( $attributes['show_icon'] );
	if ( $hidden_content ) {
		$hidden_content = do_shortcode( $hidden_content );
		
	}

	// Call the view file, capture it into the output buffer, and then return it.
	ob_start();
	include( $config['view'] );
	return ob_get_clean();
}

/** 
 * Get the runtime configuration parameters 
 *
 * @since 1.0.0
 *
 * @param  string $shortcode_name of the shortcode 
 *
 * @return array
 *
 */

function get_shortcode_configuration( $shortcode_name ){
	$config = array(
		'view' => __DIR__ . '/views/' . $shortcode_name . '.php',
		'defaults' => array(
			'show_icon' => 'dashicons dashicons-arrow-down-alt2',
			'hide_icon' => 'dashicons dashicons-arrow-up-alt2',
		),
	);
	if ( $shortcode_name == 'qa') {
		$config['defaults']['question'] .= '';
		
	} elseif ( $shortcode_name == 'teaser') {
		$config['defaults']['visible_message'] .= '';

	}
	return $config;
}
