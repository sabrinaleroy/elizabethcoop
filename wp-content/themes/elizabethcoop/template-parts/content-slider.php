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
	<div class="entry-meta">
		<div class="thumbnail-container">
			<?php  elizabethcoop_post_thumbnail("slider");?>
		</div>
		<div class="meta-container">
		
			<?php the_title_max_charlength(44, '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
			<p><?php the_excerpt_max_charlength(170); ?></p>
			
		</div>
		
		<a href="<?php echo esc_url( get_permalink() ) ?>" class="read-more-wrapper">
			<span class='animated-arrow' >
		        <span class='the-arrow -left'>
					<span class='shaft'></span>
				</span>
				<span class='main'>
					<span class='text'>
						Read More
					</span>
					<span class='the-arrow -right'>
						<span class='shaft'></span>
					</span>
		        </span>
		    </span>
		</a>
			
		
	</div>

	
</div><!-- #post-<?php the_ID(); ?> -->
