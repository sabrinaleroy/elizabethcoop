<?php
/**
 * Functions which enhance the theme by creating more widgets into WordPress
 The fields are added with advanced custom fields
 *
 * @package Elizabeth_Coop
 */


/**
 * Adds slickSlider widget.
 */
class slickSlider extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'aSlickSlider', // Base ID
			esc_html__( 'A Slick Slider', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A cool slider to insert anywhere', 'text_domain' ), ) // Args
		);
		
		add_action('wp_enqueue_scripts', array($this, 'scripts'));
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		if(get_field('title','widget_'.$args['widget_id'])){
			echo $args['before_title'].get_field('title','widget_'.$args['widget_id']).$args['after_title'];
		}
		
		$the_query = get_query_widget($args['widget_id']);
		
		
		
		if ( $the_query->have_posts() ) {
			echo '<div class="slider">';
			while ( $the_query->have_posts() ) {
				$the_query->the_post(); 
				get_template_part( 'template-parts/content', 'slider' );
			} 
			wp_reset_postdata();
			echo '</div>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
	}
	
	function scripts(){
	    if(is_active_widget(false, false, $this->id_base, true)){
	    	
	    	
			wp_enqueue_style( 'elizabethcoop-slick', get_template_directory_uri() . '/vendor/slick-v1.9.0/slick.css');
			wp_enqueue_style( 'elizabethcoop-slick', get_template_directory_uri() . '/vendor/slick-v1.9.0/slick-theme.css');
	    	wp_enqueue_script( 'elizabethcoop-slick', get_template_directory_uri() . '/vendor/slick-v1.9.0/slick.min.js', array('elizabethcoop-jquery'), '20151215', true );
	    	
	    	wp_enqueue_script( 'elizabethcoop-slider', get_template_directory_uri() . '/js/slider.js', array('elizabethcoop-jquery'), '20151224', true );
	
	    }           
  	}

} // class slickSlider


// register slickSlider widget
function register_slickSlider() {
    register_widget( 'slickSlider' );
}
add_action( 'widgets_init', 'register_slickSlider' );

/**
 * Adds PostsList widget.
 */
class aPostsList extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'aPostsList', // Base ID
			esc_html__( 'A Posts List', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A cool slider to insert anywhere', 'text_domain' ), ) // Args
		);
		
		add_action('wp_enqueue_scripts', array($this, 'scripts'));
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		
		if(get_field('title','widget_'.$args['widget_id'])||get_field('should_i_show_a_view_all_link','widget_'.$args['widget_id'])!=NUll){
			echo '<div class="widget_header">';
			
			if(get_field('title','widget_'.$args['widget_id'])){
				echo '<div class="widget_title_container">'.$args['before_title'].get_field('title','widget_'.$args['widget_id']).$args['after_title'].'</div>';
			}
			echo '<div class="black_line_container"><div class="black_line"></div></div>';
			
			if(get_field('should_i_show_a_view_all_link','widget_'.$args['widget_id'])&&get_field('should_i_show_a_view_all_link','widget_'.$args['widget_id'])=="yes"){
				echo '<div class="view_all"><a href="<?php echo esc_url( get_permalink() ) ?>" class="read-more-wrapper">
			<span class="animated-arrow" >
		        <span class="the-arrow -left">
					<span class="shaft"></span>
				</span>
				<span class="main">
					<span class="text">
						Read More
					</span>
					<span class="the-arrow -right">
						<span class="shaft"></span>
					</span>
		        </span>
		    </span>
		</a></div>';
			}
			
			echo '</div>';
		}
		
		$the_query = get_query_widget($args['widget_id']);
		
		if($the_query != false){
			if ( $the_query->have_posts() ) {
				global $grid ;
				$grid = 3;
				if($the_query->post_count < 3){
					$grid = 2;
				}
				
				echo '<div class="grid-list grid-'.$grid.'">';
				while ( $the_query->have_posts() ) {
					$the_query->the_post(); 
					
					get_template_part( 'template-parts/content', 'list' );
				} 
				wp_reset_postdata();
				echo '</div>';
			}
			else{
				echo "No post to show";
			}
		}else
		{
			echo "No post to show";
		}
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
	}
	
	function scripts(){
	    if(is_active_widget(false, false, $this->id_base, true)){
	    	
	    	
			wp_enqueue_style( 'elizabethcoop-slick', get_template_directory_uri() . '/vendor/slick-v1.9.0/slick.css');
			wp_enqueue_style( 'elizabethcoop-slick', get_template_directory_uri() . '/vendor/slick-v1.9.0/slick-theme.css');
	    	wp_enqueue_script( 'elizabethcoop-slick', get_template_directory_uri() . '/vendor/slick-v1.9.0/slick.min.js', array('elizabethcoop-jquery'), '20151215', true );
	    	
	    	wp_enqueue_script( 'elizabethcoop-slider', get_template_directory_uri() . '/js/slider.js', array('elizabethcoop-jquery'), '20151224', true );
	
	    }           
  	}

} // class aPostsList


