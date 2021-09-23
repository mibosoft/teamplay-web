<?php

/* This controller renders the map page */
class MapOverviewController
{
	public $msgtxt = "";
	public function handleRequest()
	{
		try {
			switch ($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					$folder = $_GET['home'];
					$baseInfo = CupInfo::getBaseInfo($folder);
					$settings = Settings::getSettings($folder);
					$menuItems = UserPages::getMenuItems($folder);
					$arenas = Arenas::getArenas($folder);
					$foodplaces = Places::getPlaces($folder, 1);
					$lodgingplaces = Places::getPlaces($folder, 2);
					$otherplaces = Places::getPlaces($folder, 3);
					render('mapoverview', array(
						'msgtxt' => $this->msgtxt,
						'baseInfo' => $baseInfo,
						'settings' => $settings,
						'menuItems' => $menuItems,
						'foodplaces' => $foodplaces,
						'lodgingplaces' => $lodgingplaces,
						'otherplaces' => $otherplaces,
						'arenas' => $arenas
					));

					break;
				default:
			}
		} catch (Exception $e) {
			// Display the error page using the "render()" helper function:
			render('error', array(
				'message' => $e->getMessage()
			));
		}
	}
}
