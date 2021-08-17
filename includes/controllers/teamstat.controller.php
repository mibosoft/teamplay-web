<?php

/* This controller renders the home page */
class TeamStatController {
	public $msgtxt = "";
	public function handleRequest() {
		try {
			switch ($_SERVER ['REQUEST_METHOD']) {
				case 'GET' :
					$folder = $_GET ['home'];
					$scope = $_GET ['scope'];
					$baseInfo = CupInfo::getBaseInfo ( $folder );
					$settings = Settings::getSettings ( $folder );
					$menuItems = UserPages::getMenuItems ( $folder );
					$classes = Classes::getClasses ( $folder, "" );
					$teams = Teams::getTeams ( $folder, "all", "" );
					$teamstat = TeamStat::getStat($folder, $scope);
					render ( 'teamstatistics', array (
							'msgtxt' => $this->msgtxt,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'baseInfo' => $baseInfo, 
							'classes' => $classes,
							'teams' => $teams, 
							'teamstat' => $teamstat 
					) );
					
					break;
				default :
			}
		} catch ( Exception $e ) {
			// Display the error page using the "render()" helper function:
			render ( 'error', array (
					'message' => $e->getMessage () 
			) );
		}
	}
}

?>
	