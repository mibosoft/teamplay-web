<?php
class Lineups {
	public static function getLineups($folder, $gameno, $team) {
		global $baseUrl;
		
		$restCmd = "rest/lineups/$folder/$gameno/$team";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd,$url);
		
		return json_decode($content, false);
		
/*		
		$allItems = simplexml_load_file ( $baseUrl . $folder . '/matchspelare.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		if (empty ( $allItems )) {
			return array ();
		} else {
			return $allItems->xpath ( 'tpdb_lag[matchnr="' . $gameno . '" and klubb="' . $team . '"]' );
		}
*/
	}
}
?>
