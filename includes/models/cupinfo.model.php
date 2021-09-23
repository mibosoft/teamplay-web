<?php
class CupInfo
{
	public static function getBaseInfo($folder)
	{
		global $baseUrl;

		$restCmd = "rest/cupinfo/$folder";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);
	}
}
