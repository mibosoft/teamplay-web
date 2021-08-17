<?php
class Classes {
    public static function getClasses($folder, $scope) {
		global $baseUrl;
		
		$restCmd = "rest/classes/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd,$url);
		
		return json_decode($content, false);
		
/*
		$groups = simplexml_load_file ( $baseUrl . $folder . '/grupp.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		return $groups->xpath ( 'tpdb_grupp[grp_typ="T"]' );
*/	
	}
}
?>
