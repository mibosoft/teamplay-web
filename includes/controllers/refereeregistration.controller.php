<?php

/* This controller renders the reg. page */
class RefereeRegistrationController {
	public $msgtxt = "";
	public function handleRequest() {
		try {
			switch ($_SERVER ['REQUEST_METHOD']) {
				case 'GET' :
					$folder = $_GET ['home'];
					$baseInfo = CupInfo::getBaseInfo ( $folder );
					$settings = Settings::getSettings ( $folder );
					$menuItems = UserPages::getMenuItems ( $folder );
					render ( 'iframe', array (
							'pageTitle' => "",
							'url' => $settings [0]->string21 . '/' . $settings [0]->value21 . '/?intresseanmalan!&sprak=' . $GLOBALS ['lang'] . '&',
							'height' => 1800,
							'msgtxt' => $this->msgtxt,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'baseInfo' => $baseInfo 
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
	