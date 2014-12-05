<?php
// =============================== My Editor Widget ======================================
class MY_EditorWidget extends WP_Widget {
      function MY_EditorWidget() {
        parent::WP_Widget(false, $name = 'My - Editor Widget');    
    }
    function update($new_instance, $old_instance) {                
        return $new_instance;
    }
    function form($instance) {                
        $title = esc_attr($instance['title']);
                $txt1 = esc_attr($instance['txt1']);
                $txt2 = esc_attr($instance['txt2']);
                $txt3 = esc_attr($instance['txt3']);
                $txt4 = esc_attr($instance['txt4']);
        ?>
       <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'quality'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
       <p>
       <?php wp_editor('','editor_widget') ?>
       </p>
        <?php 
    }
    function widget($args, $instance) {        
        
    }
}
?>