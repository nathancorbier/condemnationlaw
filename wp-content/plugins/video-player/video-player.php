<?php

	/*
	Plugin Name: Video Player
	Plugin URI: http://codecanyon.net/user/_zac_
	Description: Premium Video Player  
	Version: 1.0
	Author: _zac_
	Author URI: http://codecanyon.net/user/_zac_
	*/

	// define( 'WP_DEBUG', true );
	define('VIDEO_PLAYER_DIR', plugin_dir_url( __FILE__ ));
	define('VIDEO_PLAYER_VERSION', '1.0.0');
	
	function trace_vp($var){
		echo("<pre style='background:#fcc;color:#000;font-size:12px;font-weight:bold'>");
		print_r($var);
		echo("</pre>");
	}

	if(!is_admin()) {
		include("includes/plugin-frontend.php");
	}
	else {
		include("includes/plugin-admin.php");
		register_deactivation_hook( __FILE__, "deactivate_video_player");
		add_filter("plugin_action_links_" . plugin_basename(__FILE__), "video_player_admin_link");
	}
	
	
	function video_player_scripts() {
		/*wp_enqueue_script("IScroll4Custom", plugins_url()."/video-player/js/IScroll4Custom.js", array('jquery'),VIDEO_PLAYER_VERSION);
		wp_enqueue_script("Froogaloop2", plugins_url()."/video-player/js/froogaloop.js", array('jquery'),VIDEO_PLAYER_VERSION);
		wp_enqueue_script("THREEx.FullScreen", plugins_url()."/video-player/js/THREEx.FullScreen.js", array('jquery'),VIDEO_PLAYER_VERSION);
		wp_enqueue_script("playlist", plugins_url()."/video-player/js/Playlist.js", array('jquery'),VIDEO_PLAYER_VERSION);
		wp_enqueue_script("readvideo_player", plugins_url()."/video-player/js/videoPlayer.js", array(),VIDEO_PLAYER_VERSION);
		
		wp_enqueue_style( 'video_player_style', plugins_url()."/video-player/css/videoPlayerMain.css" , array(),VIDEO_PLAYER_VERSION);
		wp_enqueue_style( 'video_player_icons', plugins_url()."/video-player/css/font-awesome.css" , array(),VIDEO_PLAYER_VERSION);*/
		/* wp_enqueue_style( 'video_player_style_theme', plugins_url()."/video-player/css/videoPlayer.theme1.css" , array(),VIDEO_PLAYER_VERSION); */
		/* wp_enqueue_style( 'video_player_style_playlist', plugins_url()."/video-player/css/videoPlayer.theme1_Playlist.css" , array(),VIDEO_PLAYER_VERSION); */
		
		
		//embed script
		wp_enqueue_script("embed", plugins_url()."/video-player/js/embed.js", array('readvideo_player'),VIDEO_PLAYER_VERSION);
	}
	add_action( 'wp_enqueue_scripts', 'video_player_scripts' );
	
	function video_player_admin_scripts() {
		// wp_enqueue_media();
		// wp_enqueue_script("video_player_admin", plugins_url()."/video-player/js/plugin_admin.js", array('jquery','jquery-ui-sortable','jquery-ui-resizable','jquery-ui-selectable','jquery-ui-tabs' ),VIDEO_PLAYER_VERSION);
		// wp_enqueue_style( 'video_player_admin_css', plugins_url()."/video-player/css/player-admin.css",array(), VIDEO_PLAYER_VERSION );
		// wp_enqueue_style( 'jquery-ui-style', plugins_url()."/video-player/css/jquery-ui.css",array(), VIDEO_PLAYER_VERSION );
		// pass $players to javascript
		// wp_localize_script( 'video_player_admin', 'options', json_encode($players[$current_id]) );
	}
	add_action( 'wp_enqueue_scripts', 'video_player_admin_scripts' );
	
	function video_player_admin_link($links) {
		array_unshift($links, '<a href="' . get_admin_url() . 'options-general.php?page=video_player_admin">Admin</a>');
		return $links;
	}
	
	function deactivate_video_player() {
		delete_option("players");
	}