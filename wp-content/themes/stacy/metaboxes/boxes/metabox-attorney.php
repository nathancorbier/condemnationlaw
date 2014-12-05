<?php
   global $url_path;
  $prefix = "_stacy_";
  
  $config3 = array(
    'id'             => 'attorney_meta_box',          // meta box id, unique per meta box
    'title'          => 'Attorney',          // meta box title
    'pages'          => array('attorney'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'low',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => $url_path          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your 3rd meta box
   */
  $attorney =  new AT_Meta_Box($config3);
  //first field of the group has 'group' => 'start' and last field has 'group' => 'end'
  
  $attorney->addText($prefix.'email',array('name'=>'Email Id'));
  $attorney->addText($prefix.'phn',array('name'=>'Phone Number'));
 
  //
  
  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $attorney->Finish();
?>