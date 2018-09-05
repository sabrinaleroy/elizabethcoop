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
				elizabethcoop_post_thumbnail("first");
			?>
		</div>
		<div class="meta-container">
		<?php  
		?>
			<?php the_title_max_charlength(74, '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<p><?php the_excerpt_max_charlength(140); ?></p>
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
		
	</div>
	<div class="clear"></div>
</div>