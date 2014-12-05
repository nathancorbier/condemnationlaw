<?php

// Theme Options
    function mytheme_add_admin() {
     
    global $themename, $shortname, $options;
     
    if ( $_GET['page'] == basename(__FILE__) ) {
     
        if ( 'save' == $_REQUEST['action'] ) {
     
            foreach ($options as $value) {
            update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
     
    foreach ($options as $value) {
        if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
        header("Location: admin.php?page=theme-options.php&saved=true");
    die;
     
    } 
    else if( 'reset' == $_REQUEST['action'] ) {
     
        foreach ($options as $value) {
            delete_option( $value['id'] ); }
     
        header("Location: admin.php?page=theme-options.php&reset=true");
        
    die;
     
    }
    }
     
    add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin',get_template_directory_uri()."/theme-options/images/settings-icon.png");
    }
    
    function mytheme_add_init() {
    
    $file_dir = get_bloginfo('template_directory');
    wp_enqueue_style("functions", $file_dir."/theme-options/css/functions.css", false, "1.0", "all");
    wp_enqueue_style("functions_checkbox_style", $file_dir."/theme-options/jqueryCheckbox/jquery.tzCheckbox.css", false, "1.0", "all");
    wp_enqueue_style("functions_select_style", $file_dir."/theme-options/css/chosen.min.css", false, "1.0", "all");
    
    
    wp_enqueue_script("rm_script", $file_dir."/theme-options/js/rm_script.js", false, "1.0");
    wp_enqueue_script("rm_script_migrate", $file_dir."/theme-options/js/jquery-migrate-1.2.1.min.js", false, "1.0");
    wp_enqueue_script("rm_script_checkbox", $file_dir."/theme-options/jqueryCheckbox/jquery.tzCheckbox.js", false, "1.0");
    wp_enqueue_script("rm_script_select", $file_dir."/theme-options/js/chosen.jquery.min.js", false, "1.0");
    wp_enqueue_script("rm_script_form", $file_dir."/theme-options/js/jquery.form.js", false, "1.0");
    
    }
    function mytheme_admin() {
     
    global $themename, $shortname, $options,$options_path;
    $i=0;
     
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
     
    ?>
      <?php
    
        require_once $options_path."theme-template.php";
    ?>
<?php
    }
    ?>
<?php
    add_action('admin_init', 'mytheme_add_init');
    add_action('admin_menu', 'mytheme_add_admin');
?>