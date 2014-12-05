<?php
// =============================== My Post Cycle widget ======================================
class MY_Resource extends WP_Widget {
    /** constructor */
    function MY_Resource() {
        parent::WP_Widget(false, $name = 'My - Resource');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $content = apply_filters('widget_content', $instance['content']);
        $qlink = apply_filters('widget_qlink', $instance['qlink']);
       

        ?>
              <?php echo $before_widget; ?>
                      <div class="resource-center">
                    <div class="resource">
                        <p><?php echo $title;?></p>
                    </div>
                    <div class="resource-con">
                        <ul> 
                            <li><a href="<?php echo the_permalink(); ?>"><?php _e("What is Eminent domain","stacy"); ?></a></li>
                            <li><a href="<?php echo the_permalink(); ?>"><?php _e("Faq","stacy")?></a></li>
                            <li><a href="<?php echo the_permalink(); ?>"><?php _e("Blog/informational articles","stacy")?></a></li>
                            <li><a href="<?php echo the_permalink(); ?>"><?php _e("Inverse Condemnation","stacy")?></a></li>
                        </ul> 
                    </div>
                    <div class="drop-shadow">
                        <a href="<?php echo the_permalink(); ?>">+<?php _e("info","stacy"); ?></a>
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
            $content = esc_attr($instance['content']);
            
    ?>
    
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('content:', 'stacy'); ?> <textarea cols="7" rows="6" class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" value="<?php echo $content; ?>"></textarea></label></p>
       <p><label for="<?php echo $this->get_field_id('qlink'); ?>"><?php _e('Qbarcode Image:', 'stacy'); ?></label></p>
      <?php
       $defaults = array(

        'parent_div_class'=> 'custom-image-upload',
               
        'field_name' => $this->get_field_name('qlink'),
        'field_id' =>  $this->get_field_id('qlink'),

                    );
      wp_add_media_custom($defaults,false,$qlink);  
   ?>
      
      <?php 
    }

} // class Cycle Widget
 ?>