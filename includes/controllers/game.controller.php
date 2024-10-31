<?php

/* This controller renders games */
class GameController
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

					if (!empty($settings) and $settings[0]->value5 == 0) {
						render('message', array(
							'baseInfo' => $baseInfo,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'message' => S_EJPUB
						));
						break;
					}

					$games = Games::getGames($folder, $_GET['gameno']);
					$occasions = Occasions::getOccasions($folder, $_GET['gameno']);
					$homeLineup = Lineups::getLineups($folder, $_GET['gameno'], $games[0]->hemma);
					$awayLineup = Lineups::getLineups($folder, $_GET['gameno'], $games[0]->borta);
					$title = S_MATCHPROTOKOLL;

					// Select view depending on sport
					if ($settings[0]->bool25 == "true") {
						$gameView = "gamegolf";
					} else {
						$gameView = "game";
					}

					render($gameView, array(
						'msgtxt' => $this->msgtxt,
						'baseInfo' => $baseInfo,
						'settings' => $settings,
						'menuItems' => $menuItems,
						'title' => $title,
						'games' => $games,
						'occasions' => $occasions,
						'homelineup' => $homeLineup,
						'awaylineup' => $awayLineup
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
