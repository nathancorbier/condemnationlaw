<?php
/*
  Plugin Name: Simple Zoomer
  Plugin URI: http://www.spicyclassified.com
  Description: This plugin will enable increase the font size of the page for better reading experience.
  Version: 1.0
  Author: Chandra sekhar Gudavalli
  License: GPLv2
 */

class simple_zoomer extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function simple_zoomer() {
        parent::WP_Widget(false, $name = 'Font Zoomer');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
       
        ?>
              <?php // echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
						<script language="javascript">
						var fontSize = 1;
						function zoomIn() {
						fontSize += 0.1;
						document.body.style.fontSize = fontSize + "em";
						}
						function zoomOut() {
						fontSize -= 0.1;
						document.body.style.fontSize = fontSize + "em";
						}
						</script>
						<input type="button" value="+" onClick="zoomIn()"/>
						<input type="button" value="-" onClick="zoomOut()"/>

              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
       return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
        $title 		= esc_attr($instance['title']);
       
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		 
        <?php 
    }
 
 
} // end class simple_zoomer
add_action('widgets_init', create_function('', 'return register_widget("simple_zoomer");'));
?>
