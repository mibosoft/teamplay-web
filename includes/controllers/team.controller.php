<?php

/* This controller renders a single team */
class TeamController
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
					$teamName = $_GET['name'];

					$scope = $_GET['scope'];
					// Strip group number into a variable holding class nr
					if (strpos($scope, '-')) {
						$class = substr($scope, 0, strcspn($scope, '-'));
					} else {
						$class = $scope;
					}
					// 210804: Want to show all games even if the teams plays against a team in another group					
					//					$games = Games::getGamesTeam ( $folder, $scope, $teamName );
					$games = Games::getGamesTeam($folder, $class, $teamName);
					$team = Teams::getTeams($folder, $scope, $teamName);
					$players = people::getPlayers($folder, $scope, $teamName);
					$leaders = people::getLeaders($folder, $scope, $teamName);
					$title = $teamName . " " . $scope;
					render('team', array(
						'msgtxt' => $this->msgtxt,
						'baseInfo' => $baseInfo,
						'settings' => $settings,
						'menuItems' => $menuItems,
						'title' => $title,
						'team' => $team,
						'players' => $players,
						'leaders' => $leaders,
						'games' => $games
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
