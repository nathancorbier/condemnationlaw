<?php
    global $themename, $shortname, $options;
    $i=0;
?>
<div class="wrap rm_wrap" >

<div id="icon-options-theme" class="icon32">
<img src="<?php echo get_template_directory_uri()."/theme-options/images/admin-icon-settings.gif" ?>" height="32" width="32" align="top" alt="<?php echo $themename; ?> Settings" >
</div>

<h2><?php echo $themename; ?> Theme Settings</h2>

<div id="message" class="none"><p></p></div>
<p style="clear: both">To easily use the <?php echo $themename;?> theme, you can use the Settings below.</p>

<div class="rm_opts" >
<form id="rm_form_settings" method="post">
<div class="submit">
   
    <input class="button button-primary" type="submit" value="Save Setings" />
     <img src="<?php echo get_template_directory_uri()."/theme-options/images/ajax-loader.gif" ?>" style="display: none;margin-left: 10px;" class="loader-rm" alt="">
      <input type="hidden" name="action" value="save" />
  </div>
<div id="vtab"> 
<ul class="tabul"> 
  <?php foreach ($options as $value) { ?>
  
  <?php if($value['type'] == "section"){ ?>
      
       <li class="rm_item" id="<?php echo $value['id']; ?>"> <img src="<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>" height="35" width="35" align="left"><span class="rm_section_title"> <?php echo $value['name']; ?> </span></li>
       
      <?php 
      }
  }  ?>
</ul>
<?php foreach ($options as $value) { ?> 
 <?php      
    switch ( $value['type'] ) {
     
    case "open":
    ?>
  <?php break;
     
    case "close":
    ?>
  </div>
  </div>

  <?php break;
     
    case "title":
    ?>

  <?php break;
     
    case 'text':
    $class = ($value['class']) ? "class='".$value['class']."'" : ""
    ?>
  <div class="rm_input rm_text">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <input name="<?php echo $value['id']; ?>" <?php echo $class; ?> id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
    <small><?php echo $value['desc']; ?></small>
    <div class="clearfix"></div>
  </div>
  <?php
    break;
    case 'upload':
    ?>
  <div class="rm_input rm_upload">

     
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <input name="<?php echo $value['id']; ?>" id="upload_logo" class="upload_logo" type="hidden" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
    <input type="button" class="button button-primary upload_logo_button" id="upload_logo_button"  value="Upload">
    
    <input type="button" class="button button-primary remove_logo" id="remove_logo" <?php  if ( get_settings( $value['id'] ) == "") {  ?> disabled="disabled" <?php } ?> value="Remove">
     <small><?php echo $value['desc']; ?></small>
    <div id="preview" style="float: none" class="preview">
    <img src="<?php  echo stripslashes(get_settings( $value['id'])  );  ?>"  style="margin: 10px;max-width: 100%;" alt="">
   <div class="clearfix"></div>
    </div>

   <?php

   $arg = array(
        
        
        'field_id' => 'upload_logo',
        'field_class' => 'upload_logo',
        
        'upload_button_id' => 'upload_logo_button',
        'upload_button_class' => 'upload_logo_button',

        
        'remove_button_id' => 'remove_logo',
        'remove_button_class' => 'remove_logo',

        
        );
        
        wp_add_media_custom($arg,true);
       
         
       //wp_add_media_custom($arg ,false,get_settings( $value['id'] ));
       
    
   ?>
    
    <div class="clearfix"></div>
  </div>
  <?php
    break;  
    case 'textarea':
    ?>
  <div class="rm_input rm_textarea">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?>
</textarea>
    <small><?php echo $value['desc']; ?></small>
    <div class="clearfix"></div>
  </div>
  <?php
    break;
     
    case 'select':
    ?>
  <div class="rm_input rm_select">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="chosen-select">
      <?php foreach ($value['options'] as $k => $option) { ?>
      <?php if($value['associative'] == true):?>
      <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?> value="<?php echo $k; ?>" ><?php echo $option; ?></option>
      <?php else: ?>
      <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>
      <?php endif; ?>
      <?php } ?>
    </select>
    <small><?php echo $value['desc']; ?></small>
    <div class="clearfix"></div>
  </div>
  <?php
    break;
     
    case "checkbox":
    ?>

  <div class="rm_input rm_checkbox">
  
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
    
    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
    
    <small><?php echo $value['desc']; ?></small>
    <div class="clearfix"></div>
  </div>
  <?php break; 
    case "section":
    
    $i++;
    
    ?>
  <div class="rm_section" id="<?php echo $value['id']; ?>">
  <div class="rm_options">
  <?php break;
     
    }
    }
    ?>
 
  
</div>
<div class="submit">
   
    <input class="button button-primary" type="submit" value="Save Setings" />
     <img src="<?php echo get_template_directory_uri()."/theme-options/images/ajax-loader.gif" ?>" style="display: none;margin-left: 10px;" class="loader-rm" alt="">
      <input type="hidden" name="action" value="save" />
  </div>
</form>
</div>