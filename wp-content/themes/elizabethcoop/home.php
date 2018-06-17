<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elizabeth_Coop
 */

get_header();
if(is_active_sidebar("coloured-homepage-section")){?>
	<div class="coloured-homepage-section">
		<?php dynamic_sidebar("coloured-homepage-section");?>
	</div>
<?php }


?>
	<div id="primary" class="content-area site-container">
		<main id="main" class="site-main">
		<?php
		if(is_active_sidebar("white-homepage-section")){?>
			<div class="white-homepage-section">
				<?php dynamic_sidebar("white-homepage-section");?>
			</div>
		<?php }
			
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
