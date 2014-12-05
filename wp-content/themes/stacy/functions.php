<?php
    global  $options_path,$includes_path;
    
    $includes_path = TEMPLATEPATH . '/includes/';
    $options_path = TEMPLATEPATH . '/theme-options/'; 
	$plugin_path = TEMPLATEPATH . '/plugin/';
    $metabox_path = TEMPLATEPATH . '/metaboxes/';  

function nixcraft_preview_link() {
    $slug = basename(get_permalink());
    $mydomain = 'http://condemnation-law.com';
    $mydir = '/test1/';
    $mynewpurl = "$mydomain$mydir$slug";
    return "$mynewpurl";
}
add_filter( 'preview_post_link', 'nixcraft_preview_link' );


	
    //include_once $metabox_path.'setup.php';

    //include_once $metabox_path.'simple-spec.php';
 
//include_once 'metaboxes/full-spec.php';

//include_once 'metaboxes/checkbox-spec.php';

//include_once 'metaboxes/radio-spec.php';

//include_once 'metaboxes/select-spec.php';
	
    //Theme Options
    require_once $options_path . 'admin-options.php';
    
	//Theme Options
	require_once $metabox_path . 'metabox-management.php';
	
	//Loading jQuery and Scripts
	require_once $includes_path . 'theme-scripts.php';
	
	//Widget and Sidebar
	require_once $includes_path . 'sidebar-init.php';
	
	require_once $includes_path . 'register-widgets.php';
	
	
	//Additional function
	require_once $includes_path . 'theme-function.php';
    //theme customization
    require_once $includes_path . 'theme-customization.php';
	
	//Theme init
	require_once $includes_path . 'theme-init.php';
	
	//Shortcodes
    require_once $includes_path . 'theme_shortcodes/shortcodes.php';
    
    //Required Plugins
    require_once $plugin_path . 'activate-plugins.php';
    
    //Theme Options
    require_once $options_path . 'theme-options.php'; 
    
    require_once $includes_path .'wp_bootstrap_navwalker.php';
     //Custom functions
	require_once $includes_path . 'function-customs.php';
    
    //shortcode Advance
    include_once($includes_path . 'theme_shortcodes/alert.php');
  
    include_once($includes_path . 'theme_shortcodes/tabs.php');
    include_once($includes_path . 'theme_shortcodes/toggle.php');
    include_once($includes_path . 'theme_shortcodes/html.php'); 
    
    //tinyMCE includes
    include_once($includes_path . 'theme_shortcodes/tinymce/tinymce_shortcodes.php');
    
	
	// removes detailed login error information for security
	add_filter('login_errors',create_function('$a', "return null;"));
	
     add_action('wp_ajax_my_action', 'my_action_callback');

    function my_action_callback() {
        
        global $wpdb; // this is how you get access to the database

        $whatever =  $_POST['whatever'] ;


            echo do_shortcode('[gallery ids="'.$whatever.'"]');

        die(); // this is required to return a proper result
    }
    
    
	// Removes Trackbacks from the comment cout
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $count ) {
		if ( ! is_admin() ) {
			global $id;
			$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
			return count($comments_by_type['comment']);
		} else {
			return $count;
		}
	}
add_filter('the_content', 'remove_empty_p', 20, 1);
function remove_empty_p($content){
    $content = force_balance_tags($content);
    return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}
function clear_br($content){
    return str_replace("<p>&nbsp;</p>","", $content);
}
add_filter('the_content', 'clear_br');
add_filter('widget_text','the_content_custom');
function the_content_custom($content)
{
    return apply_filters('the_content',$content);
}
	
	//Stop WordPress from automatically inserting paragraph tags
	//remove_filter('the_content', 'wpautop');
	//remove_filter('the_content', 'wptexturize');

	// custom excerpt ellipses for 2.9+
	function custom_excerpt_more($more) {
		return 'Read More &raquo;';
	}
	add_filter('excerpt_more', 'custom_excerpt_more');
	// no more jumping for read more link
	function no_more_jumping($post) {
		return '&nbsp;<a href="'.get_permalink($post->ID).'" class="read-more">'.'Continue Reading'.'</a>';
	}
	add_filter('excerpt_more', 'no_more_jumping');
	
	
	// category id in body and post class
	function category_id_class($classes) {
		global $post;
		foreach((get_the_category($post->ID)) as $category)
			$classes [] = 'cat-' . $category->cat_ID . '-id';
			return $classes;
	}
	
	add_filter('post_class', 'category_id_class');
	add_filter('body_class', 'category_id_class');
    
    
    
    // Paste this in to your theme's functions file
