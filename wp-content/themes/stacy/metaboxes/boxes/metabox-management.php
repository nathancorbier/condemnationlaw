<?php
  global $metabox_path,$metabox_uri,$prefix,$url_path;
  
  require_once($metabox_path."meta-box-class/my-meta-box-class.php");
  //require_once $metabox_path . 'usage.php';
  
  //require_once $metabox_path . 'meta_box.php';
  
  require_once $metabox_path . 'metabox-functions.php';
  
  $url_path =  $metabox_uri."/meta-box-class";
  $prefix = 'ba_';
   //include the main class file
 //Add Metaboxes
   $boxes = array(
   
       /* array(
            'folder' => 'boxes',
            'slug' => 'metabox',
            'name' => 'test'
        ),*/ 
        array(
            'folder' => 'boxes',
            'slug' => 'metabox',
            'name' => 'testimonial'
        ), 
          array(
            'folder' => 'boxes',
            'slug' => 'metabox',
            'name' => 'packages'
        ),
        array(
            'folder' => 'boxes',
            'slug' => 'metabox',
            'name' => 'news'
        ), 
          array(
            'folder' => 'boxes',
            'slug' => 'metabox',
            'name' => 'attorney'
        ),    
        array(
            'folder' => 'boxes',
            'slug' => 'metabox',
            'name' => 'page'
        ),              
        array(
            'folder' => 'boxes',
            'slug' => 'metabox',
            'name' => 'news'
        ),              
                      
   );  
  add_my_meta_boxes($boxes);

?>