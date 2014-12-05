<?php


// The excerpt based on words
function my_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words).'... ';
}


// The excerpt based on character
function my_string_limit_char($excerpt, $substr=0)
{

	$string = strip_tags(str_replace('...', '...', $excerpt));
	if ($substr>0) {
		$string = substr($string, 0, $substr);
	}
	return $string;
		}


add_action( 'after_setup_theme', 'stacy_setup' );

function wp_add_media_custom($arg,$use_custom_buttons = false ,$value = ""){
    
    $defaults = array(
        'useid' => false ,
        'hidden' => true,
        
        'parent_div_class'=> 'custom-image-upload',
        
        'field_label' => 'upload_image_field_label',        
        'field_name' => 'upload_image_field',
        'field_id' => 'upload_image_field',
        'field_class' => 'upload_image_field',
        
        'upload_button_id' => 'upload_logo_button',
        'upload_button_class' => 'upload_logo_button',
        'upload_button_text' => 'Upload',
        
        'remove_button_id' => 'remove_logo_button',
        'remove_button_class' => 'remove_logo_button',
        'remove_button_text' => 'Remove',
        
        'preview_div_class' => 'preview',
        'preview_div_id' => 'preview',
        
        'height' => '100',
        'width' => '100'
                    );
        $arguments = wp_parse_args($arg,$defaults);
        
        extract($arguments);
    
       // print_r($value);
    
    //$usesep="#",$field_name ="upload_image",$value_target="upload_logo",$button_click="upload_logo_button",$remove_button="remove_logo",$preview_div="preview"
      wp_enqueue_media();
    ?>                                   
   <?php if( ! $use_custom_buttons ): ?>
   <div class="<?php echo $parent_div_class; ?>" id="<?php echo $parent_div_class; ?>">
   
        <input name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" class="<?php echo $field_class; ?>" <?php if($hidden): ?>  type="hidden" <?php else: ?> type="text" <?php endif; ?> value="<?php if ( $value != "") { echo stripslashes($value); }  ?>" />
        
        <input type="button" class="button button-primary <?php echo $upload_button_class; ?>" id="<?php echo $upload_button_id; ?>"  value="<?php echo $upload_button_text; ?>">
        
        <input type="button" class="button button-primary <?php echo $remove_button_class; ?>" id="<?php echo $remove_button_id; ?>" <?php  if ( $value == "") {  ?> disabled="disabled" <?php } ?> value="<?php echo $remove_button_text; ?>">
        
        <div id="<?php echo $preview_div_id; ?>" class="<?php echo $preview_div_class; ?>" style="float: none;">
            <img src="<?php  echo stripslashes($value);  ?>" style="margin: 10px;" width="150" height="100" alt="">
        </div>
        <div style="clear: both;"></div>
    </div>
   <?php endif; ?>
    <?php
        $usesep = ($useid) ? "#" : ".";
        if($useid):
        
         $field_class = $field_id;
         $upload_button_class = $upload_button_id;
         $remove_button_class = $remove_button_id;
         $preview_div_class = $preview_div_id;
            
        endif;  
    ?>
    <script type="text/javascript">

    jQuery(document).ready(function($){
        $('<?php echo $usesep.$remove_button_class; ?>').click(function(e) {
            <?php if(!$useid): ?>
           $(this).parent().find("<?php echo $usesep.$field_class; ?>").val(""); 
           $(this).parent().find("<?php echo $usesep.$preview_div_class; ?> img").attr("src","").fadeOut("slow");
           <?php else: ?>
           $("<?php echo $usesep.$field_class; ?>").val(""); 
           $("<?php echo $usesep.$preview_div_class; ?> img").attr("src","").fadeOut("slow");
           <?php endif; ?>
           $(this).attr("disabled","disabled");
         return false;   
        });
        // Uploading files
var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;

  $('<?php echo $usesep.$upload_button_class; ?>').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = $(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;
    wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
          <?php if(!$useid): ?>
        button.parent().find("<?php echo $usesep.$field_class; ?>").val(attachment.url);
        button.parent().find("<?php echo $usesep.$preview_div_class; ?> img").attr("src",attachment.url).fadeIn("slow");
        button.parent().find("<?php echo $usesep.$remove_button_class; ?>").removeAttr("disabled");
        <?php else: ?>
        $("<?php echo $usesep.$field_class; ?>").val(attachment.url);
        $("<?php echo $usesep.$preview_div_class; ?> img").attr("src",attachment.url).fadeIn("slow");
        $("<?php echo $usesep.$remove_button_class; ?>").removeAttr("disabled");
        <?php endif; ?>
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }

    wp.media.editor.open(button);
    return false;
  });
   /* $('#upload_logo_button').click(function() {
        
        tb_show('Upload a logo', 'media-upload.php?referer=wptuts-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
        return false;
    });
    
    window.send_to_editor = function(html) {
        // html returns a link like this:
        // <a href="{server_uploaded_image_url}"><img src="{server_uploaded_image_url}" alt="" title="" width="" height"" class="alignzone size-full wp-image-125" /></a>
        var image_url = $('img',html).attr('src');
        //alert(html);
        $('#product_preview_song').val(image_url);
        tb_remove();
                 
    }*/  
    
});
        
    </script>
   <?php  
}


// Add Thumb Column
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
// for post and page
add_theme_support('post-thumbnails', array( 'post', 'page' ) );
function fb_AddThumbColumn($cols) {
$cols['thumbnail'] = __('Thumbnail');
return $cols;
}
function fb_AddThumbValue($column_name, $post_id) {
$width = (int) 35;
$height = (int) 35;
if ( 'thumbnail' == $column_name ) {
// thumbnail of WP 2.9
$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
// image from gallery
$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
if ($thumbnail_id)
$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
elseif ($attachments) {
foreach ( $attachments as $attachment_id => $attachment ) {
$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
}
}
if ( isset($thumb) && $thumb ) {
echo $thumb;
} else {
echo __('None');
}
}
}
// for posts
add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
// for pages
add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}


// This theme allows users to set a custom background
add_custom_background();
?>