// Redefine sub category display to output empty categories
function woocommerce_product_subcategories( $args = array() ) {
    global $woocommerce, $wp_query, $_chosen_attributes;
 
    $defaults = array(
        'before'  => '',
        'after'  => '',
        'force_display' => false
    );
 
    $args = wp_parse_args( $args, $defaults );
 
    extract( $args );
 
    // Main query only
    if ( ! is_main_query() && ! $force_display ) return;
 
    // Don't show when filtering
    if ( sizeof( $_chosen_attributes ) > 0 || ( isset( $_GET['max_price'] ) && isset( $_GET['min_price'] ) ) ) return;
 
    // Don't show when searching or when on page > 1 and ensure we're on a product archive
    if ( is_search() || is_paged() || ( ! is_product_category() && ! is_shop() ) ) return;
 
    // Check cateogries are enabled
    if ( is_product_category() && get_option( 'woocommerce_show_subcategories' ) == 'no' ) return;
    if ( is_shop() && get_option( 'woocommerce_shop_show_subcategories' ) == 'no' ) return;
 
    // Find the category + category parent, if applicable
    if ( $product_cat_slug = get_query_var( 'product_cat' ) ) {
        $product_cat = get_term_by( 'slug', $product_cat_slug, 'product_cat' );
        $product_category_parent = $product_cat->term_id;
    } else {
        $product_category_parent = 0;
    }
 
    // NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( http://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
    $args = array(
        'parent'        => $product_category_parent,
        'menu_order'    => 'ASC',
        'hide_empty'    => 0,
        'hierarchical'    => 1,
        'taxonomy'        => 'product_cat',
        'pad_counts'    => 1
    ); 
    
     global $pagination,$product_categories_my;
      
    $product_categories = get_categories( $args  );
    $product_categories_my = $product_categories;
    $product_category_found = false;
    
    $number_of_product = (get_option('wild_no_of_product_will_show')) ? get_option('wild_no_of_product_will_show') : 9;
    $number_of_page = (get_option('wild_no_page')) ? get_option('wild_no_page') : 5;
    $is_pagination = get_option('wild_is_pagination');
    
    
    if($is_pagination){
    $arg = array(
                'cointainer_class' => "paginations",
                'active_class' => 'paginations-active',  
                'limit_page' => $number_of_product,
                'limit_page_number' => $number_of_page, 
                'previous_page' => "<",
                'next_page' => ">",
                'first_page' => "|<",
                'last_page' => ">|",
                'bold_active' => false
   ); 
   
   $pagination = pagination_array($product_categories,$arg);
    
   $product_categories = $pagination['result'];
        
   }

   
    if ( $product_categories ) {
 
        foreach ( $product_categories as $category ) { 
            
            
 
            if ( ! $product_category_found ) {
                // We found a category
                $product_category_found = true;
                echo $before;
            }
 
            woocommerce_get_template( 'content-product_cat.php', array(
                'category' => $category
            ) );
 
        }
 
    }
 
    // If we are hiding products disable the loop and pagination
        if ( $product_category_found ) {
            if ( is_product_category() ) {
                $display_type = get_woocommerce_term_meta( $term->term_id, 'display_type', true );

                switch ( $display_type ) {
                    case 'subcategories' :    
                        $wp_query->post_count = 0;
                        $wp_query->max_num_pages = 0;
                    break;
                    case '' :   
                        if ( get_option( 'woocommerce_category_archive_display' ) == 'subcategories' ) {
                            $wp_query->post_count = 0;
                            $wp_query->max_num_pages = 0;
                        }
                    break;
                }
            }
            if ( is_shop() && get_option( 'woocommerce_shop_page_display' ) == 'subcategories' ) {  
                $wp_query->post_count = 0;
                $wp_query->max_num_pages = 0;
            }

            echo $after;
            return true;
        }
 
}
/** CUSTOM QUICK EDIT***/
// Add to our admin_init function
add_filter('manage_page_posts_columns', 'shiba_add_post_columns');
 
function shiba_add_post_columns($columns) {
    $columns['widget_set'] = 'Display Widgets';
    return $columns;
}
// Add to our admin_init function
add_action('manage_page_posts_custom_column', 'shiba_render_post_columns', 10, 2);
 
