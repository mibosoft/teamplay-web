<?php
class Settings
{
	public static function getSettings($folder)
	{
		global $baseUrl;

		$restCmd = "rest/settings/$folder";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);

		//		return simplexml_load_file ( $baseUrl . $folder . '/installn.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
	}
}
