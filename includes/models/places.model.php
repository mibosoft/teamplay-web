<?php
class Places {
    public static function getPlaces($folder,$type) {
        global $baseUrl;

        $restCmd = "rest/places/$folder/$type";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd,$url);
        
        return json_decode($content, false);
    }
/*
    public static function getAllPlaces($folder) {
		global $baseUrl;
		return simplexml_load_file ( $baseUrl . $folder . '/platser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
	}
	public static function getFoodPlaces($folder) {
		global $baseUrl;
		
		$all = simplexml_load_file ( $baseUrl . $folder . '/platser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		return $all->xpath ( 'tpdb_plats[typ="1"]' );
	}
	public static function getLodgingPlaces($folder) {
		global $baseUrl;
		
		$all = simplexml_load_file ( $baseUrl . $folder . '/platser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		return $all->xpath ( 'tpdb_plats[typ="2"]' );
	}
	public static function getOtherPlaces($folder) {
		global $baseUrl;
		
		$all = simplexml_load_file ( $baseUrl . $folder . '/platser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		return $all->xpath ( 'tpdb_plats[typ="3"]' );
	}
*/
}
?>