// register aPostsList widget
function register_aPostsList() {
    register_widget( 'aPostsList' );
}
add_action( 'widgets_init', 'register_aPostsList' );

function get_query_widget($widget_id = false){
	$how_many_posts = 3;
	$posts = "";
	$the_query = false;
	if($widget_id !=false){
		if(get_field('how_do_i_fill_this_up','widget_'.$widget_id)){
			$method = get_field('how_do_i_fill_this_up','widget_'.$widget_id);
			
			
			if(get_field('how_many_posts','widget_'.$widget_id)){
				$how_many_posts = get_field('how_many_posts','widget_'.$widget_id);
			}
			
			switch($method){
				case 'manually':
				
					if(get_field('choose_the_posts_manually','widget_'.$widget_id)){
						$posts_id = get_field('choose_the_posts_manually','widget_'.$widget_id);
					}
			
					$the_query_args = array(
						'post_type' => 'post',
						'post__in' => $posts_id,
					);
			    	$the_query = new WP_Query( $the_query_args );
			    	
			    	$posts = $the_query->get_posts(); 
			    break;
			    case 'mostviewed':
			    
			    	$how_many_days = 'last30days';
			    	if(get_field('how_many_days','widget_'.$widget_id)){
						$how_many_days = get_field('how_many_posts','widget_'.$widget_id);
					}
					
			        $WPP_query_args = array(
					    'range' => $how_many_days,
					    'limit' => $how_many_posts,
					    'post_type' => 'post'
					);
					$WPP_query = new WPP_query( $WPP_query_args );
					$WPP_posts = $WPP_query->get_posts();
					$WPP_posts_id = array();
					
					foreach($WPP_posts as $WPP_post){
						$WPP_posts_id[] = $WPP_post->id;
					}
					
					
					$the_query_args = array(
						'post_type' => 'post',
						'post__in' => $WPP_posts_id,
					);
			    	$the_query = new WP_Query( $the_query_args );
			    	
			    	$posts = $the_query->get_posts(); 
			    break;
			    case 'category':
			    	$the_query_args = array(
						'post_type' => 'post',
						'orderby' => 'date',
						'order'   => 'DESC',
						'posts_per_page' => $how_many_posts,
					);
					
					if(get_field('which_category','widget_'.$widget_id)){
						$which_category = get_field('which_category','widget_'.$widget_id);
						
						if(get_category($which_category)){
							 $the_query_args['cat'] = $which_category;
						}
					}
			    	$the_query = new WP_Query( $the_query_args );
			    	
			    	$posts = $the_query->get_posts();
			    break;
			    case 'tag':
			    	
			        $the_query_args = array(
						'post_type' => 'post',
						'orderby' => 'date',
						'order'   => 'DESC',
						'posts_per_page' => $how_many_posts,
					);
					
					if(get_field('which_tag','widget_'.$widget_id)){
						$which_tag = get_field('which_tag','widget_'.$widget_id);
						
						if(get_tag($which_tag)){
							 $the_query_args['tag_id'] = $which_tag;
						}
					}
			    	$the_query = new WP_Query( $the_query_args );
			    	
			    	$posts = $the_query->get_posts();
			    break;
				case 'recent':
			    default:
					$the_query_args = array(
						'post_type' => 'post',
						'orderby' => 'date',
						'order'   => 'DESC',
						'posts_per_page' => $how_many_posts,
					);
			    	$the_query = new WP_Query( $the_query_args );
			    	
			    	$posts = $the_query->get_posts();
			    break;
			}
		}
	}
	if(count($posts)<1){
		return false;
	}else{
		return $the_query;
	}
}

