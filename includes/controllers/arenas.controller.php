<?php

/* This controller renders arenas */
class ArenasController {
	public $msgtxt = "";
	public function handleRequest() {
		try {
			switch ($_SERVER ['REQUEST_METHOD']) {
				case 'GET' :
					$folder = $_GET ['home'];
					$baseInfo = CupInfo::getBaseInfo ( $folder );
					$settings = Settings::getSettings ( $folder );
					$menuItems = UserPages::getMenuItems ( $folder );
					$arenas = Arenas::getArenas ( $folder );
					render ( 'arenas', array (
							'msgtxt' => $this->msgtxt,
							'baseInfo' => $baseInfo,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'arenas' => $arenas 
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