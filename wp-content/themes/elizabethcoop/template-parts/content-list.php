<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elizabeth_Coop
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class("title_hover"); ?>>
	<div class="entry-meta">
		<div class="thumbnail-container">
			<?php  
				global $grid;
				if($grid==2){
					elizabethcoop_post_thumbnail("rectangle");
				}else{
					elizabethcoop_post_thumbnail("thumbnail");
				}
			?>
		</div>
		<div class="meta-container">
		<?php  
		?>
			<?php the_title_max_charlength(44, '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
			<p><?php the_excerpt_max_charlength(170); ?></p>
			<a href="<?php echo esc_url( get_permalink() ) ?>" class="read-more">Read more</a>
		</div>
		
	</div>
</div><!-- #post-<?php the_ID(); ?> -->
