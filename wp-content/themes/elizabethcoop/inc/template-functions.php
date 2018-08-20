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
	/**** adding size for Slider ****/
	add_image_size( 'slider', 670 , 900 , true );
	
}
add_action( 'after_setup_theme', 'elizabethcoop_custom_setup' );


function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}
function the_title_max_charlength($charlength, $before = "<h3>", $after = "</h3>") {
	
	
	$title = get_the_title();
	$charlength++;
	
	echo $before;
	if ( mb_strlen( $title ) > $charlength ) {
		$subex = mb_substr( $title, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $title;
	}
	echo $after;
}