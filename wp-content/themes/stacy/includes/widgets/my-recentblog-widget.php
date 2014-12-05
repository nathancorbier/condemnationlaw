<?php
// =============================== My Post Cycle widget ======================================
class MY_RecentBlog extends WP_Widget {
    /** constructor */
    function MY_RecentBlog() {
        parent::WP_Widget(false, $name = 'My - Recent Blog');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $no =  $instance['no'];
        $link =  $instance['link'];
        $wlimit =  $instance['wlimit'];
                ?>
              <?php echo $before_widget; ?>
                  <?php query_posts("post_type=post&showposts=".$no."post_status=publish"); ?>
                        <div class="blog">  
                            <h3><?php echo $title; ?></h3>
                            <?php while(have_posts()):the_post(); ?>
                            <p><a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail("blog-thumbnail",array("class"=>"alignleft")); ?>
                            <?php the_title(); ?></a></p>
                            
                            <?php endwhile; ?> </div>                                
                                    <div class="clearfix"></div> 
                                      
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
            $wlimit = esc_attr($instance['wlimit']);
            
    ?>
    
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('no'); ?>"><?php _e('No of Post:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('no'); ?>" name="<?php echo $this->get_field_name('no'); ?>" type="text" value="<?php echo $no; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('wlimit'); ?>"><?php _e('Word Limit:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('wlimit'); ?>" name="<?php echo $this->get_field_name('wlimit'); ?>" type="text" value="<?php echo $wlimit; ?>" /></label></p>
     
      
      <?php 
    }

} // class Cycle Widget
 ?>
