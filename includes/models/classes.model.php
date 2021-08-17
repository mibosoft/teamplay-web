<?php
class Classes {
    public static function getClasses($folder, $scope) {
		global $baseUrl;
		
		$restCmd = "rest/classes/$folder/$scope";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd,$url);
		
		return json_decode($content, false);
	}
}
?>
