<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Elizabeth_Coop
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function elizabethcoop_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'elizabethcoop_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function elizabethcoop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'elizabethcoop_pingback_header' );




function elizabethcoop_custom_setup() {
	
	/**** adding rectangle size for two columns display ****/
	add_image_size( 'rectangle', 570 , 450 , true );
	
}
add_action( 'after_setup_theme', 'elizabethcoop_custom_setup' );
