<?php

function dashboard_footer_custom() {
    echo 'Stacy';
    }

add_filter('admin_footer_text', 'dashboard_footer_custom');
// custom admin login logo
function custom_login_logo() {
    ?><style type="text/css">
    h1{margin-bottom: 10px !important ;}
    h1 a { background: url('<?php echo get_bloginfo('template_directory')?>/img/logo.png')  no-repeat center top !important ; }
    </style>';
    <?php
}
add_action('login_head', 'custom_login_logo' );

function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
function my_login_stylesheet() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/includes/style-login.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/**
     * Get Category Pagination.
     *
     * @access public
     * @param array $array 
     * @param array $argument (default: 0)
     * @return array
     */
function pagination_array($array,$argument = array())
{ 
    $page = (get_query_var('page')) ? get_query_var('page') : "1";
    
    $default = array(
        'parent_cointainer' => "ul",
        'cointainer_class' => "asd",
        'child_cotainer' => 'li',
        'active_class' => 'active',
        'limit_page' => 5,
        'limit_page_number' => 3, 
        'previous_page' => "Previous Page",
        'next_page' => "Next Page",
        'first_page' => "|<",
        'last_page' => ">|",
        'bold_active' => true
    );
    $arg = wp_parse_args($argument,$default);
    
    extract($arg);
    
    //print_r($array);
    
    $ob = get_queried_object();
    $link = get_category_link($ob);
    
    $limit_page = $arg['limit_page'];
    $limit_number = $arg['limit_page_number'];
    
    if (empty($page) or !$limit_page) $page = 1; 

    $num_rows = count($array);
    
    if (!$num_rows or $limit_page >= $num_rows) {
        $a =array();
        $a['result'] = $array ;
        return $a;
    }
    
    $num_pages = ceil($num_rows / $limit_page);
    $page_offset = ($page - 1) * $limit_page;

    //Calculating the first number to show.
    if ($limit_number)
    {
        $limit_number_start = $page - ceil($limit_number / 2);
        $limit_number_end = ceil($page + $limit_number / 2) - 1;
        if ($limit_number_start < 1) $limit_number_start = 1;
        //In case if the current page is at the beginning.
        $dif = ($limit_number_end - $limit_number_start);
        if ($dif < $limit_number) $limit_number_end = $limit_number_end + ($limit_number - ($dif + 1));
        if ($limit_number_end > $num_pages) $limit_number_end = $num_pages;
        //In case if the current page is at the ending.
        $dif = ($limit_number_end - $limit_number_start);
        if ($limit_number_start < 1) $limit_number_start = 1;
    }
    else
    {
        $limit_number_start = 1;
        $limit_number_end = $num_pages;
    }
    
    $class = ($arg['cointainer_class'] !="") ? " class='".$arg['cointainer_class']."' " : "";
    $panel = "<".$arg['parent_cointainer'].$class.">";
    
    $link_first = add_query_arg(array("page" => 1 ),$link);
    $link_previous = add_query_arg(array("page" => ($page - 1) ),$link);
      
    if ($limit_number_start > 1) $panel .= "<".$arg['child_cotainer']."><a href='".$link_first."'>".$arg['first_page']."</a></".$arg['child_cotainer'].">
    <".$arg['child_cotainer']."><a href='".$link_previous."'>".$arg['previous_page']."</a></".$arg['child_cotainer'].">";
    //Generating page links.
    for ($i = $limit_number_start; $i <= $limit_number_end; $i++)
    {  
        $link_prefix = add_query_arg(array("page" => $i ),$link);
        
        $page_cur = "<".$arg['child_cotainer']."><a href='$link_prefix'>$i</a></".$arg['child_cotainer'].">";  
        if ($page == $i) {
            $bold = ($bold_active) ? "<a href='$link_prefix'><b>$i</b></a>" : "<a href='$link_prefix'>".$i."</a>";
            $page_cur = "<".$arg['child_cotainer']." class='".$arg['active_class']."'>".$bold."</".$arg['child_cotainer'].">";
        }
        else $page_cur = "<".$arg['child_cotainer']."><a href='$link_prefix'>$i</a></".$arg['child_cotainer'].">";

        $panel .= $page_cur ;
    }
    
    $link_last = add_query_arg(array("page" => $num_pages ),$link);
    $link_next = add_query_arg(array("page" => ($page + 1) ),$link);
    
    if ($limit_number_end < $num_pages) $panel = $panel."<".$arg['child_cotainer']."><a href='".$link_next."'>".$arg['next_page']."</a>
    </".$arg['child_cotainer']."><".$arg['child_cotainer']."> <a href='".$link_last."'>".$arg['last_page']."</a></".$arg['child_cotainer'].">";
    
    $page_last = ($num_rows <= ($page_offset+$limit_page)) ? ($page_offset+($num_rows - $page_offset)) : ($page_offset+$limit_page);
    
    $result_text = "<p>Showing ".($page_offset+1)." to ".$page_last." of ".$num_rows.'( '.$page.' Pages )</p>';
    
    $panel .= "</".$arg['parent_cointainer'].">";
    
    $output['panel'] = $panel; //Panel HTML source.
    $output['offset'] = $page_offset; //Current page number.
    $output['limit'] = $limit_page; //Number of resuts per page.
    $output['result'] = array_slice($array, $page_offset, $limit_page, true); //Array of current page results.  
    $output['text_result'] = $result_text; //Array of current page results.
    
    return $output;
}
// Customize the WooCommerce breadcrumb
if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
    function woocommerce_breadcrumb( $args = array() ) {

        $defaults = array(
            'delimiter'  => '',
            'wrap_before'  => '<ul class="breadcrumb">',
            'wrap_after' => '</ul>',
            'before'   => '<li>',
            'after'   => '</li>',
            'home'    => "Home"
        );

        $args = wp_parse_args( $args, $defaults  );
        // Don't display on product single page
    
            woocommerce_get_template( 'shop/breadcrumb.php', $args );
        
    }
}
function get_post_html_content($content)
{
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
add_filter('content_filter','get_post_html_content',10,1);

function mytheme_comment($comment, $args, $depth) {
    
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="comment-body">
      <div class="comment-author vcard">
      
         <?php echo get_avatar($comment,$size='48'); ?>
 
         <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
         <div class="comment-meta commentmetadata">
              <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                  <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
              </a>
              <?php edit_comment_link(__('(Edit)'),'  ','') ?>
              <span class="reply">
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
               </span>
          </div>
          
      </div> 
      
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
 
      <?php comment_text() ?>
     </div>
<?php
        }
?>