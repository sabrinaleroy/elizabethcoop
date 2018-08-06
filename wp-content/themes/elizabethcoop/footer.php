<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elizabeth_Coop
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-container">
			<div class="site-info">
				
				
				<div class="site-branding">
					<?php
					$title_tag = "p";
						
					if(get_custom_logo()){
						?>
						<<?php echo $title_tag ?> class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php the_custom_logo(); ?>
							</a>
						</<?php echo $title_tag ?>>
						<?php
					}else{
						
						$elizabethcoop_title = get_bloginfo( 'name', 'display' );
						$elizabethcoop_title_tab = explode(" ", $elizabethcoop_title);
						?>
						<<?php echo $title_tag ?> class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $elizabethcoop_title_tab[0]; ?>
								<span><?php echo $elizabethcoop_title_tab[1]; ?></span>
							</a>
						</<?php echo $title_tag ?>>
						<?php
					}
					
					?>
				</div><!-- .site-branding -->
				<?php
				if(is_active_sidebar("footer-section")){?>
					<div class="footer-section">
						<?php dynamic_sidebar("footer-section");?>
					</div>
				<?php }
					
				?>
			</div><!-- .site-info -->
		</div>
		<div class="clear"></div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
