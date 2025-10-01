<?php
class Standings
{
	public static function getStandings($folder, $scope)
	{
		global $baseUrl;

		$restCmd = "rest/standings/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)

		/*		
		$allStandings = simplexml_load_file ( $baseUrl . $folder . '/tabell.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		// $games = $allGames->xpath ( 'tpdb_schema[grp_nr="' . $scope . '"]');
		if ($scope == "all") {
			$standings = $allStandings;
		} else {
			$standings = $allStandings->xpath ( 'statt[grp_nr="' . $scope . '" or contains(grp_nr,"' . $scope . '-")]' );
		}
		return $standings;
*/
	}

	public static function showStandings($folder, $scope)
	{
		global $baseUrl;

		$restCmd = "rest/showstandings/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)
		/*		
		$allGroups = simplexml_load_file ( $baseUrl . $folder . '/grupp.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		$group = $allGroups->xpath ( 'tpdb_grupp[grp_typ="S" and grp_nr="' . $scope . '"]' );
		
		if ($group[0]->dolj == 'true') {
			return true;
		} else {
			return false;
		}
*/
	}
}
