<?php
/**
* shortcode processors
* 
* @package rushmark\module\faq\shortcode
* @since 1.0.0
* @author Chris Clarke
* @link https://www.chrisclarkewebservices.co.uk
* @license GNU-2.0+
*/
namespace rushmark\module\faq\shortcode;

add_shortcode( 'faq', __NAMESPACE__ . '\process_the_shortcode' );
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
function process_the_shortcode( $user_defined_attributes, $content, $shortcode_name ) {
	$config = get_shortcode_configuration();
	
	
	$attributes = shortcode_atts(
		$config['defaults'],
		$user_defined_attributes,
		$shortcode_name
		);
		
		$attributes['post_id'] = (int) $attributes['post_id'];
		
		if ( $attributes['post_id'] < 1 && ! $attributes['topic']) {
			return '';
		}
		
		$attributes['show_icon'] = esc_attr($attributes['show_icon']);	
		
	// Call the view file, capture it into the output buffer, and then return it.
	ob_start();
	
	if ( $attributes['post_id'] > 0 ) {
		render_single_faq($attributes, $config);
	} else {
		render_topic_faqs($attributes, $config);
	}
	
	return ob_get_clean();
}

function render_single_faq( $attributes, $config ){
	$faq = get_post( $attributes['post_id']);
	if ( ! $faq ){
		echo '<p>Sorry, you need to select an FAQ for it to show here</p>';
		return;
	}
	 $post_title  = $faq->post_title;
	 $hidden_content = do_shortcode( $faq->post_content );
	 
	 include( $config['views']['container_single']);

}


function render_topic_faqs ( $attributes, $config) {
	$config_args = array(
		//number of records to grab
		'posts_per_page' => (int) $attributes['number_of_faqs'],
		'nopaging' => true,
		'post_type' => 'faq', 
		'tax_query' => array(
			array(
				'taxonomy' => 'topic',
				'field' => 'slug',
				'terms' => $attributes['topic'],
				
			)
		),
		'order' => 'ASC', 
		'orderby' => 'menu_order',
	);
	
	$query = new \WP_Query( $config_args );
	
	if ( ! $query->have_posts() ){
		echo '<p>I am not sorry because you are the one that should have put something here!</p>';
		return;
	}
	
	include( $config['views']['container_topic'] );

	wp_reset_postdata();

}
function loop_and_render_faqs_by_topic( $query, $attribues, $config){
	while( $query->have_posts() ){
		$query->the_post();
		
		$post_title = get_the_title();
		$hidden_content = do_shortcode( get_the_content() );
		
		include( $config['views']['faq']);
		
		
	}
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

function get_shortcode_configuration(){
	$config = array(
		'views' => array( 
			'container_single' => __DIR__ . '/views/container-single.php',
			'container_topic' => __DIR__ . '/views/container-topic.php',
			'faq' => __DIR__ . '/views/faq.php',
		
		),
		'defaults' => array(
			'show_icon' => 'dashicons dashicons-arrow-down-alt2',
			'hide_icon' => 'dashicons dashicons-arrow-up-alt2',
			'post_id' => 0,
			'topic'	   => '',
			'number_of_faqs' => -1,
		),
	);

	return $config;
}
