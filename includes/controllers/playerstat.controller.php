<?php

/* This controller renders the home page */
class PlayerStatController
{
	public $msgtxt = "";
	public function handleRequest()
	{
		try {
			switch ($_SERVER['REQUEST_METHOD']) {
				case 'GET':
					$folder = $_GET['home'];
					$scope = $_GET['scope'];
					$team = $_GET['team'];
					$sort = $_GET['sort'];
					$baseInfo = CupInfo::getBaseInfo($folder);
					$settings = Settings::getSettings($folder);
					$menuItems = UserPages::getMenuItems($folder);
					$classes = Classes::getClasses($folder, "");

					// Select view depending on sport
					if ($settings[0]->bool25 == "true") {
						$playerstatView = "playerstatisticsgolf";
					} else {
						$playerstatView = "playerstatistics";
					}

					$playerstat = PlayerStat::getStat($folder, $scope, $team, $sort);
					render($playerstatView, array(
						'msgtxt' => $this->msgtxt,
						'settings' => $settings,
						'menuItems' => $menuItems,
						'baseInfo' => $baseInfo,
						'classes' => $classes,
						'playerstat' => $playerstat
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
