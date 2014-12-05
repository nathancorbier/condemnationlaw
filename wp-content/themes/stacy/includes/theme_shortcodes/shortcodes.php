<?php
// Grid Columns
   
add_shortcode('green_button', 'shortcode_green_buton');
function shortcode_green_buton($atts, $content = null,$shortcodename =""){ 
    
    $output = '';
    $class = "green-button";

    $output .= '<span class="'.$class.'">';
    $output .= do_shortcode($content);
    $output .= '</span>';
    return $output;
 
}

add_shortcode('blue_strong', 'shortcode_blue_strong');
function shortcode_blue_strong($atts, $content = null,$shortcodename =""){ 
    
    $output = '';

    $output .= '<span>';
    $output .= do_shortcode($content);
    $output .= '</span>';
    
    return $output;
 
}
add_shortcode('learn_more', 'shortcode_learn_more');
function shortcode_learn_more($atts, $content = null,$shortcodename =""){ 
    
    $output = '';

    $output .= '<span class="more pull-right">';
    $output .= do_shortcode($content);
    $output .= '</span>';
    
    return $output;
 
}

add_shortcode('collumns', 'shortcode_collumns');
function shortcode_collumns($atts, $content = null,$shortcodename =""){ 
    
    $output = '';

    $output .= '<div class="col-sm-6 mld">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    
    return $output;
 
}
add_shortcode('hrline', 'shortcode_devider');
function shortcode_devider($atts, $content = null,$shortcodename =""){ 
    
    $output = '';

    $output .= '<div class="clearfix"></div>';
    $output .= '<div class="divider">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    
    return $output;
 
}
add_shortcode('country', 'shortcode_countery');
function shortcode_countery($atts, $content = null,$shortcodename =""){ 
    
    $output = '';

    $output .= '<div class="country">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    
    return $output;
 
}
add_shortcode('tabwrap', 'shortcode_tabwrap');
function shortcode_tabwrap($atts, $content = null,$shortcodename =""){ 
    
    $output = '';

    $output .= '<div class="tab">';
        $output .= '<div>';
            $output .= do_shortcode($content);
        $output .= '</div>';
    $output .= '</div>';
    
    return $output;
 
}
add_shortcode('post', 'shortcode_post');
function shortcode_post($atts, $content = null,$shortcodename =""){ 
    
    extract(shortcode_atts(array(
                "type" => 'post',                                             
                'num' => '5'
        ), $atts)); 
        
    query_posts("post_type=".$type."&showposts=".$num."&post_status=publish");
    
    $output = "<ul>";
    
    while(have_posts()):the_post();
    
       $output.="<li><a href='".get_permalink()."'>".get_the_title()."</a></li>"; 
    
    endwhile;
    
    $output .= '</ul>';
    
    wp_reset_query();
    
    return $output;
 
}



add_shortcode('state_table','stacy_state_table' );
function stacy_state_table($atts, $content = null,$shortcodename =""){ 
    
    extract(shortcode_atts(array(
                "type" => 'state-information'
        ), $atts)); 
    global $wp_query;    
    query_posts("post_type=".$type."&showposts=-1&post_status=publish&orderby=title&order=ASC");
    $count = $wp_query->post_count;
    $output = "<div class='country'>
    <table width='100%' class='table table-responsive'>
        <tbody><tr>";
    $i = 0;
    while(have_posts()):the_post();
        
        $title = get_the_title();
        $title = str_replace("Eminent Domain","",$title);
        
        if( $i % 4 == 0 && $i != $count ){ $output .= "</tr><tr>"; }
        $output .="<td><a href='".get_permalink()."'>".$title."</a></td>"; 
       //$output.="<li><a href='".get_permalink()."'>".get_the_title()."</a></li>"; 
        $i++;
        
    endwhile;
    
    $output .= '</tr>
        </tbody>
    </table>
    </div>';
    
    wp_reset_query();
    
    return $output;
 
}

add_shortcode('state_toggle','stacy_state_toggle' );
function stacy_state_toggle($atts, $content = null,$shortcodename =""){

    $output = "";
    $output .= '<div><a href="#" id="button" class="clikcon">Click to Contact</a>';
    $output .= '<div class="toggler" style="display: none;">
                                        <div id="effect" class="ui-widget-content ui-corner-all">';
    $output .= $content;
    $output .='</div>
        </div></div>';
    return $output;
    
    
}

add_shortcode('toggle_wrap','stacy_state_toggle_wrap' );
function stacy_state_toggle_wrap($atts, $content = null,$shortcodename =""){
    
    $output ="";
    $output .= "<div class='col-sm-4 offices'>";
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
    
    
}


 add_shortcode('collapsibles','bs_collapsibles' );
  function bs_collapsibles( $atts, $content = null ) {
    
    if( isset($GLOBALS['collapsibles_count']) )
        $GLOBALS['collapsibles_count']++;
    else
        $GLOBALS['collapsibles_count'] = 0;

    $defaults = array();
    extract( shortcode_atts( $defaults, $atts ) );
    
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/collapse title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    
    $output = '';
    
    if( count($tab_titles) ){
      $output .= '<div class="panel-group myaccordion" id="accordion-' . $GLOBALS['collapsibles_count'] . '">';
      $output .= do_shortcode( $content );
      $output .= '</div>';
    } else {
      $output .= do_shortcode( $content );
    }
    
    return $output;
  } 
add_shortcode('collapse','bs_collapse' );
function bs_collapse( $atts, $content = null ) {

    if( !isset($GLOBALS['current_collapse']) )
      $GLOBALS['current_collapse'] = 0;
    else 
      $GLOBALS['current_collapse']++;


    $defaults = array( 'title' => 'Tab', 'state' => '');
    extract( shortcode_atts( $defaults, $atts ) );
    
    if (!empty($state)) 
      $state = 'in';

    return '
   <div class="panel panel-default">
      <div class="panel-heading">
       <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-' . $GLOBALS['collapsibles_count'] . '" href="#collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'">
        <span>'.($GLOBALS['current_collapse']+1).'</span>  ' . $title . ' 
        </a>
        </h4>
      </div>
      <div id="collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'" class="panel-collapse collapse ' . $state . '">
        <div class="panel-body">
          ' . do_shortcode( $content ) . ' 
        </div>
      </div>
    </div>
    ';
  }
add_action( 'after_setup_theme', 'stacy_setup' );
?>