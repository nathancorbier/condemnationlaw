<?php
// =============================== My Post Cycle widget ======================================
class MY_Projects extends WP_Widget {
    /** constructor */
    function MY_Projects() {
        parent::WP_Widget(false, $name = 'My - Projects');    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {        
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $no =  $instance['no'];
        $catid=$instance['catid'];
        
        $args = array(
    'cat' => $catid,
    'orderby'=> 'ID',
    'order'=> 'DESC',
    'order'=> 'DESC',
    'posts_per_page'=> $no 

); 
   $query = new WP_Query( $args );
  // print_r($query);
        ?>
              <?php echo $before_widget; ?>
                  <div class="project">
                                  <p><?php echo $title; ?></p>      
                                    </div>
                  
                  <div class="mn-projects"> 
                                        <?php if ( $query->have_posts() ) {  ?>
                                        <ul>
                                             
                                            <?php  while($query->have_posts()):$query->the_post(); ?>
                                            <li>
                                                 <p><?php the_post_thumbnail("project-thumbnail",array("class"=>"alignleft")); ?><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></p>
                                                
                                                <div class="clearfix"></div>
                                            </li> 
                                             <?php endwhile; ?>
                                        </ul>    <?php } ?>
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
            $catid= esc_attr($instance['catid']);
            
    ?>
    
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
      <p><label for="">Category</label>
      <?php $args = array(
    'type'                     => 'post',
    'child_of'                 => 0,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'category',
    'pad_counts'               => false 

); $categories = get_categories( $args );?>
<select id="<?php echo $this->get_field_id('catid'); ?>" name="<?php echo $this->get_field_name('catid'); ?>">
<?php foreach($categories as $cat){?>
<option value="<?php echo $cat->cat_ID; ?>" <?php if($catid==$cat->cat_ID){?>selected="selected"<?php }?>><?php echo $cat->name; ?></option>
<?php } ?>
</select>
      </p>
      <p><label for="<?php echo $this->get_field_id('no'); ?>"><?php _e('No of Post:', 'stacy'); ?> <input class="widefat" id="<?php echo $this->get_field_id('no'); ?>" name="<?php echo $this->get_field_name('no'); ?>" type="text" value="<?php echo $no; ?>" /></label></p>
     
      
      <?php 
    }

} // class Cycle Widget
 ?>
