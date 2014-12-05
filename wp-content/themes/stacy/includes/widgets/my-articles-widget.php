<?php
// =============================== My Post Cycle widget ======================================
class MY_Articles extends WP_Widget {
    /** constructor */
    function MY_Articles() {
        parent::WP_Widget(false, $name = 'My Articles');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
    extract( $args );
    
    $title = apply_filters('widget_title', $instance['title']);
    $article = apply_filters('widget_title', $instance['article']);
    $categoryids =implode(",",$instance['article']) ;
     print_r(array($categoryids));
   // print_r($categoryids);
    $args = array(
    'numberposts'     => 20,
    'category__in'    =>array($categoryids),
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_type'       => 'post',
    'post_status'     => 'publish' );
    query_posts($args); 
   
     ?>
              <?php echo $before_widget; ?>  
                  <div class="recent-articles">
                                 <div class="articles">
                                     <h3><?php echo $title;?></h3>
                                     <ul>
                                 <?php           
              
              while(have_posts()):the_post();
              ?>
                 <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                       
                                 
                    <?php endwhile; wp_reset_query();?>         
                     </div>
                    </div> 
              </ul>              
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
    $article = $instance['article'];
    $categories =  get_categories(); 
    //print_r($article);
 ?>  
                                                                                                                                                               
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('article'); ?>"><?php _e('Category:', 'stacy'); ?>
      <select class="widefat" id="<?php echo $this->get_field_id('article'); ?>" name="<?php echo $this->get_field_name('article'); ?>[]" multiple="multiple" >
            <option value=""><?php echo esc_attr(__('Please Select Your Choice')); ?></option> 
            <?php
            foreach ($categories as $category) {?>              
             
                <option value="<?php echo $category->term_id; ?>" <?php if(!empty($article)){if(@in_array($category->term_id,$article)){?> selected="selected" <?php }} ?> ><?php echo ucfirst($category->cat_name) ?></option>
            <?php } ?>
          </select>
      </label></p>
       <?php 
    }

} // class Cycle Widget

?>