<?php
class CupInfo {
	public static function getBaseInfo($folder) {
		global $baseUrl;
		
		$restCmd = "rest/cupinfo/$folder";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd,$url);
		
		return json_decode($content, false);
		
//		return simplexml_load_file ( $baseUrl . $folder . '/info.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
	}
}
?>
