<?php
class PlayerStat
{
	public static function getStat($folder, $scope, $team)
	{
		global $baseUrl;

		$restCmd = "rest/playerstats/$folder/$scope/$team";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);
		/*		
		$allStat = simplexml_load_file ( $baseUrl . $folder . '/spelarstatistik.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		if (empty ( $allStat )) {
			return array ();
		}
		
		if ($scope == "all") {
			$playerstat = $allStat;
		} else {
			$playerstat = $allStat->xpath ( 'stats[grp_nr="' . $scope . '"]' );
		}
		return $playerstat;
*/
	}
}
