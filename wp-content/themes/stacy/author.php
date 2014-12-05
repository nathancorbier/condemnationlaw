<?php get_header(); ?>
<?php
    if(isset($_GET['author_name'])) :
      $curauth = get_userdatabylogin($author_name);
      else :
      $curauth = get_userdata(intval($author));
    endif;
  ?>
 <!------ Banner Open ---------->
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
    <!------ Banner Close ---------->
 <!------ Body-Lower Open ---------->
    <div class="col-sm-12 body-lower">
        <div class="container">
            <div class="row">
                <div class="body-drop-up">
                    <img src="<?php echo get_bloginfo('template_url'); ?>/img/body-drop.png" class="img-responsive no-block" alt="body-drop">
                </div>
                <div class="body-drop">
                    <div class="col-sm-8">
                        <div class="body-low-left">
                            <h3>About: <?php echo $curauth->display_name; ?></h3>
                            <p class="avatar">
      <?php if(function_exists('get_avatar')) { echo get_avatar( $curauth->user_email, $size = '120' ); } /* Displays the Gravatar based on the author's email address. Visit Gravatar.com for info on Gravatars */ ?>
    </p
                            ><?php if($curauth->description !="") { /* Displays the author's description from their Wordpress profile */ ?>
      <p><?php echo $curauth->description; ?></p>
    <?php } ?>
    <h3 class="title">Recent Posts by <?php echo $curauth->display_name; ?></h3>
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <h2 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                        <div class="post-meta">
                                          <div class="fleft"><time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?> at <?php the_time() ?></time> , by <?php the_author_posts_link() ?> | 
                                          <span><a href="<?php the_permalink(); ?>feed" class="button">Subscribe to rss</a></span></div>
                                          <div class="fright"><?php comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?></div>
                                          <div class="clearfix"></div>
                                        </div><!--.post-meta-->
                                        <?php if ( has_post_thumbnail()) { ?>
                                          <a href="<?php the_permalink() ?>" class="img-wrap"><strong class="img-border"></strong><?php the_post_thumbnail(); ?></a>
                                      <?php } ?>
                                        
                                        <div class="post-content">
                                          <div class="excerpt"><?php $excerpt = get_the_excerpt(); echo my_string_limit_words($excerpt,40);?></div>
                                          <a href="<?php the_permalink() ?>" class="button">more <span>&rsaquo;&rsaquo;</span></a>
                                        </div>
                                      </article>
                                    <?php endwhile; else: ?>
                                      <div class="no-results">
                                        <p><strong>There has been an error.</strong></p>
                                        <p>We apologize for any inconvenience, please <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>">return to the home page</a> or use the search form below.</p>
                                        <?php get_search_form(); /* outputs the default Wordpress search form */ ?>
                                      </div><!--noResults-->
                                    <?php endif; ?>
                                      
                                    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                                      <nav class="oldernewer">
                                        <div class="older">
                                          <?php next_posts_link('&laquo; Older Entries') ?>
                                        </div><!--.older-->
                                        <div class="newer">
                                          <?php previous_posts_link('Newer Entries &raquo;') ?>
                                        </div><!--.newer-->
                                        <div class="clearfix"></div>
                                      </nav><!--.oldernewer-->
                                    <?php endif; ?>
                                      <div id="recent-author-comments">
                                            <h3 class="title">Recent Comments by <?php echo $curauth->display_name; ?></h3>
                                              <?php
                                                $number=5; // number of recent comments to display
                                                $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' and comment_author_email='$curauth->user_email' ORDER BY comment_date_gmt DESC LIMIT $number");
                                              ?>
                                              <ul>
                                                <?php
                                                  if ( $comments ) : foreach ( (array) $comments as $comment) :
                                                  echo  '<li class="recentcomments">' . sprintf(__('%1$s on %2$s'), get_comment_date(), '<a href="'. get_comment_link($comment->comment_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . '</li>';
                                                endforeach; else: ?>
                                                          <p>
                                                            No comments by <?php echo $curauth->display_name; ?> yet.
                                                          </p>
                                                <?php endif; ?>
                                                    </ul>
                                          </div><!--#recentAuthorComments-->
        
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
                        </div>
                    </div>
           <?php get_sidebar(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            
        </div>
    </div>
    <!------ Body-Lower Close ---------->
<?php get_footer(); ?>