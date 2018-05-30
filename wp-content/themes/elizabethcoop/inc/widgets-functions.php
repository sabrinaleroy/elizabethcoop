<?php
/**
 * Functions which enhance the theme by creating more widgets into WordPress
 The fields are added with advanced custom fields
 *
 * @package Elizabeth_Coop
 */


/**
 * Adds slickSlider widget.
 */
class slickSlider extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'aSlickSlider', // Base ID
			esc_html__( 'A Slick Slider', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A cool slider to insert anywhere', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		
		
		
		
		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
	}

} // class slickSlider


// register slickSlider widget
function register_slickSlider() {
    register_widget( 'slickSlider' );
}
add_action( 'widgets_init', 'register_slickSlider' );
