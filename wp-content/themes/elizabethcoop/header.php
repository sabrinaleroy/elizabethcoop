<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elizabeth_Coop
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'elizabethcoop' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-container">
			<div class="site-branding">
				<?php
				$title_tag = "p";
				if ( is_front_page() && is_home() ){
					$title_tag = "h1";	
				}
					
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
	
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'elizabethcoop' ); ?></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
