<?php
function stacy_script(){
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_bloginfo('template_url').'/js/jquery-1.10.1.min.js', false, '1.10.1');
        wp_enqueue_script('jquery');

        wp_enqueue_script('bootstrap', get_bloginfo('template_url').'/js/bootstrap.min.js','','',true);
        wp_enqueue_script('tabdrop', get_bloginfo('template_url').'/js/bootstrap-tabdrop.js');
        wp_enqueue_script('javascript', get_bloginfo('template_url').'/js/javascript.js');
        wp_enqueue_script('jquery-ui', get_bloginfo('template_url').'/js/jquery-ui.js');   
        wp_enqueue_script('respond', get_bloginfo('template_url').'/js/respond.min.js','','',true);   
    }
}

function stacy_styles(){
    if (!is_admin()) {
                

         wp_enqueue_style('defualt', get_bloginfo('template_url').'/css/defualt.css');
         // wp_enqueue_style('bootstrap', get_bloginfo('template_url').'/css/bootstrap.min.css');
        
         
        

    }
}

global $pagenow;

if ( !is_admin() && 'wp-login.php' != $pagenow ) {
    add_action( 'wp_enqueue_scripts', 'stacy_styles' );
	add_action('wp_footer','stacy_script');
    //add_action('init', 'stacy_script');
    //add_action('init', 'stacy_styles');
}
?>