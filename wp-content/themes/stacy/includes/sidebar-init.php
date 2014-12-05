<?php
function elegance_widgets_init() {
    // Category Widget 
       register_sidebar(array(
        'name'                    => 'Category',
        'id'                         => 'category',
        'description'   => __( 'Located at Sidebar.'),
        'before_widget' => '<div id="%1$s" class="widget"><div class="recentarticle">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
	// Header Widget
      register_sidebar(array(
        'name'                    => 'Free Consultaton',
        'id'                         => 'consult',
        'description'   => __( 'Located at Header Contact Details'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
	// Location: right after the navigation
	/*register_sidebar(array(
		'name'					=> 'Home Banner',
		'id' 						=> 'header-banner',
		'description'   => __( 'Located at the Home page.'),
		'before_widget' => '',
		'after_widget' => ''
	));*/ 
   
	
    // Location: at the top of the content
  /*  register_sidebar(array(
        'name'                    => 'Footer Menu',
        'id'                         => 'footer-menu',
        'description'   => __( 'Located at Footer.'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    )); */
 // Location: at the top of the content
  /*  register_sidebar(array(
        'name'                    => 'Footer Socials',
        'id'                         => 'footer-Socials',
        'description'   => __( 'Located at Footer.'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    )); */
       register_sidebar(array(
        'name'                    => 'Address',
        'id'                         => 'address',
        'description'   => __( 'Located at Footer.'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    //HOme Banner
      register_sidebar(array(
        'name'                    => 'Home Banner',
        'id'                         => 'hbanner',
        'description'   => __( 'Located at Header'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    
	// Sidebar Widget
	// Location: the sidebar
	/*register_sidebar(array(
		'name'					=> 'Sidebar',
		'id' 						=> 'main-sidebar',
		'description'   => __( 'Located at the left side of pages.'),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));*/
    // Location: the sidebar
    register_sidebar(array(
        'name'                    => 'Videos',
        'id'                         => 'video',
        'description'   => __( 'Located at the right side of pages.'),
        'before_widget' => '<div id="%1$s" class="widget"><div class="video">',
        'after_widget' => '<img src="'.get_bloginfo('template_url').'/img/video-shadow.png" class="img-responsive" alt="video-shadow"></div>
                        </div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
       register_sidebar(array(
        'name'                    => 'Contact Us',
        'id'                         => 'contact',
        'description'   => __( 'Located at the right side of pages.'),
        'before_widget' => '<div class="widget" ><div class="consulation">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
     register_sidebar(array(
        'name'                    => 'Contact Us Home Page',
        'id'                         => 'hcontact',
        'description'   => __( 'Located at the right side of pages.'),
        'before_widget' => '<div id="%1$s" class="widget"><div class="contact">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
     register_sidebar(array(
        'name'                    => 'Recent Blog',
        'id'                         => 'blog',
        'description'   => __( 'Located at the right side of pages.'),
        'before_widget' => '<div id="%1$s" class="widget"><div class="blog-bg">',
        'after_widget' => '</div> </div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
     register_sidebar(array(
        'name'                    => 'Heading under Home Page Banner',
        'id'                         => 'heading',
        'description'   => __( 'Located Under the Home Page Banner.'),
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
 register_sidebar(array(
        'name'                    => 'Resource Center',
        'id'                         => 'resource',
        'description'   => __( 'Located Under the Home Page Banner.'),
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
  register_sidebar(array(
        'name'                    => 'Testimonial Middle',
        'id'                         => 'testi',
        'description'   => __( 'Located Under the Home Page Banner.'),
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
     register_sidebar(array(
        'name'                    => 'Sidebar Testimonial',
        'id'                         => 'testimonial',
        'description'   => __( 'Located at the right side of pages.'),
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name'                    => 'Search',
        'id'                         => 'search',
        'description'   => __( 'Located at the right side of pages.'),
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
 register_sidebar(array(
        'name'                    => 'Case',
        'id'                         => 'case',
        'description'   => __( 'Located Under the Home Page Banner.'),
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
   register_sidebar(array(
        'name'                    => 'Recent Blog Inner Page',
        'id'                         => 'inner_blog',
        'description'   => __( 'Located Under the Home Page Banner.'),
        'before_widget' => '<div id="%1$s" class="widget"><div class="recentarticle">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
      register_sidebar(array(
        'name'                    => 'News',
        'id'                         => 'news',
        'description'   => __( 'Located at the bottome Page'),
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
       register_sidebar(array(
        'name'                    => 'Projects',
        'id'                         => 'projects',
        'description'   => __( 'Located at the bottome Page'),
        'before_widget' => '<div id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elegance_widgets_init' );
?>