<?php

/* This controller renders a single user page */
class UserPageController {
	public $msgtxt = "";
	public function handleRequest() {
		try {
			switch ($_SERVER ['REQUEST_METHOD']) {
				case 'GET' :
					$folder = $_GET ['home'];
					$baseInfo = CupInfo::getBaseInfo ( $folder );
					$settings = Settings::getSettings ( $folder );
					$menuItems = UserPages::getMenuItems ( $folder );
					$scope = $_GET ['scope'];
					$page = UserPages::getPage ( $folder, $scope );
					render ( 'userpage', array (
							'msgtxt' => $this->msgtxt,
							'baseInfo' => $baseInfo,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'page' => $page
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
	