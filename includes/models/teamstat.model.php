<?php
class TeamStat
{
	public static function getStat($folder, $scope)
	{
		global $baseUrl;

		$restCmd = "rest/teamstats/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false);
		/*		
		$allStat = simplexml_load_file ( $baseUrl . $folder . '/lagstatistik.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
		
		if (empty ( $allStat )) {
			return array ();
		}
		
		if ($scope == "all") {
			$teamstat = $allStat;
		} else {
			$teamstat = $allStat->xpath ( 'statk[grp_nr="' . $scope . '"]' );
		}
		return $teamstat;
*/
	}
}
