<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Elizabeth_Coop
 */

if ( ! function_exists( 'elizabethcoop_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function elizabethcoop_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);


		echo '<span class="posted-on">'. __( 'Published', 'elizabethcoop' ).' '. $time_string . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'elizabethcoop_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function elizabethcoop_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'elizabethcoop' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'elizabethcoop_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function elizabethcoop_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', 'elizabethcoop' ) );
			$category_list = get_the_category_list( '', esc_html_x( '', 'list item separator', 'elizabethcoop' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				echo '<span class="tags-links">' .$category_list.$tags_list. '</span>';
			}
		}
	}
endif;

if ( ! function_exists( 'elizabethcoop_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function elizabethcoop_post_thumbnail($size = 'thumbnail') {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( is_singular() ) :
			$background = "";
			if(has_post_thumbnail()){
				$background = 'style="background-image:url('.get_the_post_thumbnail_url(get_the_ID(),$size).');"';
			}
			
			?>

			<div class="post-thumbnail-singular"  <?php echo $background; ?>>
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				</a>
			</div><!-- .post-thumbnail -->

		<?php elseif($size=="first") : 
			$background = "";
			if(has_post_thumbnail()){
				$background = 'style="background-image:url('.get_the_post_thumbnail_url(get_the_ID(),"large").');"';
			}
			
			?>

			<div class="post-thumbnail-first"  <?php echo $background; ?>>
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				</a>
			</div><!-- .post-thumbnail -->
		<?php elseif($size=="four") : 
			$background = "";
			if(has_post_thumbnail()){
				$background = 'style="background-image:url('.get_the_post_thumbnail_url(get_the_ID(),"medium").');"';
			}
			
			?>

			<div class="post-thumbnail-four"  <?php echo $background; ?>>
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				</a>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				if(has_post_thumbnail()){
					the_post_thumbnail($size, array(
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );
				}else{
					echo '<img src="'.get_stylesheet_directory_uri().'/images/placeholder-'.$size.'.jpg" alt="'.get_the_title().'"/>';
				}
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


/**
 * Add a span around the title prefix so that the prefix can be hidden with CSS
 * if desired.
 * Note that this will only work with LTR languages.
 *
 * @param string $title Archive title.
 * @return string Archive title with inserted span around prefix.
 */
 
if ( ! function_exists( 'elizabethcoop_hide_the_archive_title' ) ) :
function elizabethcoop_hide_the_archive_title( $title ) {
	// Skip if the site isn't LTR, this is visual, not functional.
	// Should try to work out an elegant solution that works for both directions.
	if ( is_rtl() ) {
		return $title;
	}
	// Split the title into parts so we can wrap them with spans.
	$title_parts = explode( ': ', $title, 2 );
	// Glue it back together again.
	if ( ! empty( $title_parts[1] ) ) {
		$title = wp_kses(
			$title_parts[1],
			array(
				'span' => array(
					'class' => array(),
				),
			)
		);
		$title = '<span class="screen-reader-text">' . esc_html( $title_parts[0] ) . ': </span>' . $title;
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'elizabethcoop_hide_the_archive_title' );

endif;




if ( ! function_exists( 'elizabethcoop_pagination' ) ) :
/**
 * load more pagination
 */
function elizabethcoop_pagination($initial_number_posts = 0,$total_number_posts = 0){
	
	if($total_number_posts > 9){
	?>
		<div class="loadmore-container">
			
			<div class="number_posts">
				<span class="post_showing"><?php echo $initial_number_posts; ?></span> 
				<?php echo _x( 'of', 'mlife-theme' ); ?>
				<span class="total_post"><?php echo $total_number_posts; ?></span>
				
			</div>
			<a class="load-more-button"> 
				<?php echo _x( 'Load More', 'elizabethcoop' ); ?>
				<span class="arrow_down">
						<div class="chevron"></div>
					
				</span>
			</a>
			<div class="no-more">
				<?php echo _x( 'No more to load', 'elizabethcoop' ); ?>
			</div>
			<?php 
				the_posts_navigation();	// keep the pagination for google and for the loadmore.js to find the next page.
			?>
		</div>
	<?php
	}
}
endif;


