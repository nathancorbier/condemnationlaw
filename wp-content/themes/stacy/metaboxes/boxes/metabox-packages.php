<?php
   global $url_path;
  $prefix = "_computer_";
  
  $config3 = array(
    'id'             => 'packages_meta_box',          // meta box id, unique per meta box
    'title'          => 'Packages',          // meta box title
    'pages'          => array('packages'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'low',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => $url_path          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your 3rd meta box
   */
  $my_meta8 =  new AT_Meta_Box($config3);
  //first field of the group has 'group' => 'start' and last field has 'group' => 'end'
  
  $my_meta8->addText($prefix.'ptitle',array('name'=>'Packages Title '));
  $my_meta8->addText($prefix.'price',array('name'=>'Price'));
  //
  
  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $my_meta8->Finish();
?>