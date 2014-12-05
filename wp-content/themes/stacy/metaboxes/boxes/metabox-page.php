<?php
   global $url_path;
  $prefix = "_stacy_";
  
  $config3 = array(
    'id'             => 'page_meta_box',          // meta box id, unique per meta box
    'title'          => 'Page Meta Box',          // meta box title
    'pages'          => array('page','testimonial','staff','news_feed','news','state-information','attorney'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'low',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => $url_path          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your 3rd meta box
   */
  $page =  new AT_Meta_Box($config3);
  //first field of the group has 'group' => 'start' and last field has 'group' => 'end'
  
  $page->addCheckbox($prefix.'wnews',array('name'=>'Show Bottome Widgets'));
  $page->addCheckbox($prefix.'bimage',array('name'=>'Dispay Feature Image on Banner'));
  
  
 
  //
  
  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $page->Finish();
?>