<?php

class People
{

    public static function getPlayers($folder, $scope, $team)
    {
        global $baseUrl;

        $restCmd = "rest/players/$folder/$scope/$team";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);

        return json_decode($content, false);

        /*
         * // Strip group number
         * if (strpos ( $scope, '-' )) {
         * $scope = substr ( $scope, 0, strcspn ( $scope, '-' ) );
         * }
         *
         * $allPeople = simplexml_load_file ( $baseUrl . $folder . '/personer.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * if (empty ( $allPeople )) {
         * return array();
         * } else {
         * return $allPeople->xpath ( 'tpdb_medlem[kategori="' . $scope . '" and spe="true" and klubb="' . $team . '"]' );
         * }
         */
    }

    public static function getLeaders($folder, $scope, $team)
    {
        global $baseUrl;

        $restCmd = "rest/leaders/$folder/$scope/$team";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);

        return json_decode($content, false);

        /*
         * // Strip group number
         * if (strpos ( $scope, '-' )) {
         * $scope = substr ( $scope, 0, strcspn ( $scope, '-' ) );
         * }
         *
         * $allPeople = simplexml_load_file ( $baseUrl . $folder . '/personer.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * if (empty ( $allPeople )) {
         * return array();
         * } else {
         * return $allPeople->xpath ( 'tpdb_medlem[kategori="' . $scope . '" and led="true" and klubb="' . $team . '"]' );
         * }
         */
    }

    public static function getReferees($folder)
    {
        global $baseUrl;

        $restCmd = "rest/referees/$folder";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);

        return json_decode($content, false);

        /*
         * $allPeople = simplexml_load_file ( $baseUrl . $folder . '/personer.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * if (empty ( $allPeople )) {
         * return array();
         * } else {
         * return $allPeople->xpath ( 'tpdb_medlem[dom="true"]' );
         * }
         */
    }
}
