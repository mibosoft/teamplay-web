<?php

class Cupdir
{

    public static function findAll($scope)
    {
        global $baseUrl;

        $restCmd = "rest/tournaments/''/''";
        $url = $baseUrl . rawurlencode($restCmd);

        $content = getContent($restCmd, $url);

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
    }
}
