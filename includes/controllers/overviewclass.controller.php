<?php

/* This controller renders class overview */
class OverviewClassController {
	public $msgtxt = "";
	public function handleRequest() {
		try {
			switch ($_SERVER ['REQUEST_METHOD']) {
				case 'GET' :
					$folder = $_GET ['home'];
					$baseInfo = CupInfo::getBaseInfo ( $folder );
					$settings = Settings::getSettings ( $folder );
					$menuItems = UserPages::getMenuItems ( $folder );

					if (! empty ( $settings ) and ($settings [0]->value5 == 0 or $settings [0]->value9 == 0)) {
					render ( 'message', array (
								'baseInfo' => $baseInfo,
								'settings' => $settings,
								'menuItems' => $menuItems,
								'message' => S_EJPUB
						) );
						break;
					}
					
					$scope = $_GET ['scope'];
					$classes = Classes::getClasses ( $folder, $scope );
						
					$games = Games::getGamesClass ( $folder, $scope );
					$count = count($games);
					render ( 'overviewclass', array (
							'msgtxt' => $this->msgtxt,
							'baseInfo' => $baseInfo,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'classes' => $classes,
							'games' => $games, 
					        'count' => $count
					) );
					
					break;
				case 'POST' :
					header ( 'Location: ' . '?home' );
					exit ();
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
	