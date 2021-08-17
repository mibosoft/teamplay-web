<?php

class Cupdir
{

    public static function findAll($scope)
    {
        global $baseUrl;
        
        $restCmd = "rest/tournaments/''/''";
        $url = $baseUrl . rawurlencode($restCmd);

        $content = getContent($restCmd,$url);

        $selectedCups = json_decode($content, false);

//        $content = file_get_contents($url);
//        $content = getCacheContent("", "tournaments",$url);
//        $selectedCups = json_decode($content, false);
        
        if ($scope == "active") {
            // Filter out end date no older than 1 week
            $currentActiveCups = array_filter($selectedCups, function ($val) {
                return (strtotime($val->slut_dat) > time() - + (7 * 24 * 60 * 60));
            });
                
                return $currentActiveCups;
        } else {
            // Filter out end date no older than 1 week
            $oldCups = array_filter($selectedCups, function ($val) {
                return (strtotime($val->slut_dat) <= time() - + (7 * 24 * 60 * 60));
            });
                
                return $oldCups;
        }
        
        
        /*
         * $allCups = simplexml_load_file ( $baseUrl . 'cuper.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         * // if ($scope == "active") {
         * $selectedCups = $allCups->xpath ( 'cuper[active="true"]' );
         * // } else {
         * // $selectedCups = $allCups->xpath ( 'cuper[active="false"]' );
         * // }
         *
         * foreach ($selectedCups as $cup) {
         * $info = simplexml_load_file ( $baseUrl . $cup->folder . '/info.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         * if (false === $info) {
         * } else {
         * $cup->addchild ( 'cupnamn' );
         * $cup->cupnamn = $info->bas->namn;
         * $cup->addchild ( 'arr' );
         * $cup->arr = $info->bas->arr;
         * $cup->addchild ( 'idrott' );
         * $cup->idrott = $info->bas->idrott;
         * $cup->addchild ( 'start_dat' );
         * $cup->start_dat = $info->bas->start_dat;
         * $cup->addchild ( 'slut_dat' );
         * $cup->slut_dat = $info->bas->slut_dat;
         * }
         * }
         *
         * if ($scope == "active") {
         * // Filter out end date no older than 1 week
         * $currentActiveCups = array_filter ( $selectedCups, function ($val) {
         * return (strtotime ( $val->slut_dat ) > time () - + (7 * 24 * 60 * 60));
         * } );
         *
         * return $currentActiveCups;
         * } else {
         * // Filter out end date no older than 1 week
         * $oldCups = array_filter ( $selectedCups, function ($val) {
         * return (strtotime ( $val->slut_dat ) <= time () - + (7 * 24 * 60 * 60));
         * } );
         *
         * return $oldCups;
         * }
         */
    }
}
?>