<?php
  /*
 * Template Name: Staff
 */
?>
<?php get_header(); ?>
    <?php $banner=get_post_meta($post->ID,'_stacy_bimage',true); ?>
    <div class="col-sm-12 mrd mld">
    <?php if($banner): ?>
        <div class="banner-inner">
            <?php the_post_thumbnail('inner-thumbnail'); ?>
        </div>
        <?php else:  ?>
        <div class="banner-inner">
            <img src="<?php echo get_option('stacy_banner'); ?>" class="img-responsive" alt="banner" style="width: 1270px; margin:0 auto">
        </div>
        <?php endif; ?>
    </div>
    <div class="col-sm-12 body-lower attorney-profile">
        <div class="container">
            <div class="row">
                <div class="body-drop-up">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/img/body-drop.png" class="img-responsive no-block" alt="body-drop">
                </div>
                <div class="body-drop">
                    <div class="col-sm-8">
                        <div class="body-lower-left attom">
                            <h3><?php the_title(); ?></h3>
                            <?php 
                            query_posts("post_type=staff&showposts=-1&post_status=publish"); 
                            global $more;    // Declare global $more (before the loop).
                            $more = 0; 
                          while(have_posts()):the_post();        ?>
                          <!------ Staff Open ---------->
                                <?php  if ( has_post_thumbnail() ) { ?>
                                    <div class="atto-profile clearfix"> 
                                    <h2><?php the_title(); ?></h2>
                                    <div class="col-sm-3">
                                        <?php the_post_thumbnail('full',array('class'=>"img-responsive")); ?>
                                    </div>
                                    <div class="col-sm-9">
                                      <?php the_content('Read more...'); ?>
                                      <div class="clearfix"></div>
                                    </div>
                                 </div>
                                 <div class="divider"></div>
                                 <?php } ?>
                                 <!------ Staff Close ---------->
                            <?php endwhile; wp_reset_query(); ?>
                            <?php $display=get_post_meta($post->ID,'_stacy_wnews',true);
                            if($display){
                             ?>
                            <div class="elements clearfix">
                                <div class="col-sm-6">
                                    <?php if ( ! dynamic_sidebar( 'News' )) : ?>
                               
                     <?php endif; ?>
                                </div>
                                <div class="col-sm-6">
                                   <?php if ( ! dynamic_sidebar( 'Projects' )) : ?>
                               
                                 <?php endif; ?>                                    
                                    <div class="drop-shadow"></div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
           <?php get_sidebar(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
                          
<?php get_footer(); ?>