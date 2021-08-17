<?php

/* This controller renders the home page */
class PlayerStatController {
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
					$playerstat = PlayerStat::getStat($folder, $scope);
					render ( 'playerstatistics', array (
							'msgtxt' => $this->msgtxt,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'baseInfo' => $baseInfo, 
							'classes' => $classes,
							'playerstat' => $playerstat 
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
	