<?php
    global $url_path;
  $prefix = "_groupped_";
  
  $config3 = array(
    'id'             => 'demo_meta_box3',          // meta box id, unique per meta box
    'title'          => 'Groupped Meta Box fields',          // meta box title
    'pages'          => array('post', 'page'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'low',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => $url_path          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your 3rd meta box
   */
  $my_meta3 =  new AT_Meta_Box($config3);
  //first field of the group has 'group' => 'start' and last field has 'group' => 'end'
  
  //text field
  $my_meta3->addText($prefix.'text_field_id',array('name'=> 'My Text ','group' => 'start'));
  //textarea field
  $my_meta3->addTextarea($prefix.'textarea_field_id',array('name'=> 'My Textarea '));
  //checkbox field
  $my_meta3->addCheckbox($prefix.'checkbox_field_id',array('name'=> 'My Checkbox '));
  //select field
  $my_meta3->addSelect($prefix.'select_field_id',array('selectkey1'=>'Select Value1','selectkey2'=>'Select Value2'),array('name'=> 'My select ', 'std'=> array('selectkey2')));
  //radio field
  $my_meta3->addRadio($prefix.'radio_field_id',array('radiokey1'=>'Radio Value1','radiokey2'=>'Radio Value2'),array('name'=> 'My Radio Filed', 'std'=> array('radionkey2'),'group' => 'end'));

  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $my_meta3->Finish();
  
?>
