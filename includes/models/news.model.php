<?php
class News
{
	public static function getNews($folder)
	{
		global $baseUrl;

		$restCmd = "rest/news/$folder";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)
		/*		
		return simplexml_load_file ( $baseUrl . $folder . '/nyheter.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
*/
	}
}
