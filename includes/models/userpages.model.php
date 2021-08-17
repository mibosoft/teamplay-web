<?php
class UserPages {
	public static function getPage($folder, $scope) {
		global $baseUrl;

		$restCmd = "rest/userpages/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd,$url);
		
		return json_decode($content, false);
/*		
		$allItems = simplexml_load_file ( $baseUrl . $folder . '/sidor.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );

		if (empty ( $allItems )) {
			return array ();
		} else {
			return $allItems->xpath ( 'sidor[id="' . $scope . '"]' );
		}
*/
	}
	public static function getMenuItems($folder) {
		global $baseUrl;
		
		$restCmd = "rest/userpagemenus/$folder";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd,$url);
		
		return json_decode($content, true);  // Decode as array as the REST API delivers an array (big problems in "headercup" when using objects)
/*		
		$allItems = simplexml_load_file ( $baseUrl . $folder . '/sidor.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );

		$menuitems = array ();
		if (empty ( $allItems )) {
			return array ();
		}
		for($i = 0; $i < count ( $allItems ); $i ++) {
			$menuitems [] = array (
					'id' => $allItems->sidor [$i]->id,
					'type' => $allItems->sidor [$i]->typ,
					'menutitle' => $allItems->sidor [$i]->rubrik
			);
		}

		return $menuitems;
*/
	}
}
?>
