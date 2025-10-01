<?php
class Classes
{
	public static function getClasses($folder, $scope)
	{
		global $baseUrl;

		$restCmd = "rest/classes/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)
	}
}
