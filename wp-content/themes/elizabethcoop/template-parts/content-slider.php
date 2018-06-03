<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elizabeth_Coop
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
 elizabethcoop_post_thumbnail();

?>
<a href="<?php esc_url( get_permalink() ) ?>">Read more</a>
	
</div><!-- #post-<?php the_ID(); ?> -->
