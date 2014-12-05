<div class="wrap">
	<h2>Manage Players
		<a href='<?php echo admin_url( "admin.php?page=video_player_admin&action=add_new" ); ?>' class='add-new-h2'>Add New</a>
	</h2>
	
	<table class='players-table wp-list-table widefat fixed'>
		<thead>
			<tr>
				<th width='5%'>ID</th>
				<th width='50%'>Name</th>
				<th width='30%'>Actions</th>
				<th width='20%'>Shortcode</th>						
			</tr>
		</thead>
		<tbody>
			<?php 
				
				$players = get_option("players");

				if (count($players) == 0) {
					echo '<tr>'.
							 '<td colspan="100%">No players found.</td>'.
						 '</tr>';
				} else {
					$player_display_name;
					foreach ($players as $player) {
						$player_display_name = $player["name"];
						if(!$player_display_name) {
							$player_display_name = 'Player #' . $player["id"] . ' (no name)';
						}
						echo '<tr>'.
								'<td>' . $player["id"] . '</td>'.								
								'<td>' . '<a href="' . admin_url('admin.php?page=video_player_admin&action=edit&playerId=' . $player["id"]) . '" title="Edit">'.$player_display_name.'</a>' . '</td>'.
								'<td>' . '<a href="' . admin_url('admin.php?page=video_player_admin&action=edit&playerId=' . $player["id"]) . '" title="Edit this player">Edit</a> | '.									  
										 '<a href="' . admin_url('admin.php?page=video_player_admin&action=delete&playerId='  . $player["id"]) . '" title="Delete player permanently" >Delete</a>'.'</td>'.
								'<td>[video_player  id="' . $player["id"] . '"]</td>'.															
							'</tr>';
					}
				}
			?>
		</tbody>		 
	</table>

	<p>			
		<a class='button-primary' href='<?php echo admin_url( "admin.php?page=video_player_admin&action=add_new" ); ?>'>Create New Player</a>       
	</p>    
	
	<p></p>
</div>