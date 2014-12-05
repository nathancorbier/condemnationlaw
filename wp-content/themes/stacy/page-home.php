<?php
  /*
 * Template Name: Home
 */
?>
<?php get_header(); ?>
    <div class="col-sm-12 mrd mld">
        <div class="banner">
<?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>
<?php if ( ! dynamic_sidebar( 'Home Banner')) : ?> 
                               
                     <?php endif; ?> 
                     </div>
    </div>
    <div class="col-sm-12 body-upper" style="margin-top: 2px;">
        <div class="container">
        <div class="body-heading">
                <?php if ( ! dynamic_sidebar( 'Heading under Home Page Banner' )) : ?>
                               
                     <?php endif; ?> 
        </div>
            <div class="col-sm-4">
            <?php if ( ! dynamic_sidebar( 'Resource Center' )) : ?>
                               
                     <?php endif; ?> 
            </div>
            <div class="col-sm-4">
            
                   <?php if ( ! dynamic_sidebar( 'Testimonial Middle' )) : ?>
                               
                     <?php endif; ?>
                </div>
            <div class="col-sm-4"> 
               <?php if ( ! dynamic_sidebar( 'Case' )) : ?>
                               
                     <?php endif; ?> 
            </div>
        </div>
    </div>
    <div class="col-sm-12 body-lower">
        <div class="container" >
            <div class="row">
                <div class="body-drop-up">
                    <img src="<?php echo get_bloginfo('template_url');?>/img/body-drop.png" class="img-responsive no-block" alt="body-drop">
                </div>
                <div class="body-drop"  style="margin-top:20px">
                    <div class="col-sm-8">
                        <div class="body-lower-left">
                            <?php while ( have_posts() ) : the_post(); ?>
                                  <?php the_content(); ?>  
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="body-lower-sidebar">
                            <div class="video-bg">
                                <?php if ( ! dynamic_sidebar( 'Videos' )) : ?>
                               
                                    <?php endif; ?> 
                                </div>
                            
                            <div class="contact-bg">
                                <?php if ( ! dynamic_sidebar( 'Contact Us Home Page' )) : ?>
                               
                                    <?php endif; ?> 
                                 </div>
                            
                            
                                 <?php if ( ! dynamic_sidebar( 'Recent Blog' )) : ?>
                           
                                <?php endif; ?> 
                           
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
