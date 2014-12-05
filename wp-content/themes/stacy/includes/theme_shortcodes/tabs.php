<?php
add_shortcode('tabs', 'tabs_group');
add_shortcode('tab', 'tab');
// this variable will hold your divs
$tabs_divs = '';
$tab_count=0;
function tabs_group( $atts, $content = null ) {
    global $tabs_divs;
    global $tab_count;
    
    $defaults = array();
    extract( shortcode_atts( $defaults, $atts ) );
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
  //  $tab_count=count($tab_titles);
    // reset divs
    $tabs_divs = '';
    $output='';
    $output.='<div class="tab"><div>';
    $output.= '<ul id="tabslist_navs" class="nav nav-tabs tab-in"';

    $output.='>'.do_shortcode($content).'</ul>';
    $output.= '<div class="tab-content">'.$tabs_divs.'</div></div></div>';

    return $output;  
}  


function tab($atts, $content = null) {  
    global $tabs_divs;
    global $tab_count;
   extract(shortcode_atts(array(
        'title' => '',
        'state'=>'' 
    ), $atts));  
   $output = '';
   if($state){
   $output.='<li class="'.$state.'"><a href="#tab'.$tab_count.'" data-toggle="tab">'.$title.'</a></li>';
   }else{
       $output.='<li><a href="#tab'.$tab_count.'" data-toggle="tab">'.$title.'</a></li>';
   }
    $tabs_divs.= '<div class="tab-pane tab-inner '.$state.'" id="tab'.$tab_count.'">'.do_shortcode($content).'</div>';
    $tab_count=$tab_count+1;
    return $output;
}
 ?>