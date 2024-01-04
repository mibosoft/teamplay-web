<?php
class PlayerStat
{
	public static function getStat($folder, $scope, $team)
	{
		global $baseUrl;

		$restCmd = "rest/playerstats/$folder/$scope/" . str_replace('/', '|', $team);
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);
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

		return json_decode($content, false);
	}

	public static function getPlayerHighAssists($folder, $scope)
	{
		global $baseUrl;

		$restCmd = "rest/playerhighassists/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);
	}
}
