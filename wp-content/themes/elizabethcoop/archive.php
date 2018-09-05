<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elizabeth_Coop
 */

get_header();
?>
<div class="site-container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<div class="page_title_container">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					?>
					<div class="black_line_container">
						<div class="black_line"></div>
					</div>
				</div>
				<?php
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
			
			$posts_id = array();
			if(get_field('what_format_for_this_page','term_'.get_queried_object_id()) == 'hightlight'){
				
				
				$posts_id = get_query_widget_taxo( get_queried_object_id());
				
			
				$the_query_args = array(
					'post_type' => 'post',
					'post__in' => $posts_id,
					'orderby' => 'post__in'
				);
		    	$the_query = new WP_Query( $the_query_args );
				    	
				    	
			
			
				if ( $the_query->have_posts() ) {
					$first = true;
					echo '<div class="higlights"> <div class="one">';
					while ( $the_query->have_posts() ) {
						$the_query->the_post(); 
						
						
						
						
						if($first){
							get_template_part( 'template-parts/content', 'first' );
							echo '</div><div class="four">';
							$first = false;
						}else{
							get_template_part( 'template-parts/content', 'four' );
						}
						
					} 
					wp_reset_postdata();
					echo '</div><div class="clear"></div></div>';
				}
			
			}
				
			// build the query for the post
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; // get the page number
				
			$the_query_args = array(
				'post_type' => 'post',
				'orderby' => 'date',
				'order'   => 'DESC',
				'post__not_in' => $posts_id,
				'posts_per_page' => 9,
				'paged' => $paged,
			);
			
			$the_query_args['tax_query'] = array(
			        'relation' => 'OR',
			        array(
			            'taxonomy' => 'post_tag',
			            'field' => 'term_id',
			            'terms' => array(str_replace("term_", "", get_queried_object_id()))
			        ),
			        array(
			            'taxonomy' => 'category',
			            'field' => 'term_id',
			            'terms' => array(str_replace("term_", "", get_queried_object_id()))
			        )
			    );
			$the_query = new WP_Query( $the_query_args );
			if( $the_query->have_posts() ) :
			
			?>
				<div class="grid-list grid-3 page">
			<?php
			
			/* Start the Loop */
			while ( $the_query->have_posts() ) :
			
			
			
				$the_query->the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'list' );
				
			
			endwhile;
			?>
				</div>
			<?php
				elizabethcoop_pagination($the_query->post_count,$the_query->found_posts);
			endif;
			

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_sidebar();
get_footer();
