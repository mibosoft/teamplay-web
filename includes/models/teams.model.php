<?php

class Teams
{

    public static function getTeams($folder, $scope, $team)
    {
        global $baseUrl;

        $restCmd = "rest/teams/$folder/$scope/" . str_replace('/', '|', $team);  // Need to encode forward slashes due to the REST API. Decoded in tpserver_api.php.
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);

        return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)

        /*
         * $allTeams = simplexml_load_file ( $baseUrl . $folder . '/lag.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * if ($scope == "all") {
         * $teams = $allTeams;
         * } else {
         * $teams = $allTeams->xpath ( 'tpdb_klubb[klass="' . $scope . '"]' );
         * }
         * return $teams;
         * }
         * public static function getSingleTeam($folder, $scope, $team) {
         * global $baseUrl;
         *
         * $teams = simplexml_load_file ( $baseUrl . $folder . '/lag.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * // Strip group number
         * if (strpos ( $scope, '-' )) {
         * $scope = substr ( $scope, 0, strcspn ( $scope, '-' ) );
         * }
         *
         * return $teams->xpath ( 'tpdb_klubb[(klass="' . $scope . '" or contains(klass,"' . $scope . '-")) and klubb="' . $team . '"]' );
         */
    }
}
