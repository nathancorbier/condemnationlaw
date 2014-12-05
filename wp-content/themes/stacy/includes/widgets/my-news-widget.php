<?php
// =============================== My Post Cycle widget ======================================
class MY_News extends WP_Widget {
    /** constructor */
    function MY_News() {
        parent::WP_Widget(false, $name = 'My - News');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $no =  $instance['no'];
        $link =  $instance['link'];
        ?>
              <?php echo $before_widget; ?>
                  <?php query_posts("post_type=news&showposts=".$no."post_status=publish"); ?>
                  
                                    <div class="eminent">
                                        <p><?php echo $title; ?></p>
                                    </div>
                                    <div class="eminent-con">
                                        <ul><?php while(have_posts()):the_post(); ?>
                                        <?php $name=get_post_meta($post->ID,'_stacy_name',true);
                                              $alink=get_post_meta($post->ID,'_stacy_link',true);
                                         ?>
                                           <li>  
                                                <p><?php the_content(); ?> <a href="<?php echo $alink; ?>">- <?php echo $name;?></a></p>
                                                <a href="<?php echo $link; ?>" class="small-info"><?php _e("+info","stacy") ?></a>
                                                <div class="clearfix"></div>
                                            </li>
                                              <?php endwhile; ?>
                                        </ul>
                                    </div>
                                    <div class="drop-shadow"></div>
                               
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
