<?php

add_action( 'after_setup_theme', 'stacy_setup' );

if ( ! function_exists( 'stacy_setup' ) ):

function stacy_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
        
		set_post_thumbnail_size( 204, 162, false ); // Normal post thumbnails
        add_image_size( 'slider-post-thumbnail', 1180, 330, false ); // Slider Thumbnail
        add_image_size( 'testimonial-post-thumbnail', 310, 138, false ); // Slider Thumbnail
        add_image_size( 'blog-thumbnail', 52, 34, false ); // Slider Thumbnail
        add_image_size( 'project-thumbnail', 33, 34, false ); // Slider Thumbnail
        add_image_size( 'inner-thumbnail',1349,96, false ); // Slider Thumbnail
     
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// custom menu support
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'top_header_menu' => 'Top Header Menu',
	  		  'header_menu' => 'Header Menu',
	  		)
	  	);
	}
}
endif;


/* Slider */

/* Testimonial */
function stacy_post_type_testimonial() {

    register_post_type( 'testimonial',
                array( 
                'label' => __('Testimonial'), 
                'public' => true, 
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'menu_position' => 5,
                'supports' => array(
                        'title', 
                        'editor',
                        'thumbnail')
                    ) 
                );
}
add_action('init', 'stacy_post_type_testimonial'); 


function stacy_post_type_staff() {

    register_post_type( 'staff',
                array( 
                'label' => __('Staff'), 
                'public' => true, 
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'menu_position' => 5,
                'supports' => array(
                        'title', 
                        'editor',
                        'thumbnail')
                    ) 
                );
}
add_action('init', 'stacy_post_type_staff'); 

function stacy_post_type_news_feed() {

    register_post_type( 'news_feed',
                array( 
                'label' => __('News Feed'), 
                'public' => true, 
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'menu_position' => 5,
                'supports' => array(
                        'title', 
                        'excerpt',
                        'thumbnail')
                    ) 
                );
}
add_action('init', 'stacy_post_type_news_feed'); 

function stacy_post_type_news() {

    register_post_type( 'news',
                array( 
                'label' => __('News'), 
                'public' => true, 
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'menu_position' => 7,
                'supports' => array(
                        'title', 
                        'editor',
                        'thumbnail')
                    ) 
                );
}
add_action('init', 'stacy_post_type_news');

function stacy_post_type_state() {

    register_post_type( 'state-information',
                array( 
                'label' => __('State Info'), 
                'public' => true, 
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'menu_position' => 7,
                'supports' => array(
                        'title', 
                        'editor',
                        'thumbnail')
                    ) 
                );
                 register_taxonomy('state-cat', 'state-information', array('hierarchical' => true, 'label' => 'Categories', 'singular_name' => 'Category'));
                
    
}
add_action('init', 'stacy_post_type_state');

function stacy_post_type_attorney() {

    register_post_type( 'attorney',
                array( 
                'label' => __('Attorney Profiles'), 
                'public' => true, 
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'menu_position' => 7,
                'supports' => array(
                        'title', 
                        'editor',
                        'thumbnail')
                    ) 
                );
          register_taxonomy('attorney-cat', 'attorney', array('hierarchical' => true, 'label' => 'Categories', 'singular_name' => 'Attorney Category'));      
}
add_action('init', 'stacy_post_type_attorney');