<?php

/* This controller renders the home page */
class PlayerHighlightsController
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
					$baseInfo = CupInfo::getBaseInfo($folder);
					$settings = Settings::getSettings($folder);
					$menuItems = UserPages::getMenuItems($folder);
					$classes = Classes::getClasses($folder, "");
					$playerpoints = PlayerStat::getPlayerHighPoints($folder, $scope);
					$playergoals = PlayerStat::getPlayerHighGoals($folder, $scope);
					$playerassists = PlayerStat::getPlayerHighAssists($folder, $scope);
					render('playerhighlights', array(
						'msgtxt' => $this->msgtxt,
						'settings' => $settings,
						'menuItems' => $menuItems,
						'baseInfo' => $baseInfo,
						'classes' => $classes,
						'playerpoints' => $playerpoints,
						'playergoals' => $playergoals,
						'playerassists' => $playerassists
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
