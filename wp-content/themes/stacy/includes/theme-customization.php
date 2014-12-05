<?php

include("class-fonts-customizer.php");
/**
 * Used by hook: 'customize_preview_init'
 * 
 * @see add_action('customize_preview_init',$func)
 */
 function mytheme_customizer_live_preview()
{
    wp_enqueue_script( 
          'mytheme-themecustomizer',            //Give the script an ID
          get_template_directory_uri().'/includes/theme-customize.js',//Point to file
          array( 'jquery','customize-preview' ),    //Define dependencies
          '',                        //Define a version (optional) 
          true                        //Put script in footer?
    );
}



function dsgn_customizer_register($wp_customize) {
        $wp_customize->add_section('navigation', array(
        'title' => __('Navigation Color', 'dsgn'),
        'description' => ('Modify the Navigation Color & Fonts')
    ));
     $wp_customize->add_section('sidebar_section', array(
        'title' => __('Sidebar Color & Fonts', 'dsgn'),
        'description' => ('Modify the Navigation Color & Fonts')
    ));
    $wp_customize->add_section('footer_section', array(
        'title' => __('Footer Color & Fonts', 'dsgn'),
        'description' => ('Modify the Navigation Color & Fonts')
    ));
    
    
    $wp_customize->add_section('dsgn_typograhy', array(
        'title' => __('Default Color & Fonts', 'dsgn'),
        'description' => ('Modify the theme typography')
    ));
        //All Sidebar Header Text Color
    $wp_customize->add_setting('sidebar_header_text_color', array(
        'default' => '#6f6b6b',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'sidebar_header_text_color', array(
        'label' => __('Edit All Sidebar Header Text Color', 'dsgn'),
        'section' => 'sidebar_section',
        'settings' => 'sidebar_header_text_color'
    ) ));
    //Content Color
    $wp_customize->add_setting('content_color', array(
        'default' => '#7a7a7a',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'content_color', array(
        'label' => __('Edit Content Text Color', 'dsgn'),
        'section' => 'dsgn_typograhy',
        'settings' => 'content_color'
    ) ));
    //Content Header Color
    $wp_customize->add_setting('content_header_color', array(
        'default' => '#042b5b',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'content_header_color', array(
        'label' => __('Edit Content Header Text Color', 'dsgn'),
        'section' => 'dsgn_typograhy',
        'settings' => 'content_header_color'
    ) ));
    //Text Under Banner
    $wp_customize->add_setting('banner_lower_text_color', array(
        'default' => '#777777',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'banner_lower_text_color', array(
        'label' => __('Edit Text Color Under Banner', 'dsgn'),
        'section' => 'dsgn_typograhy',
        'settings' => 'banner_lower_text_color'
    ) ));
     //Sidebar Limk Color
    $wp_customize->add_setting('sidebar_link_color', array(
        'default' => '#969696',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'sidebar_link_color', array(
        'label' => __('Edit Sidebar Link Color', 'dsgn'),
        'section' => 'sidebar_section',
        'settings' => 'sidebar_link_color'
    ) ));
      //Sidebar Button Color
    $wp_customize->add_setting('sidebar_button_color', array(
        'default' => '#fff',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'sidebar_button_color', array(
        'label' => __('Edit Sidebar Button Color', 'dsgn'),
        'section' => 'sidebar_section',
        'settings' => 'sidebar_button_color'
    ) )); 
    //Button Limk Color
    $wp_customize->add_setting('button_link_color', array(
        'default' => '#fff',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'button_link_color', array(
        'label' => __('Edit Button Link Color', 'dsgn'),
        'section' => 'dsgn_typograhy',
        'settings' => 'button_link_color'
    ) ));
    //Navigation Color
    $wp_customize->add_setting('navigation_anchor_color', array(
        'default' => '#585858',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'navigation_anchor_color', array(
        'label' => __('Edit Navigation Link Color', 'dsgn'),
        'section' => 'navigation',
        'settings' => 'navigation_anchor_color'
    ) ));
    //Footer Color
    $wp_customize->add_setting('footer_text_color', array(
        'default' => '#f4f4f4',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'footer_text_color', array(
        'label' => __('Edit Footer Text Color', 'dsgn'),
        'section' => 'footer_section',
        'settings' => 'footer_text_color'
    ) ));
    //Font size Maker
    $wp_customize->add_setting('font_size_edit', array(
        'default' => '12',
    ));
    
        $wp_customize->add_control( new WP_Customize_Fonts_Control($wp_customize, 'font_size_edit', array(
        'label' => __('Edit Content Text Font size', 'dsgn'),
        'section' => 'dsgn_typograhy',
        'settings' => 'font_size_edit'
    ) )); 
    //Link Font Size
    $wp_customize->add_setting('link_font_size_edit', array(
        'default' => '12',
    ));
    
        $wp_customize->add_control( new WP_Customize_Fonts_Control($wp_customize, 'link_font_size_edit', array(
        'label' => __('Edit Link Font size', 'dsgn'),
        'section' => 'dsgn_typograhy',
        'settings' => 'link_font_size_edit'
    ) )); 
    //Blog Font Size
    $wp_customize->add_setting('blog_font_size_edit', array(
        'default' => '12',
    ));
    
        $wp_customize->add_control( new WP_Customize_Fonts_Control($wp_customize, 'blog_font_size_edit', array(
        'label' => __('Edit Sidebar Text Font size', 'dsgn'),
        'section' => 'sidebar_section',
        'settings' => 'blog_font_size_edit'
    ) )); 
    //Footer Font Size
    $wp_customize->add_setting('footer_font_size_edit', array(
        'default' => '12',
    ));
    
        $wp_customize->add_control( new WP_Customize_Fonts_Control($wp_customize, 'footer_font_size_edit', array(
        'label' => __('Edit Footer Font size', 'dsgn'),
        'section' => 'footer_section',
        'settings' => 'footer_font_size_edit'
    ) )); 
    //Sidebar Header Size
    $wp_customize->add_setting('side_header_font_size_edit', array(
        'default' => '12',
    ));
    
        $wp_customize->add_control( new WP_Customize_Fonts_Control($wp_customize, 'side_header_font_size_edit', array(
        'label' => __('Edit Sidebar Header Font size', 'dsgn'),
        'section' => 'sidebar_section',
        'settings' => 'side_header_font_size_edit'
    ) ));
    //Sidebar Header Size
    $wp_customize->add_setting('banner_lower_font_size_edit', array(
        'default' => '43',
    ));
    
        $wp_customize->add_control( new WP_Customize_Fonts_Control($wp_customize, 'banner_lower_font_size_edit', array(
        'label' => __('Edit Banner Lower Font size', 'dsgn'),
        'section' => 'dsgn_typograhy',
        'settings' => 'banner_lower_font_size_edit'
    ) ));
     
    //All Link Color
    $wp_customize->add_setting('link_color', array(
        'default' => '#787676',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'link_color', array(
        'label' => __('Edit All Link Text Color', 'dsgn'),
        'section' => 'dsgn_typograhy',
        'settings' => 'link_color'
    ) ));
    //All Sidebar Text Color
    $wp_customize->add_setting('sidebar_text_color', array(
        'default' => '#969696',
    ));
    $wp_customize->add_control( new WP_customize_color_control($wp_customize, 'sidebar_text_color', array(
        'label' => __('Edit All Sidebar Text Color', 'dsgn'),
        'section' => 'sidebar_section',
        'settings' => 'sidebar_text_color'
    ) )); 
    
 

    
    $wp_customize->get_setting( 'content_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'sidebar_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_header_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'navigation_anchor_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'sidebar_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'sidebar_header_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'button_link_color' )->transport = 'postMessage';  
    $wp_customize->get_setting( 'font_size_edit' )->transport = 'postMessage';
    $wp_customize->get_setting( 'link_font_size_edit' )->transport = 'postMessage';
    $wp_customize->get_setting( 'banner_lower_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blog_font_size_edit' )->transport = 'postMessage';
    $wp_customize->get_setting( 'side_header_font_size_edit' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_font_size_edit' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'banner_lower_font_size_edit' )->transport = 'postMessage';
    $wp_customize->get_setting( 'sidebar_button_color' )->transport = 'postMessage';
}

function dsgn_css_customizer() {
    ?>
    <style type="text/css">
       .country td a {
            color: <?php echo get_theme_mod('link_color'); ?>;
            font-size: <?php echo get_theme_mod('link_font_size_edit'); ?>px ;
        } 
       .blog a, .recent-articles ul li a {
            color: <?php echo get_theme_mod('sidebar_link_color'); ?> ;
            font-size: <?php echo get_theme_mod('blog_font_size_edit'); ?>px ;
        }
        #navi a{
            color: <?php echo get_theme_mod('navigation_anchor_color'); ?> ;
        }
        body p {
            color: <?php echo get_theme_mod('content_color'); ?> ;
            font-size: <?php echo get_theme_mod('font_size_edit'); ?>px ;
            
        }
        .body-lower-left h3, .body-low-left h3, .body-low-left h2 {
            color: <?php echo get_theme_mod('content_header_color'); ?> ;
                       
        }
        .body-lower-sidebar p,.body-lower-sidebar a,.footer-left ul li p {
            color: <?php echo get_theme_mod('sidebar_text_color'); ?> ;
                       
        }
        a.read{
            color: <?php echo get_theme_mod('sidebar_button_color'); ?> ;
                       
        }
        .body-lower-sidebar h3,.body-lower-sidebar h2 {
            color: <?php echo get_theme_mod('sidebar_header_text_color'); ?> ;
            font-size: <?php echo get_theme_mod('side_header_font_size_edit'); ?>px ;           
        }
       .body-lower-left .more a {
            color: <?php echo get_theme_mod('button_link_color'); ?> ;
                       
        }
        .body-heading h1 {
            color: <?php echo get_theme_mod('banner_lower_text_color'); ?> ;
            font-size: <?php echo get_theme_mod('banner_lower_font_size_edit'); ?> ;           
        }
        
        .con-information-in p,.con-information-in a,.con-information-in h3,.footer-left ul li p,.footer-left h3 {
            color: <?php echo get_theme_mod('footer_text_color'); ?> ;
            font-size: <?php echo get_theme_mod('footer_font_size_edit'); ?> ;
                                 
        }
    </style>
    <?php
}

add_action('wp_head', 'dsgn_css_customizer');
add_action('customize_register', 'dsgn_customizer_register');
add_action( 'customize_preview_init', 'mytheme_customizer_live_preview' );
?>