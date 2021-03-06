<?php

/******************************************************************
/* Inserting (or) Updating the DB Table when edited
******************************************************************/
if($_POST['edited'] == 'true' && check_admin_referer( 'hdwplayer-nonce')) {
	unset($_POST['edited'], $_POST['save'], $_POST['_wpnonce'], $_POST['_wp_http_referer']);
	$video  = $wpdb->get_row($wpdb->prepare("SELECT playlistid FROM ".$table_name." WHERE id=%d",intval(trim($_GET['id']))));
	
	if($_POST['type'] == "youtube"){
		$youtubeID = array();
		preg_match('/https?\:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})/',$_POST['video'],$youtubeID);
		if($_POST['thumb'] == ""){
			$_POST['thumb']     = 'http://img.youtube.com/vi/'.$youtubeID[1].'/default.jpg';
		}
		if($_POST['preview'] == ""){
			$_POST['preview']   = 'http://img.youtube.com/vi/'.$youtubeID[1].'/sddefault.jpg';
		}
	}
	
	if($video->playlistid != $_POST['playlistid']){
		$lorder  = $wpdb->get_row($wpdb->prepare("SELECT MAX(ordering) As max FROM ".$table_name." WHERE playlistid=%d",$_POST['playlistid']));
		if($lorder->max != '')
		{
			$_POST['ordering'] = $lorder->max+1;
		}else{
			$_POST['ordering'] = '1';
		}
	}
	$format = array('%s','%s','%s','%s','%s','%s','%d');
	$wpdb->update($table_name, $_POST, array('id' => intval($_GET['id'])),$format);
	echo '<script>window.location="?page=videos";</script>';
}

/******************************************************************
/* Getting Input from the DB Table
******************************************************************/
$data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id=%d",intval($_GET['id'])));
	
?>
<div class="wrap">
  <br />
  <?php _e( "HDW Player is the Fastest Growing Online Video Platform for your Websites. For More visit <a href='http://hdwplayer.com'>HDW Player</a>." ); ?>
  <br />
  <br />
  <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" onsubmit="return webplayer_validate();">
  	<?php wp_nonce_field('hdwplayer-nonce'); ?>
    <?php  echo "<h3>" . __( 'Video Settings' ) . "</h3>"; ?>
    <table cellpadding="0" cellspacing="10">
      <tr>
        <td width="30%"><?php _e("Video Title " ); ?></td>
        <td><input type="text" id="title" name="title" value="<?php echo $data->title; ?>" size="50"></td>
      </tr>
      <tr>
        <td class="key">Video type</td>
        <td><select id="type" name="type" onchange="javascript:changeType(this.options[this.selectedIndex].id);">
            <option value="video" id="video" >Direct URL</option>
            <option value="youtube" id="youtube" >Youtube Videos</option>
            <option value="dailymotion" id="dailymotion" >Dailymotion Videos</option>
            <option value="vimeo" id="vimeo" >Vimeo Videos</option>
            <option value="rtmp" id="rtmp" >RTMP Streams</option>
            <option value="highwinds" id="highwinds" >SMIL</option>
            <option value="lighttpd" id="lighttpd" >Lighttpd Videos</option>
            <option value="bitgravity" id="bitgravity" >Bitgravity Videos</option>
          </select><span id="features" style="margin-left: 15px; color: rgb(218, 41, 233); font-weight:bold;"></span>
          <?php echo '<script>document.getElementById("'.$data->type.'").selected="selected"</script>'; ?> </td>
      </tr>
      <tr id="__video">
        <td width="30%"><?php _e("Video URL " ); ?></td>
        <td><input type="text" id="_video" name="video" value="<?php echo $data->video; ?>" size="50"></td>
      </tr>
      <tr id="_hdvideo">
        <td width="30%"><?php _e("HD Video URL" ); ?></td>
        <td><input type="text" id="hdvideo" name="hdvideo" value="<?php echo $data->hdvideo; ?>" size="50"></td>
      </tr>
      <tr id="_preview">
        <td><?php _e("Preview Image" ); ?></td>
        <td><input type="text" id="preview" name="preview" value="<?php echo $data->preview; ?>" size="50"></td>
      </tr>
       <tr id="_thumb">
        <td><?php _e("Thumb Image" ); ?></td>
        <td><input type="text" id="thumb" name="thumb" value="<?php echo $data->thumb; ?>" size="50"></td>
      </tr>
      <tr>
        <td class="key"><?php _e("Choose your Playlist" ); ?></td>
        <td><select id="playlistid" name="playlistid" >
            <option value="0" id="0" >None</option>
            <?php
            $k=count( $playlist);
            for ($i=0; $i < $k; $i++)
            {
               $row = $playlist[$i];
            ?>
            <option value="<?php echo $row->id; ?>" id="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
            <?php } ?>
           </select><?php echo '<script>document.getElementById("'.$data->playlistid.'").selected="selected"</script>'; ?>
        </td>
      </tr>
    </table>
    <br />
    <input type="hidden" name="edited" value="true" />
    <input type="submit" class="button-primary" name="save" value="<?php _e("Save Options" ); ?>" />
    &nbsp; <a href="?page=videos" class="button-secondary" title="cancel">
    <?php _e("Cancel" ); ?>
    </a>
  </form>
