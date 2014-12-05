<?php
  /*
 * Template Name: News
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
            <img src="<?php echo get_option('stacy_banner'); ?>" class="img-responsive" alt="banner" style="width: 1270px;margin:0 auto">
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
                            <p><?php echo get_the_content(); ?></p>
                            <?php
                               // query_posts('post_type=news&showposts=10&post_status=publish'.'&paged='.$paged)
                            ?>
                            
                                <?php
// 04DEC2014 - NAC@CAAC - Removed wp_reset_query because we never know the page!                        
//wp_reset_query();
                        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
                        $temp = $wp_query;
                        $wp_query= null;
                        $wp_query = new WP_Query();
                       $wp_query->query('post_type=news&showposts=10&post_status=publish'.'&paged='.$page);
                        ?>
                      
                        <?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                                      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <h2 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

                                          <div class="fleft" style="float:none">
                                          <time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?> at <?php the_time() ?></time> | 
                                          <span><a href="<?php the_permalink(); ?>feed" class="button">Subscribe to rss</a></span>
                                          </div>
<div class="post-content">
                                          <div class="excerpt"><?php $excerpt = get_the_excerpt(); echo my_string_limit_words($excerpt,40);?></div>
                                          <a href="<?php the_permalink() ?>" class="button">more <span>&rsaquo;&rsaquo;</span></a>
                                        </div>
                                        <div class="post-meta">
                                          <div class="clearfix"></div>
                                        </div><!--.post-meta-->
                                        <?php if ( has_post_thumbnail()) { ?>
                                          <a href="<?php the_permalink() ?>" class="img-wrap"><strong class="img-border"></strong><?php the_post_thumbnail(); ?></a>
                                      <?php } ?>
                                                                              
                                      </article>
                                    <?php endwhile;  
                  if(function_exists('wp_paginate')) {wp_paginate();} 
                  wp_reset_query(); 
                                      $display=get_post_meta($post->ID,'_stacy_wnews',true);
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
                                   
                                </div>
                            </div>
                            <?php } ?>
                                   <?php else: ?>
                                       <div class="no-results">
                                        <p><strong>There has been an error showing page <?php echo $page;?>. Perhaps you've went too far back?</strong></p>
                                        <p>We apologize for any inconvenience, please <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>">return to the home page</a> or use the search form below.</p>
                                        <?php get_search_form(); /* outputs the default Wordpress search form */ ?>
                                      </div><!--noResults-->
                                    <?php endif; ?>
                                      
                                    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                                      <div class="oldernewer">
                                        <div class="older">
                                          <?php next_posts_link('&laquo; Older Entries') ?>
                                        </div><!--.older-->
                                        <div class="newer">
                                          <?php previous_posts_link('Newer Entries &raquo;') ?>
                                        </div><!--.newer-->
                                        <div class="clearfix"></div>
                                      </div><!--.oldernewer-->
                                    <?php endif; ?>
                               </div>
                    </div>
           <?php get_sidebar(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            
        </div>
    </div>
<?php get_footer(); ?>