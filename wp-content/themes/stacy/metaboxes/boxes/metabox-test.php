<?php
   global $url_path;

  $config2 = array(
    'id'             => 'demo_meta_box2',          // meta box id, unique per meta box
    'title'          => 'Advanced Meta Box fields',          // meta box title
    'pages'          => array('post', 'page'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => $url_path          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your 2nd meta box
   */
  $my_meta2 =  new AT_Meta_Box($config2);
  
  /*
   * Add fields to your 2nd meta box
   */
  //add checkboxes list 
  $my_meta2->addCheckboxList($prefix.'CheckboxList_field_id',array('checkboxkey1'=>'checkbox Value1','checkboxkey2'=>'checkbox Value2'),array('name'=> 'My checkbox list ', 'std'=> array('checkboxkey2')));
  //date field
  $my_meta2->addDate($prefix.'date_field_id',array('name'=> 'My Date '));
  //Time field
  $my_meta2->addTime($prefix.'time_field_id',array('name'=> 'My Time '));
  //Color field
  $my_meta2->addColor($prefix.'color_field_id',array('name'=> 'My Color '));
  //wysiwyg field
  $my_meta2->addWysiwyg($prefix.'wysiwyg_field_id',array('name'=> 'My wysiwyg Editor '));
  //taxonomy field
  $my_meta2->addTaxonomy($prefix.'taxonomy_field_id',array('taxonomy' => 'category'),array('name'=> 'My Taxonomy '));
  //posts field
  $my_meta2->addPosts($prefix.'posts_field_id',array('post_type' => 'post'),array('name'=> 'My Posts '));
  //add Code editor field
  $my_meta2->addCode($prefix.'code_field_id',array(
    'name'   => 'Code editor Field', 
    'syntax' => 'php',
    'theme'  => 'light'
  ));
    
  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  $repeater_fields[] = $my_meta2->addText($prefix.'re_text_field_id',array('name'=> 'My Text '),true);
  $repeater_fields[] = $my_meta2->addTextarea($prefix.'re_textarea_field_id',array('name'=> 'My Textarea '),true);
  $repeater_fields[] = $my_meta2->addCheckbox($prefix.'re_checkbox_field_id',array('name'=> 'My Checkbox '),true);
  $repeater_fields[] = $my_meta2->addImage($prefix.'image_field_id',array('name'=> 'My Image '),true);
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $my_meta2->addRepeaterBlock($prefix.'re_',array(
    'inline'   => true, 
    'name'     => 'This is a Repeater Block',
    'fields'   => $repeater_fields, 
    'sortable' => true
  ));
  
  /*
   * To Create a conditinal Block first create an array of fields
   * use the same functions as above but add true as a last param (like the repater block)
   */
  $Conditinal_fields[] = $my_meta2->addText($prefix.'con_text_field_id',array('name'=> 'My Text '),true);
  $Conditinal_fields[] = $my_meta2->addTextarea($prefix.'con_textarea_field_id',array('name'=> 'My Textarea '),true);
  $Conditinal_fields[] = $my_meta2->addCheckbox($prefix.'con_checkbox_field_id',array('name'=> 'My Checkbox '),true);
  $Conditinal_fields[] = $my_meta2->addColor($prefix.'con_color_field_id',array('name'=> 'My color '),true);
  
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $my_meta2->addCondition('conditinal_fields',
      array(
        'name'   => __('Enable conditinal fields? ','mmb'),
        'desc'   => __('<small>Turn ON if you want to enable the <strong>conditinal fields</strong>.</small>','mmb'),
        'fields' => $Conditinal_fields,
        'std'    => false
      ));
  
  /*
   * Don't Forget to Close up the meta box Declaration 
   */
  //Finish Meta Box Declaration 
  $my_meta2->Finish();
?>
