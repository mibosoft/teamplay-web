<?php

/* This controller renders games */
class GamesController {
	public $msgtxt = "";
	public function handleRequest() {
		try {
			switch ($_SERVER ['REQUEST_METHOD']) {
				case 'GET' :
					$folder = $_GET ['home'];
					$baseInfo = CupInfo::getBaseInfo ( $folder );
					$settings = Settings::getSettings ( $folder );
					$menuItems = UserPages::getMenuItems ( $folder );
					
					if (! empty ( $settings ) and $settings [0]->value5 == 0) {
						render ( 'message', array (
								'baseInfo' => $baseInfo,
								'settings' => $settings,
								'menuItems' => $menuItems,
								'message' => S_EJPUB 
						) );
						break;
					}
					
					$classes = Classes::getClasses ( $folder, "" );
					$scope = $_GET ['scope'];
					$hideNavpills = false;
					if (isset ( $_GET ['arena'] )) {
						$games = Games::getGamesArena ( $folder, $_GET ['arena'], $_GET ['field'] );
						$hideNavpills = true;
						$title = S_MATCHER . " " . $_GET ['arena'] . " " . $_GET ['field'];
					} elseif (isset ( $_GET ['team'] )) {
						$games = Games::getGamesTeam ( $folder, $scope, $_GET ['team'] );
						$title = S_MATCHER . " " . $_GET ['team'] . " " . $scope;
					} elseif (isset ( $_GET ['wholeclass'] )) {
						$games = Games::getGamesClass ( $folder, $scope );
						$title = S_MATCHER;
					} elseif (isset ( $_GET ['latestgames'] )) {
						$games = Games::getGamesLatest ( $folder );
						$hideNavpills = true;
						$title = S_SENASTERESULTAT;
					} elseif (isset ( $_GET ['unplayedgames'] )) {
						$games = Games::getGamesUnplayed ( $folder );
						$hideNavpills = true;
						$title = S_OSPELADEMATCHER;
					} elseif (isset ( $_GET ['bookedgames'] )) {
					    $games = Games::getGames ( $folder, "booked" );
					    $hideNavpills = true;
					    $title = S_BOKADEMATCHER;
					} else {
						$games = Games::getGames ( $folder, $scope );
						$title = S_MATCHER;
						// $title = $scope == "all" ? S_SAMTLIGAMATCHER : $scope;
					}
					
					$count = count($games);
					
					render ( 'games', array (
							'msgtxt' => $this->msgtxt,
							'baseInfo' => $baseInfo,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'title' => $title,
							'classes' => $classes,
							'count' => $count,
							'hideNavpills' => $hideNavpills,
							'games' => $games 
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
	