<?php

class Fairplay
{

    public static function getFairplay($folder, $scope)
    {
        global $baseUrl;

        $restCmd = "rest/fairplay/$folder/$scope";
        $url = $baseUrl . rawurlencode($restCmd);
        $content = getContent($restCmd, $url);

        return json_decode($content, false);

        /*
         * $allData = simplexml_load_file ( $baseUrl . $folder . '/fairplay.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
         *
         * if (empty ( $allData )) {
         * return array ();
         * }
         *
         * if ($scope == "all") {
         * $selectedData = $allData;
         * } else {
         * $selectedData = $allData->xpath ( 'statf[klass="' . $scope . '"]' );
         * }
         * return $selectedData;
         */
    }
}
