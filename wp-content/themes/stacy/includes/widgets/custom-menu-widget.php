<?php
// =============================== My Post Cycle widget ======================================
class MY_CustomMenu extends WP_Widget {
    /** constructor */
    function MY_CustomMenu() {
        parent::WP_Widget(false, $name = 'Resource Center');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $menu = apply_filters('widget_menu', $instance['menu']);
        $qlink = apply_filters('widget_qlink', $instance['qlink']);
        $image = apply_filters('widget_qlink', $instance['image']);
       
        ?>
              <?php echo $before_widget; ?>
              
              <div class="resource-center">
                    <div class="resource">
                        <p><?php echo $title; ?></p>
                    </div>
                    <img src="<?php echo $image;?>" class="img-responsive" alt="sale">
                    <div class="resource-con">
                         <?php 
                            wp_nav_menu( array(
                                      'container'       => 'ul',
                                      'menu'            => $menu
                                  )); 
                            ?>
                    </div>
                    <div class="drop-shadow">
                        <a href="<?php echo $qlink; ?>"><?php _e("+info","stacy")?></a>
                    </div>
                </div>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {                
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {                
            $title = esc_attr($instance['title']);
            $qlink = esc_attr($instance['qlink']);
            $image = esc_attr($instance['image']);
            $value_of_dropdown = esc_attr($instance['menu']);
            $menus = get_terms('nav_menu');
    ?>
    
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('qlink'); ?>"><?php _e('Link:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('qlink'); ?>" name="<?php echo $this->get_field_name('qlink'); ?>" type="text" value="<?php echo $qlink; ?>" /></label></p>
      
      <p>
        <label for="<?php echo $this->get_field_id('menu'); ?>"><?php _e( "Select Menu", 'stacy' ); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id('menu'); ?>" name="<?php echo $this->get_field_name('menu'); ?>">
        <option value="">Select</option>
        <?php foreach($menus as $menu){ ?>
        <option value="<?php   echo $menu->term_id; ?>" <?php if($value_of_dropdown == $menu->term_id){ ?>selected="selected"<?php }?> > <?php echo $menu->name; ?></option>
        <?php }?>
        </select>
        </p>
        <p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image:', 'stacy'); ?></label></p>
      <?php
       $defaults = array(

        'parent_div_class'=> 'custom-image-upload',  
        'field_name' => $this->get_field_name('image'),
        'field_id' =>  $this->get_field_id('image'),
                    );
      wp_add_media_custom($defaults,false,$image);  
   ?>
      <?php 
    }

} // class Cycle Widget


?>