<?php
	function video_player_shortcode($atts){
		$args = shortcode_atts( 
			array(
				'id'   => '-1'
			), 
			$atts
		);
		$id = (int) $args['id'];
		$players = get_option('players');
		$player = $players[$id];
		
		wp_enqueue_script("IScroll4Custom", plugins_url()."/video-player/js/IScroll4Custom.js", array('jquery'),VIDEO_PLAYER_VERSION);
		wp_enqueue_script("Froogaloop2", plugins_url()."/video-player/js/froogaloop.js", array('jquery'),VIDEO_PLAYER_VERSION);
		wp_enqueue_script("THREEx.FullScreen", plugins_url()."/video-player/js/THREEx.FullScreen.js", array('jquery'),VIDEO_PLAYER_VERSION);
		wp_enqueue_script("playlist", plugins_url()."/video-player/js/Playlist.js", array('jquery'),VIDEO_PLAYER_VERSION);
		wp_enqueue_script("readvideo_player", plugins_url()."/video-player/js/videoPlayer.js", array(),VIDEO_PLAYER_VERSION);
		
		wp_enqueue_style( 'video_player_style', plugins_url()."/video-player/css/videoPlayerMain.css" , array(),VIDEO_PLAYER_VERSION);
		wp_enqueue_style( 'video_player_icons', plugins_url()."/video-player/css/font-awesome.css" , array(),VIDEO_PLAYER_VERSION);
		switch( $players[$id]["skinPlayer"] ) {
			case 'Default':
				wp_enqueue_style( 'adv_skin1', plugins_url()."/video-player/css/videoPlayer.theme1.css" , array(),VIDEO_PLAYER_VERSION);
				wp_enqueue_style( 'adv_skin_playlist1', plugins_url()."/video-player/css/videoPlayer.theme1_Playlist.css" , array(),VIDEO_PLAYER_VERSION);
				break;
			case 'Classic':
				wp_enqueue_style( 'adv_skin2', plugins_url()."/video-player/css/videoPlayer.theme2.css" , array(),VIDEO_PLAYER_VERSION);
				wp_enqueue_style( 'adv_skin_playlist2', plugins_url()."/video-player/css/videoPlayer.theme2_Playlist.css" , array(),VIDEO_PLAYER_VERSION);
				break;
			case 'Minimal':
				wp_enqueue_style( 'adv_skin2', plugins_url()."/video-player/css/videoPlayer.theme3.css" , array(),VIDEO_PLAYER_VERSION);
				wp_enqueue_style( 'adv_skin_playlist3', plugins_url()."/video-player/css/videoPlayer.theme3_Playlist.css" , array(),VIDEO_PLAYER_VERSION);
				break;
			case 'Transparent':
				wp_enqueue_style( 'adv_skin2', plugins_url()."/video-player/css/videoPlayer.theme4.css" , array(),VIDEO_PLAYER_VERSION);
				wp_enqueue_style( 'adv_skin_playlist4', plugins_url()."/video-player/css/videoPlayer.theme4_Playlist.css" , array(),VIDEO_PLAYER_VERSION);
				break;
			case 'Silver':
				wp_enqueue_style( 'adv_skin2', plugins_url()."/video-player/css/videoPlayer.theme5.css" , array(),VIDEO_PLAYER_VERSION);
				wp_enqueue_style( 'adv_skin_playlist5', plugins_url()."/video-player/css/videoPlayer.theme5_Playlist.css" , array(),VIDEO_PLAYER_VERSION);
				break;
		}
		
		$player['rootFolder'] = plugins_url()."/video-player/";
		$output = ('<div class="videoplayer" id="'.$id.'" ><div id="options" style="display:none;">'.json_encode($player).'</div></div>');
		return $output;
	}
	add_shortcode('video_player', 'video_player_shortcode');