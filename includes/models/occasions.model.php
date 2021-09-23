<?php
class Occasions
{
	public static function getOccasions($folder, $gameno)
	{
		global $baseUrl;

		$restCmd = "rest/occasions/$folder/$gameno";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);

		/*		
		$allItems = simplexml_load_file ( $baseUrl . $folder . '/matchhandelser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );

		if (empty ( $allItems )) {
			return array ();
		} else {
			return $allItems->xpath ( 'tpdb_prot[matchnr="' . $gameno . '"]' );
		}
*/
	}
}
