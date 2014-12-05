<?php
// =============================== My Post Cycle widget ======================================
class MY_CustomSocials extends WP_Widget {
    /** constructor */
    function MY_CustomSocials() {
        parent::WP_Widget(false, $name = 'My - Custom Socials');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $qlink = apply_filters('widget_qlink', $instance['qlink']);
       

        ?>
              <?php echo $before_widget; ?>
                <div class="footer-contener">
                   <ul class="social">
                        <li><a href="<?php echo get_option('wild_fb') ?>"><img src="<?php echo get_bloginfo("template_url"); ?>/img/fb-icon.png" width="34" height="34" alt="fb"></a></li>
                        <li><a href="<?php echo get_option('wild_gg') ?>"><img src="<?php echo get_bloginfo("template_url"); ?>/img/google+-icon.png" width="34" height="34" alt="google+"></a></li>
                        <li><a href="<?php echo get_option('wild_tw') ?>"><img src="<?php echo get_bloginfo("template_url"); ?>/img/twiter-icon.png" width="34" height="34" alt="tw"></a></li>  
                    </ul>
                     <div class="qbercode"><img src="<?php echo $qlink; ?>"  alt="qbercode"></div>
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
            
            
    ?>
    
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wild'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('qlink'); ?>"><?php _e('Qubercode Link:', 'wild'); ?>
      </label></p>
      
      <?php
       wp_add_media_custom(true,$qlink,".",$this->get_field_name('qlink'));
   ?>
      
      <?php 
    }

} // class Cycle Widget


?>