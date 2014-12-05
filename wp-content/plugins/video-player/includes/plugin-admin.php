<?php
	$players = get_option("players");

	if(!$players){
		$players = array();
		add_option("players", $players);
	}

	function read_video_player_admin_init(){

	}
	add_action("admin_init", "read_video_player_admin_init");
	
	function read_video_player_admin_menu(){
		add_options_page("Video Player Admin", "Video Player", "manage_options", "video_player_admin", "video_player_admin"); 
	}
	add_action("admin_menu", "read_video_player_admin_menu");
	
	//options page
	function video_player_admin()
    {
		$current_action = "";
		// handle action from url
		if (isset($_GET['action']) ) {
			$current_action = $_GET['action'];
		}

		$players = get_option("players");
		if (isset($_GET['playerId']) )
		{
			$current_id = $_GET['playerId'];
			$player = $players[$current_id];
			$videos = $player["videos"];
		}
		// $current_id = $_GET['playerId'];
		// $player = $players[$current_id];
		// $videos = $player["videos"];
		
		// if(isset($current_action))
			// trace("isset");
		// else 
			// trace("notset");
		switch( $current_action ) {
		
			case 'edit':
				include("edit-player.php");
				break;
				
			case 'delete':
				//delete vplayer with id from url
				unset($players[$current_id]);
				update_option("players", $players);
				include("players.php");
				break;
				
			case 'add_new':
				//generate ID 
				$new_id = 0;
				$highest_id = 0;
				foreach ($players as $player) {
					$player_id = $player["id"];
					if($player_id > $highest_id) {
						$highest_id = $player_id;
					}
				}
				$current_id = $highest_id + 1;
				//create new vplayer 
				$vplayer = array(	'id' => $current_id, 
										"name" => "Player " . $current_id,
										"videos" => array()
						);
				$players[$current_id] = $vplayer;
				update_option("players", $players);
				include("edit-player.php");
				break;
				
			case 'save_settings':
				$new = array_merge($player, $_POST);
				$players[$current_id] = $new;
				//reset indexes because of sortable videos can be rearranged
				$oldvideos = $players[$current_id]["videos"];
				$newvideos = array();
				$index = 0;
				foreach($oldvideos as $p){
					$newvideos[$index] = $p;
					$index++;
				}
				$players[$current_id]["videos"] = $newvideos;

				//convert values to boolean and integer where needed
				$formatted = array_map("cast", $players[$current_id]);
				// stripslashes($players[$current_id]["embedCode"]);
					// trace($players[$current_id]["embedCode"]);
					// trace (stripslashes($players[$current_id]["embedCode"]));
				
				$players[$current_id] = $formatted;
				//for each video
				for($i = 0; $i < count($players[$current_id]["videos"]); $i++){
					$p = $players[$current_id]["videos"][$i];
				}
				update_option("players", $players);
				include("edit-player.php");
				break;

			default:
				include("players.php");
				break;
				
		}
    }
	
	function cast($n)
	{
		if($n === "true") {
			return true;
		}else if ($n === "false"){
			return false;
		}else if(is_numeric($n)){
			// return (int)$n;
			return floatval($n);
		}else{
			return $n;
		}
	}