<?php
// =============================== My Post Cycle widget ======================================
class MY_Testimonial extends WP_Widget {
    /** constructor */
    function MY_Testimonial() {
        parent::WP_Widget(false, $name = 'My - Testimonial');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $no =  $instance['no'];
        $link =  $instance['link'];
        ?>
              <?php echo $before_widget; ?> 
                             <?php query_posts("post_type=testimonial&showposts=".$no."post_status=publish"); ?>      

                                <div class="testimonials-in">
                                    <h3><?php echo $title; ?></h3>
                                   <?php while(have_posts()):the_post();
                                   global $post;
                                    ?> 
                                   
                                     <?php $author=get_post_meta($post->ID,'_stacy_author',true); ?>
                                     <?php $city=get_post_meta($post->ID,'_stacy_city',true); ?>
                                    <div class="testimonials-con">
                                        <?php
                                            the_content();
                                        ?>
                                    </div>
                                    <p class="pull-right"><?php echo $author; ?>,<?php echo $city; ?></p>
                                    <div class="clearfix"></div>
                                    <div class="divider"></div>
                                      <?php endwhile; ?>
                                    <a href="<?php echo $link; ?>" class="read pull-right"><?php _e("Read More","stacy");?></a>
                                    <div class="clearfix"></div>
                                </div>
                             <?php wp_reset_query(); ?>
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
            $no = esc_attr($instance['no']);
            $link = esc_attr($instance['link']);
            
    ?>
    
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('no'); ?>"><?php _e('No of Post:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('no'); ?>" name="<?php echo $this->get_field_name('no'); ?>" type="text" value="<?php echo $no; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Details Page Link', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p>
     
      
      <?php 
    }

} // class Cycle Widget
 ?>