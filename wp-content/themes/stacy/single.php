<?php get_header(); ?>
    <?php $banner=get_post_meta($post->ID,'_stacy_bimage',true); ?>
    <div class="col-sm-12 mrd mld">
    <?php if($banner): ?>
        <div class="banner-inner">
            <?php the_post_thumbnail('inner-thumbnail'); ?>
        </div>
        <?php else:  ?>
        <div class="banner-inner">
            <img src="<?php echo get_option('stacy_banner'); ?>" class="img-responsive" alt="banner" style="margin:0 auto; width:1270px">
        </div>
        <?php endif; ?>
    </div>
    <div class="col-sm-12 body-lower">
        <div class="container">
            <div class="row">
                <div class="body-drop-up">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/img/body-drop.png" class="img-responsive no-block" alt="body-drop">
                </div>
                <div class="body-drop">
                    <div class="col-sm-8">
                        <div class="body-low-left">
                            <h3><?php the_title(); ?></h3>
                               <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                            <?php 
                             the_content(); ?>
                             <br>
                              <span><a href="<?php the_permalink(); ?>feed" class="button">Subscribe to rss</a></span>
                              <div class="oldernewer">
                                  <div class="older">
                                    <?php previous_post_link('%link', '&laquo; Previous post') ?>
                                  </div><!--.older-->
                                  <div class="newer">
                                    <?php next_post_link('%link', 'Next Post &raquo;') ?>
                                  </div><!--.newer-->
                                  <div class="clearfix"></div>
                                </div><!--.oldernewer-->

                                 <?php comments_template( '', true ); ?>
                            <?php endwhile; ?>
                         </div>
                    </div>
           <?php get_sidebar(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            
        </div>
    </div>
    
<?php get_footer(); ?>