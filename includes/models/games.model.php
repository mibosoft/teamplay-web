<?php

class Games
{

    public static function getGames($folder, $scope)
    {
        global $baseUrl;
        
        $restCmd = "rest/games/$folder/$scope";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);
        
        return json_decode($content, false);
        
        // Variant där alla matcher läses in och sedan filter på arrayen
        /*
         *
         * $restCmd = "rest/games/$folder/" . "all";
         * $url = $baseUrl . rawurlencode($restCmd);
         * $content = getCacheContent($restCmd, $url);
         *
         * $json_output = json_decode($content, false);
         *
         * if ($scope == "all") {
         * return array_filter($json_output, function ($obj) {
         * return $obj->datum != "";
         * });
         * } else {
         * return array_filter($json_output, function ($obj) use ($scope) {
         * return $obj->datum != "" and $obj->grp_nr == $scope;
         * });
         * }
         */
        
        // return $games;
        
        /*
         * return array_filter($json_output, function ($obj) use ($scope) {
         * return $obj->grp_nr == $scope;
         * });
         */
        
        /*
         * $json_output = json_decode($content, false);
         *
         * return array_filter($json_output, function ($obj) use ($scope) {
         * return $obj->grp_nr == $scope;
         * });
         *
         */
        // return json_decode($content, false);
        
        // Exempel filtrera json
        /*
         * $houseSparrow = array_filter($json_output, function ($obj) {
         * return $obj->comName == "House Sparrow";
         * });
         */
        
        /*
         * $allGames = simplexml_load_file ( $baseUrl . $folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * if ($scope == "all") {
         * // $games = $allGames;
         * $games = $allGames->xpath ( 'tpdb_schema[datum != ""]' );
         * } else {
         * // $games = $allGames->xpath ( 'tpdb_schema[grp_nr="' . $scope . '" or contains(grp_nr,"' . $scope . '-")]' );
         * $games = $allGames->xpath ( 'tpdb_schema[grp_nr="' . $scope . '" and datum != ""]' );
         * }
         * return $games;
         */
    }

    public static function getGamesArena($folder, $arena, $field)
    {
        global $baseUrl;
        
        $restCmd = "rest/gamesarena/$folder/$arena/$field";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);
        
        return json_decode($content, false);
        
        /*
         * $allGames = simplexml_load_file ( $baseUrl . $folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * return $allGames->xpath ( 'tpdb_schema[spelplats="' . $arena . '" and plan="' . $field . '"]' );
         */
    }

    public static function getGamesTeam($folder, $scope, $team)
    {
        global $baseUrl;
        
        $restCmd = "rest/gamesteam/$folder/$scope/" . str_replace('/','|',$team);  // Need to encode forward slashes due to the REST API. Decoded in tpserver_api.php. 
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);
        
        return json_decode($content, false);
        /*
         * $allGames = simplexml_load_file ( $baseUrl . $folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * return $allGames->xpath ( 'tpdb_schema[(grp_nr="' . $scope . '" or contains(grp_nr,"' . $scope . '-")) and (hemma="' . $team . '" or borta="' . $team . '")]' );
         */
    }

    public static function getGamesClass($folder, $scope)
    {
        global $baseUrl;
        
        $restCmd = "rest/gamesclass/$folder/$scope";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);
        
        return json_decode($content, false);
        
        /*
         * // Strip group number
         * if (strpos($scope, '-')) {
         * $scope = substr($scope, 0, strcspn($scope, '-'));
         * }
         * $allGames = simplexml_load_file($baseUrl . $folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
         *
         * return $allGames->xpath('tpdb_schema[grp_nr="' . $scope . '" or contains(grp_nr,"' . $scope . '-") and datum != ""]');
         */
    }

    /*
     * public static function getGamesNo($folder, $gameno)
     * {
     * global $baseUrl;
     *
     * $allGames = simplexml_load_file($baseUrl . $folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
     *
     * return $allGames->xpath('tpdb_schema[matchnr="' . $gameno . '"]');
     * }
     */
    public static function getGamesLatest($folder)
    {
        global $baseUrl;
        
        $restCmd = "rest/gameslatest/$folder";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);
        
        return json_decode($content, false);
        
        /*
         * $allGames = simplexml_load_file($baseUrl . $folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
         *
         * $games = $allGames->xpath('tpdb_schema[datum != "" and status != "0"]');
         *
         * // Sort
         * $sort = array();
         * foreach ($games as $k => $v) {
         * $sort['datum'][$k] = (array) $v->datum;
         * $sort['tid'][$k] = (array) $v->tid;
         * }
         * array_multisort($sort['datum'], SORT_DESC, $sort['tid'], SORT_DESC, $games);
         *
         * return $games;
         */
    }

    public static function getGamesUnplayed($folder)
    {
        global $baseUrl;
        
        $restCmd = "rest/gamesunplayed/$folder";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);
        
        return json_decode($content, false);
        /*
         * $allGames = simplexml_load_file($baseUrl . $folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
         * $games = $allGames->xpath('tpdb_schema[status = "0" and dolj != "true"]');
         *
         * return $games;
         */
    }
}
?>
