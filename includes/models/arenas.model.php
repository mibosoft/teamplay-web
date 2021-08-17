<?php
class Arenas {
	public static function getArenas($folder) {
		global $baseUrl;

		$restCmd = "rest/arenas/$folder";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd,$url);
		
		return json_decode($content, false);
		
//		return simplexml_load_file ( $baseUrl . $folder . '/spelplatser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
	}
}
?>