</div>
<script type="text/javascript">

 changeType(<?php echo "'".$data->type."'"; ?>);

 function changeType(typ) {
	document.getElementById('features').style.display="none";
	document.getElementById('__video').style.display="none";
	document.getElementById('_hdvideo').style.display="none";
	document.getElementById('_thumb').style.display="none";
	document.getElementById('_preview').style.display="none";
	switch(typ) {
		case 'dailymotion' :
			document.getElementById('features').style.display="";
			document.getElementById('features').innerHTML="Pro Features";
			break;
		case 'vimeo' :
		case 'rtmp' :
		case 'highwinds' :
		case 'lighttpd' :
		case 'bitgravity' :
			document.getElementById('features').style.display="";
			document.getElementById('features').innerHTML="Premium Features";
			break;
		case 'youtube' :
			document.getElementById('__video').style.display="";
			document.getElementById('_thumb').style.display="";
			document.getElementById('_preview').style.display="";
			break;
		case 'video' :
			document.getElementById('__video').style.display="";
			document.getElementById('_hdvideo').style.display="";
			document.getElementById('_thumb').style.display="";
			document.getElementById('_preview').style.display="";
			break;
		default:
			
	}
 }

function webplayer_validate() {
	var type            = document.getElementById("type");
    var method          = type.options[type.selectedIndex].value;
	var videoExtensions = ['flv', 'mp4' , '3g2', '3gp', 'aac', 'f4b', 'f4p', 'f4v', 'm4a', 'm4v', 'mov', 'sdp', 'vp6', 'smil'];
	var imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
	var isAllowed       = true;
	
	if(document.getElementById('title').value == '') {
		alert("Warning! You must Provide a Title for the Video.");
		return false;
	}
	
	if(document.getElementById('video').value == '') {
		alert("Warning! You have not added any Video to the Player.");
		return false;
	}
	
	if(method == 'video' || method == 'smil' || method == 'lighttpd') {
		isAllowed = checkExtension('VIDEO', document.getElementById('_video').value, videoExtensions);
		if(isAllowed == false) 	return false;
		
		if(document.getElementById('hdvideo').value) {
			isAllowed = checkExtension('VIDEO', document.getElementById('hdvideo').value, videoExtensions);
			if(isAllowed == false) 	return false;
		}
	}
	
	if(document.getElementById('preview').value) {
		isAllowed = checkExtension('IMAGE', document.getElementById('preview').value, imageExtensions);
		if(isAllowed == false) 	return false;
	}
	
	if(document.getElementById('thumb').value) {
		isAllowed = checkExtension('IMAGE', document.getElementById('thumb').value, imageExtensions);
		if(isAllowed == false) 	return false;
	}
	
	return true;
	
}

function checkExtension(type, filePath, validExtensions) {
    var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();

    for(var i = 0; i < validExtensions.length; i++) {
        if(ext == validExtensions[i]) return true;
    }

    alert(type + ' :   The file extension ' + ext.toUpperCase() + ' is not allowed!');
    return false;	
 }
</script>