function get_query_widget_taxo($taxo_id = false){
	
	
	$how_many_posts = 5;
	$posts = "";
	$the_query = false;
	$posts_id_return = array();
	if($taxo_id != false){
		
		if(get_field('how_do_i_fill_this_up','term_'.$taxo_id)){
			$method = get_field('how_do_i_fill_this_up','term_'.$taxo_id);
			
			switch($method){
				case 'manually':
					if(get_field('choose_the_posts_manually_taxo','term_'.$taxo_id)){
						$posts_id = get_field('choose_the_posts_manually_taxo','term_'.$taxo_id);
					}
			
					$the_query_args = array(
						'post_type' => 'post',
						'post__in' => $posts_id,
					);
			    	$the_query = new WP_Query( $the_query_args );
			    	
			    	$posts = $the_query->get_posts(); 
			    	
			    	foreach($posts as $post){
						if($post->ID){
					    	$posts_id_return[] = $post->ID;
				    	}
					}
					
			    break;
			    case 'mostviewed':
			    
			    	$how_many_days = 'last30days';
			    	if(get_field('how_many_days','term_'.$taxo_id)){
						$how_many_days = get_field('how_many_posts','term_'.$taxo_id);
					}
					
					
			        $WPP_query_args = array(
					    'range' => $how_many_days,
					    'limit' => $how_many_posts,
					    'post_type' => 'post'
					);
					
					if(is_tag($taxo_id)){
						$WPP_query_args['taxonomy'] = 'post_tag';
						$WPP_query_args['term_id'] =  $taxo_id;
					}else{
						$WPP_query_args['cat'] =  $taxo_id;
					}
					$WPP_query = new WPP_query( $WPP_query_args );
					$WPP_posts = $WPP_query->get_posts();
					
					
					foreach($WPP_posts as $WPP_post){
						if($WPP_post->id){
					    	$posts_id_return[] = $WPP_post->id;
				    	}
					}
					
					
					
			    break;
				case 'recent':
			    default:
					$the_query_args = array(
						'post_type' => 'post',
						'orderby' => 'date',
						'order'   => 'DESC',
						'posts_per_page' => $how_many_posts,
						
					);
					$the_query_args['tax_query'] = array(
					        'relation' => 'OR',
					        array(
					            'taxonomy' => 'post_tag',
					            'field' => 'term_id',
					            'terms' => array(str_replace("term_", "", $taxo_id))
					        ),
					        array(
					            'taxonomy' => 'category',
					            'field' => 'term_id',
					            'terms' => array(str_replace("term_", "", $taxo_id))
					        )
					    );
					$the_query = new WP_Query( $the_query_args );
			    	
			    	$posts = $the_query->get_posts(); 
			    	

			    	foreach($posts as $post){
				    	if($post->ID){
					    	$posts_id_return[] = $post->ID;
				    	}
						
					}
			    break;
			}
		}
	}
	if(count($posts_id_return)<1){
		return false;
	}else{
		if(count($posts_id)<$how_many_posts){
			$how_many_posts_now = $how_many_posts-count($posts_id);
			$the_query_args = array(
				'post_type' => 'post',
				'orderby' => 'date',
				'order'   => 'DESC',
				'post__not_in' => $posts_id_return,
				'posts_per_page' => $how_many_posts_now,
			);
			
			$the_query_args['tax_query'] = array(
			        'relation' => 'OR',
			        array(
			            'taxonomy' => 'post_tag',
			            'field' => 'term_id',
			            'terms' => array(str_replace("term_", "", $taxo_id))
			        ),
			        array(
			            'taxonomy' => 'category',
			            'field' => 'term_id',
			            'terms' => array(str_replace("term_", "", $taxo_id))
			        )
			    );
			$the_query = new WP_Query( $the_query_args );
	    	
	    	$posts = $the_query->get_posts(); 
	    	
			
	    	foreach($posts as $post){
				$posts_id_return[] = $post->ID;
			}
		}
		return $posts_id_return;
	}
}