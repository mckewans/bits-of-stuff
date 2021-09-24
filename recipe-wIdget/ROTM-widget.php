<?php
/**
 * Plugin Name: Recipe of the month Widget
 * Description: A widget that displays the latest recipe.
 * Version: 1.21
 * Author: Robert Gage-Smith
 * Author URI: http://www.robgs-online.com
 */


add_action( 'widgets_init', 'rotm_widget' );

function rotm_widget() {

	register_widget( 'recipe_Widget' );
}

class recipe_Widget extends WP_Widget {

	function recipe_Widget() {
		
		$widget_ops = array( 'classname' => 'example', 'description' => __('A widget to displays the recipe of the month post ', 'example') );
		
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'rotm-widget' );
		
		$this->WP_Widget( 'rotm-widget', __('ROTM Display Widget', 'example'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
	
		$ispage = trim($_SERVER['REQUEST_URI'],'/');
		$ispagearray = explode('/', $ispage);
		
		if(!in_array('properties', $ispagearray)) {
	
		if( get_post_type($post) != 'recipe-of-the-month') {
		
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$show_image = isset( $instance['show_image'] ) ? 1 : 0;

		echo $before_widget;

		// Display the widget title
		

		
		if ( $title )
		
		echo $before_title . $title . $after_title;

	  	query_posts(array('post_type' => 'recipe-of-the-month', 'posts_per_page' => 1));
	  		
	  		while ( have_posts() ) : the_post();
	  		
		  		if ( $show_image )
		  		
					if(has_post_thumbnail()) {
					
						echo "<div class='rotm_image_widget'><div class='img_wrapper'>";
							
							the_post_thumbnail();
							
						echo "</div></div>";
					}
	  		
	  			echo "<h3>"; the_title(); echo " - <span class='postdate'>"; the_date(); echo "</span></h3>";
	  			
	  			if(in_category('properties')) {
			echo "<p>arse</p>";
		}
	  			
        		echo '<div class="entry-content">';

	  			echo "<p class='widget_text'>";
	  			
	  			the_excerpt();
	  			
	  			echo "</p>";
	  
	  			echo '</div>';
	  			
	  			echo "<a class='make_space_below' href='"; the_permalink(); echo "'>Click here</a>";
	  			
	  		endwhile;
	  		
	  		wp_reset_query();
	  		
	  		
	  		
	  		
		
		echo $after_widget;
		
		}
		
	}	
		
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		//Strip tags from title to remove any HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_image'] = $new_instance['show_image'];

		return $instance;
	}

	
	function form( $instance ) {
		
		$defaults = array( 'title' => __('Recipe Title?', 'example'), 'show_image' => 1 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<input class="checkbox" 
				type="checkbox" <?php checked( (bool) $instance['show_image'], 1 ); ?> 
				id="<?php echo $this->get_field_id( 'show_image' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_image' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e('Show Image?', 'example'); ?></label>
		</p>

	<?php
	}
}

?>