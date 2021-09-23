<?php

/* This controller renders the home page */
class HistoryController
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
					//http://localhost/tpweb/eclipse/cup/?home=drakcupen/15&layout=2&overview
					render('iframe', array(
						'pageTitle' => S_RESULTAT . ' 20' . $_GET['year'],
						'url' => '?home=' . $_GET['history'] . '/' . $_GET['year'] . '&layout=2&overview',
						'height' => 9999,
						'msgtxt' => $this->msgtxt,
						'settings' => $settings,
						'menuItems' => $menuItems,
						'baseInfo' => $baseInfo
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
