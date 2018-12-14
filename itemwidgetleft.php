<?php
/*
Plugin name: Items Left
Plugin URI: https://github.com/underwoodno5/itemsplugin
Description: Add a featured item, with image and description
Version: 1.0
Author: ianmac
Author URI: http://ianmacs.site
License: none
Text Domain: items_left

*/

class jdl_widget extends WP_Widget
{
	
	public function __construct(){
		//Widget details are here
		$widget_details = array(
            'classname' => 'jdl_widget',
            'description' => 'Creates a right-oriented item box.'
        );

		parent::__construct( 'jdl_widget', 'Items Left', $widget_details );


		add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );


		function load_wp_media_files() {
    		wp_enqueue_media();
		}



	}

	public function jd_assets(){

		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jd-media-upload', plugin_dir_url(__FILE__) . 'jd-media-upload.js', array( 'jquery' ));
		wp_enqueue_style('thickbox');
	}


	public function widget($args, $instance){
		//Widget output front end. Displaaaay

		//this is boilerplate stuff to make sure it works with other widgets
		echo $args['before_widget'];

		?>

		<div class="jdavis-wrapper">
			<div class='jd-description'>
					<?php

		if ( ! empty( $instance['title']) ){
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		?>
		<?php echo wpautop(esc_html($instance['description']) ) ?>
		</div>



		<div class="jd-image-container">
		<div class='jd-link'>
			<a href='<?php echo esc_url( $instance['link_url'] ) ?>' class="header-button widget-button">
			<?php echo esc_html( $instance['link_title'] ) ?>
			</a>
		</div>
		<div class="jd-image">
		<img src='<?php echo $instance['image'] ?>' class='widget-image'>
		</div>
		</div>



		</div>



		<?php
		echo $args['after_widget'];
	

	}

	public function update($new_instance, $old_instance){
		//Does stuff to the form before saved
		return $new_instance;


	}


	public function form($instance){
		//Backend entry forms on admin widget page

		$title = '';
	    if( !empty( $instance['title'] ) ) {
	        $title = $instance['title'];
	    }

	    $description = '';
	    if( !empty( $instance['description'] ) ) {
	        $description = $instance['description'];
	    }

	    $link_url = '';
	    if( !empty( $instance['link_url'] ) ) {
	        $link_url = $instance['link_url'];
	    }

	    $link_title = '';
	    if( !empty( $instance['link_title'] ) ) {
	        $link_title = $instance['link_title'];
	    }

		$image = '';
		if(isset($instance['image']))
		{
		    $image = $instance['image'];
		}
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'description' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" ><?php echo esc_attr( $description ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'link_url' ); ?>"><?php _e( 'Link URL:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'link_title' ); ?>"><?php _e( 'Link Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_title' ); ?>" name="<?php echo $this->get_field_name( 'link_title' ); ?>" type="text" value="<?php echo esc_attr( $link_title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>
    <?php
    }



}

add_action('widgets_init', function(){
	register_widget('jdl_widget');
})
	
?>