function shiba_render_post_columns($column_name, $id) {
    switch ($column_name) {     
    case 'widget_set':
        // show widget set
        $widget_id = get_post_meta( $id, '_stacy_wnews', TRUE);
        if ($widget_id) echo $widget_id ;
        else echo 'off';               
        break;
    }
} 

// Add to our admin_init function
add_action('quick_edit_custom_box',  'shiba_add_quick_edit', 10, 2);
 
function shiba_add_quick_edit($column_name, $post_type) {
    if ($column_name != 'widget_set') return;
    if($post_type != "page") return;
    global $post;  
    print_r($post->ID);
    ?>
    <fieldset class="inline-edit-col-left">
    <div class="inline-edit-col">
        <span class="title">Show Bottom Widgets : </span>
        <input type="hidden" name="_stacy_wnews_noncename" id="_stacy_wnews_noncename" value="" />
        <?php $show = get_post_meta($post->ID,"_stacy_wnews",true); ?>      
        <input type="checkbox" name="_stacy_wnews" <?php if($show == "on"){ ?> checked="checked" <?php } ?> id="_stacy_wnews_ID">
    </div>
    </fieldset>
    <?php
    
} 
 
// Add to our admin_init function
add_action('save_post', 'shiba_save_quick_edit_data');
 
function shiba_save_quick_edit_data($post_id) {
    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
    // to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post_id;    
    // Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } else {
        if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    }   
    // OK, we're authenticated: we need to find and save the data
    $post = get_post($post_id); 
    
    if (isset($_POST['_stacy_wnews']) && ($post->post_type != 'revision')) {
        $widget_set_id = esc_attr($_POST['_stacy_wnews']);
        if ($widget_set_id)
            update_post_meta( $post_id, '_stacy_wnews', $widget_set_id);     
        else
            delete_post_meta( $post_id, '_stacy_wnews');     
    }       
    return $widget_set_id;  
} 

// Add to our admin_init function
add_action('admin_footer', 'shiba_quick_edit_javascript');
 
function shiba_quick_edit_javascript() {
    global $current_screen;
    if (($current_screen->id != 'edit-page') || ($current_screen->post_type != 'page')) return; 
     
    ?>
    <script type="text/javascript">
    <!--
    function set_inline_widget_set(widgetSet, nonce) {
        // revert Quick Edit menu so that it refreshes properly
        inlineEditPost.revert();  
        var widgetInput = document.getElementById('_stacy_wnews_ID');
        var nonceInput = document.getElementById('_stacy_wnews_noncename');
        nonceInput.value = nonce;
        // check option manually
        
        widgetInput.val = widgetSet;
        

    }
    //-->
    </script>
    <?php
}  

// Add to our admin_init function
add_filter('post_row_actions', 'shiba_expand_quick_edit_link', 10, 2);
 
function shiba_expand_quick_edit_link($actions, $post) {
    global $current_screen;
    if (($current_screen->id != 'edit-page') || ($current_screen->post_type != 'page')) return $actions; 
 
    $nonce = wp_create_nonce( '_stacy_wnews'.$post->ID);
    
    $widget_id = get_post_meta( $post->ID, '_stacy_wnews', TRUE);
     
    $actions['inline hide-if-no-js'] = '<a href="#" class="editinline" title="';
    $actions['inline hide-if-no-js'] .= esc_attr( __( 'Edit this item inline' ) ) . '" ';
    $actions['inline hide-if-no-js'] .= " onclick=\"set_inline_widget_set('{$widget_id}', '{$nonce}')\">"; 
    $actions['inline hide-if-no-js'] .= __( 'Quick&nbsp;Edit' );
    $actions['inline hide-if-no-js'] .= '</a>';
    
    return $actions;    
}
function vipx_remove_cpt_slug( $post_link, $post, $leavename ) {
 
    if ( ! in_array( $post->post_type, array( 'state-information' ) ) || 'publish' != $post->post_status )
        return $post_link;
 
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
 
    return $post_link;
}
add_filter( 'post_type_link', 'vipx_remove_cpt_slug', 10, 3 );





function vipx_parse_request_tricksy( $query ) {
 
    // Only noop the main query
    if ( ! $query->is_main_query() )
        return;
 
    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query )
        || ! isset( $query->query['page'] ) )
        return;
 
    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    if ( ! empty( $query->query['name'] ) )
        $query->set( 'post_type', array( 'post', 'state-information', 'page' ) );
}
//add_action( 'pre_get_posts', 'vipx_parse_request_tricksy' );
