<?php

/* This controller renders games */
class TeamsController
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

					if (!empty($settings) and $settings[0]->value1 == 0) {
						render('message', array(
							'baseInfo' => $baseInfo,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'message' => S_EJPUB
						));
						break;
					}

					$scope = $_GET['scope'];
					$classes = Classes::getClasses($folder, "");
					$teams = Teams::getTeams($folder, $scope, "");

					$count = count($teams);

					$title = $scope == "all" ? S_SAMTLIGALAG : $scope;
					render('teams', array(
						'msgtxt' => $this->msgtxt,
						'baseInfo' => $baseInfo,
						'settings' => $settings,
						'menuItems' => $menuItems,
						'title' => $title,
						'classes' => $classes,
						'count' => $count,
						'teams' => $teams
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
