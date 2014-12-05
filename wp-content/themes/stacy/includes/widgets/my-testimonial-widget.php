<?php
// =============================== My Post Cycle widget ======================================
class MY_MiddleBox extends WP_Widget {
    /** constructor */
    function MY_MiddleBox() {
        parent::WP_Widget(false, $name = 'Middle Box');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $cimage = esc_attr($instance['cimage']);
    $link =  $instance['link'];
    $type = apply_filters('widget_type', $instance['type']);
      ?>
              <?php echo $before_widget; ?>          
              <?php
              $meta_query =  array(
                        'key' => '_stacy_featured',
                        'value' => "on",
                        'compare' => '=',
                        'type' => 'CHAR'
                        );
              $arg = array(
                "post_type" => $type,
                "showposts" => 1,
                "post_status" => "publish",
                "meta_query" =>array($meta_query),
                "order" => "rand"
              );
              
              query_posts($arg); 
              while(have_posts()):the_post();
              ?>
              <div class="resource-center">
                    <div class="resource">
                        <p><?php echo $title;  ?></p>
                    </div>
                    <img src="<?php echo $cimage; ?> " alt="" class="img-responsive">
                    <div class="resource-con">
                        <?php the_content(); ?>
                    </div>
                    <div class="drop-shadow">
                        <a href="<?php echo $link; ?>">+<?php _e("info","stacy"); ?></a>
                    </div>
                     </div>
               <?php endwhile; wp_reset_query();?>               
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
    $cimage = esc_attr($instance['cimage']);
    $link = esc_attr($instance['link']);
    $type = esc_attr($instance['type']);  
    $args = array(
          'public'   => true,
         '_builtin' => false
           );
           $output = 'names'; // names or objects, note names is the default
           $operator = 'and'; // 'and' or 'or'
    $post_types = get_post_types($args, $output, $operator);
   // print_r($post_types);
 ?>  
                                                                                                                                                               
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
          <?php
   $arg = array(
   
        'parent_div_class'=> 'custom-cimage-upload',
                
        'field_name' => $this->get_field_name('cimage'),
        'field_id' => 'upload_logo',
        'field_class' => 'upload_cimage_field',
        
        'upload_button_id' => 'upload_logo_button',
        'upload_button_class' => 'upload_logo_button',
        'upload_button_text' => 'Upload',
        
        'remove_button_id' => 'remove_logo',
        'remove_button_class' => 'remove_logo_button',
        'remove_button_text' => 'Remove'
        
        );
       wp_add_media_custom($arg,false,$cimage);
   ?>
      <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Details Page Link', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Post Type:', 'stacy'); ?>
      <select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
        <option >Select</option>
         <?php foreach($post_types as $k => $v){ ?>
         <option value="<?php echo $k;  ?>" <?php if($type == $k) {?>selected="selected"<?php } ?> ><?php echo $v; ?></option>
         <?php } ?>
       </select> 
       </label></p>
 <?php 
    }

} // class Cycle Widget

?>