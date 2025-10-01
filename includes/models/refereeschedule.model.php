<?php
class RefereeSchedule
{
	public static function getRefereeSchedule($folder, $name)
	{
		global $baseUrl;

		$restCmd = "rest/refereeschedules/$folder/$name";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)

		/*
		$allGames = simplexml_load_file ( $baseUrl . $folder . '/domarschema.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		if (empty ( $allGames )) {
			return array ();
		} else {
			return $allGames->xpath ( 'statr[domare="' . $name . '"]' );
		}
*/
	}
}
