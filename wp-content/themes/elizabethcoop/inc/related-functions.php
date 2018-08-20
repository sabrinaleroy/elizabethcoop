<?php 
	
	
function elizabethcoop_related_articles($orig_post){
	global $post;
	$categories = get_the_category($post->ID);
	if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

		$args=array(
		'category__in' => $category_ids,
		'post__not_in' => array($post->ID),
		'posts_per_page'=> 3, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1
		);

		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {?>
			<section id="related-posts" class="widget related-posts">
				<div class="widget_header">
					<div class="widget_title_container">
						<h2 class="widget-title">
							Related Stories
						</h2>
					</div>
					<div class="black_line_container">
						<div class="black_line"></div>
					</div>
				</div>
				<div class="grid-list grid-3">


			
			
			<?php
			
			while( $my_query->have_posts() ) {
				$my_query->the_post();
				get_template_part( 'template-parts/content', 'list' );
			}?>
				</div>
			</section><?php
		}
	}
	$post = $orig_post;
	wp_reset_query(); 
}