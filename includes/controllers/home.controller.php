<?php

/* This controller renders the home page */
class HomeController {
	public $msgtxt = "";
	public function handleRequest() {
		try {
			switch ($_SERVER ['REQUEST_METHOD']) {
				case 'GET' :
					$folder = $_GET ['home'];
					$baseInfo = CupInfo::getBaseInfo ( $folder );
					$settings = Settings::getSettings ( $folder );
					$menuItems = UserPages::getMenuItems ( $folder );
					
					if ($GLOBALS ['layout'] == 1) {
						if ($settings [0]->value3 == 0) {
							$layoutfile = "home";
						} else {
							$layoutfile = "homewide";
						}
						$classes = Classes::getClasses ( $folder, "" );
						$news = News::getNews ( $folder );
						render ( $layoutfile, array (
								'msgtxt' => $this->msgtxt,
								'baseInfo' => $baseInfo,
								'classes' => $classes,
								'settings' => $settings,
								'menuItems' => $menuItems,
								'news' => $news 
						) );
					} else {
						// $GLOBALS ['layout'] = 2;
						$classes = Classes::getClasses ( $folder, "all" );
						render ( 'overview', array (
								'msgtxt' => $this->msgtxt,
								'baseInfo' => $baseInfo,
								'settings' => $settings,
								'classes' => $classes 
						) );
					}
				
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
	