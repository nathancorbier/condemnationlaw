/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

    // Update the site title in real time...
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            $( '#site-title a' ).html( newval );
        } );
    } );
    wp.customize( 'link_color', function( value ) {
        value.bind( function( newval ) {
            $( '.country td a' ).css('color', newval );
        } );
    } );
      wp.customize( 'sidebar_link_color', function( value ) {
        value.bind( function( newval ) {
            $( '.blog a, .recent-articles ul li a' ).css('color', newval );
        } );
    } );
    wp.customize( 'content_color', function( value ) {
        value.bind( function( newval ) {
            $( 'body p' ).css('color', newval );
        } );
    } );
    wp.customize( 'content_header_color', function( value ) {
        value.bind( function( newval ) {
            $( '.body-lower-left h3' ).css('color', newval );
        } );
    } ); 
    wp.customize( 'banner_lower_text_color', function( value ) {
        value.bind( function( newval ) {
            $( '.body-heading h1' ).css('color', newval );
        } );
    } );
     wp.customize( 'navigation_anchor_color', function( value ) {
        value.bind( function( newval ) {
            $( '#navi a' ).css('color', newval );
        } );
    } );
    wp.customize( 'button_link_color', function( value ) {
        value.bind( function( newval ) {
            $( '.body-lower-left .more a' ).css('color', newval );
        } );
    } );
     wp.customize( 'sidebar_button_color', function( value ) {
        value.bind( function( newval ) {
            $( 'a.read' ).css('color', newval );
        } );
    } );
    
       wp.customize( 'sidebar_text_color', function( value ) {
        value.bind( function( newval ) {
            $( '.body-lower-sidebar p, .body-lower-sidebar a' ).css('color', newval );
        } );
    } );
     wp.customize( 'sidebar_header_text_color', function( value ) {
        value.bind( function( newval ) {
            $( '.body-lower-sidebar h3, .body-lower-sidebar h2' ).css('color', newval );
        } );
    } );
    
     wp.customize( 'font_size_edit', function( value ) {
        value.bind( function( newval ) {
            $( 'body p' ).css('font-size', newval+"px" );
        } );
    } );
    wp.customize( 'link_font_size_edit', function( value ) {
        value.bind( function( newval ) {
            $( '.country td a' ).css('font-size', newval+"px" );
        } );
    } );
    wp.customize( 'blog_font_size_edit', function( value ) {
        value.bind( function( newval ) {
            $( '.blog a' ).css('font-size', newval+"px" );
        } );
    } );
    wp.customize( 'side_header_font_size_edit', function( value ) {
        value.bind( function( newval ) {
            $( '.body-lower-sidebar h3,.body-lower-sidebar h2' ).css('font-size', newval+"px" );
        } );
    } );
         wp.customize( 'footer_font_size_edit', function( value ) {
        value.bind( function( newval ) {
            $( '.con-information-in p' ).css('font-size', newval+"px" );
        } );
    } ); 
    wp.customize( 'banner_lower_font_size_edit', function( value ) {
        value.bind( function( newval ) {
            $( '.body-heading h1' ).css('font-size', newval+"px" );
        } );
    } );
    wp.customize( 'footer_text_color', function( value ) {
        value.bind( function( newval ) {
            $('.con-information-in p,.con-information-in a,.con-information-in h3,.footer-left ul li p,.footer-left h3').css('color', newval );
        } );
    } );
              
    //Update the site description in real time...
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( newval ) {
            $( '.site-description' ).html( newval );
        } );
    } );

    //Update site title color in real time...
    wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( newval ) {
            $('#site-title a').css('color', newval );
        } );
    } );

    //Update site background color...
    wp.customize( 'content_color', function( value ) {
        value.bind( function( newval ) {
            $('body p').css('color', newval );
        } );
    } );
    
    //Update site background color...
    wp.customize( 'background_color', function( value ) {
        value.bind( function( newval ) {
            $('body').css('background-color', newval );
        } );
    } );
        
    //Update site title color in real time...
    wp.customize( 'mytheme_options[link_textcolor]', function( value ) {
        value.bind( function( newval ) {
            $('a').css('color', newval );
        } );
    } );
    
} )( jQuery );