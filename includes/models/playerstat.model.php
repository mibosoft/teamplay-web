<?php
class PlayerStat
{
	public static function getStat($folder, $scope, $team, $sort)
	{
		global $baseUrl;

		if ($sort == "goals") {
			$restCmd = "rest/playerstatsgoals/$folder/$scope/" . str_replace('/', '|', $team);
		}elseif ($sort == "assists"){
			$restCmd = "rest/playerstatsassists/$folder/$scope/" . str_replace('/', '|', $team);
		}elseif ($sort == "goaldiff"){
			$restCmd = "rest/playerstatsgoaldiff/$folder/$scope/" . str_replace('/', '|', $team);
		}else{
			$restCmd = "rest/playerstats/$folder/$scope/" . str_replace('/', '|', $team);
		}

		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)
	}

	public static function getPlayerHighPoints($folder, $scope)
	{
		global $baseUrl;

		$restCmd = "rest/playerhighpoints/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);
	}

	public static function getPlayerHighGoals($folder, $scope)
	{
		global $baseUrl;

		$restCmd = "rest/playerhighgoals/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)
	}

	public static function getPlayerHighAssists($folder, $scope)
	{
		global $baseUrl;

		$restCmd = "rest/playerhighassists/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)
	}
}
