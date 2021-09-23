<?php
class News
{
	public static function getNews($folder)
	{
		global $baseUrl;

		$restCmd = "rest/news/$folder";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);
		/*		
		return simplexml_load_file ( $baseUrl . $folder . '/nyheter.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
*/
	}
}
