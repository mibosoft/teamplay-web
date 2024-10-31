<?php
// Test with https://teamplaycup.se/rest/games/praguefbcup/22/B05
require_once 'abstract_api.php';

class MyAPI extends API
{

    protected $folder = '';

    protected $scope = '';

    protected $param4 = '';

    protected $param5 = '';

    public function __construct($request, $origin)
    {
        parent::__construct($request);
        // Fixed parameters:
        // 0: folder, 1: year, 2: scope
        $this->folder = $this->args[0] . "/" . $this->args[1];
        $this->scope = $this->args[2];
        // Forward slash does not work with this REST API so rewrite in case the sender encoded them with '|'        
        $this->param4 = str_replace('|', '/', $this->args[3]);
        $this->param5 = str_replace('|', '/', $this->args[4]);

        // Add authentication, model initialization, etc here
    }

    // ***************************
    // Cup directory
    // ***************************
    protected function tournaments()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . 'cuper.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            $selectedCups = $xml->xpath('cuper[active="true"]');

            foreach ($selectedCups as $cup) {
                $xml = simplexml_load_file($this->baseUrl . $cup->folder . '/info.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
                if (false === $xml) {
                } else {
                    $cup->addchild('cupnamn');
                    $cup->cupnamn = $xml->bas->namn;
                    $cup->addchild('arr');
                    $cup->arr = $xml->bas->arr;
                    $cup->addchild('idrott');
                    $cup->idrott = $xml->bas->idrott;
                    $cup->addchild('start_dat');
                    $cup->start_dat = $xml->bas->start_dat;
                    $cup->addchild('slut_dat');
                    $cup->slut_dat = $xml->bas->slut_dat;
                }
            }
            return $selectedCups;
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Cup information
    // ***************************
    protected function cupinfo()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/info.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            return $xml;
            // return $xml->xpath('bas[namn != ""]');
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Classes
    // ***************************
    protected function classes()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/grupp.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if (empty($this->scope)) {
                $classes = $xml->xpath('tpdb_grupp[grp_typ="T"]');
            } else {
                /*
                 * <grp_typ>T</grp_typ>
                 * <grp_nr>P05C</grp_nr>
                 * <grp_namn>Pojkar 05 Gr C</grp_namn>
                 * <forts_grp>0</forts_grp>
                 * <grupp>
                 * <grp_nr>
                 * <grp_namn>
                 * <lag>
                 * <namn>Harbo</namn>
                 * </lag>
                 * </grupp>
                 */

                // Strip group number
                if (strpos($this->scope, '-')) {
                    $this->scope = substr($this->scope, 0, strcspn($this->scope, '-'));
                }

                if ($this->scope == "all" or empty($this->scope)) {
                    $classes = $xml->xpath('tpdb_grupp[grp_typ="T"]');
                } else {
                    $classes = $xml->xpath('tpdb_grupp[grp_typ="T" and grp_nr="' . $this->scope . '"]');
                }

                for ($i = 0; $i < count($classes); $i++) {
                    for ($j = 1; $j <= 32; $j++) {
                        $groupNo = $classes[$i]->grp_nr . '-' . strval($j);
                        $serie = $xml->xpath('tpdb_grupp[grp_nr="' . $groupNo . '"]');
                        if (count($serie) == 0) {
                            $group = $classes[$i]->addchild("grupp"); // To make sure get arrays of objects even if only one group
                            $group->addchild("grp_nr");
                            continue;
                        }
                        $group = $classes[$i]->addchild("grupp");
                        $group->addchild("grp_nr");
                        $group->grp_nr = $classes[$i]->grp_nr . '-' . $j;
                        $group->addchild("grp_namn");
                        $group->grp_namn = $serie[0]->grp_namn;
                        for ($k = 1; $k <= 16; $k++) {
                            $teamNamePointer = 'obj_' . strval($k);
                            $lkodPointer = 'memo_' . strval($k);
                            if ($serie[0]->{$teamNamePointer} == "") {
                                $team = $group->addchild("lag"); // To make sure get arrays of objects even if only one team
                                $team->addchild("namn");
                            } else {
                                $team = $group->addchild("lag");
                                $team->addchild("namn");
                                $team->namn = $serie[0]->{$teamNamePointer};
                                $team->addchild("lkod");
                                $team->lkod = $serie[0]->{$lkodPointer};
                            }
                        }
                    }
                }
            }
            return $classes;
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Games
    // ***************************
    protected function games()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $games = $xml->xpath('tpdb_schema[grp_nr != ""]');
            } elseif ($this->scope == "booked") {
                $games = $xml->xpath('tpdb_schema[datum != ""]');
            } elseif (is_numeric($this->scope)) {
                $games = $xml->xpath('tpdb_schema[matchnr="' . $this->scope . '"]');
            } else {
                // 181010: Ersan (Stefan) vill se alla matcher. Lade därför till valet "Bokade" matcher ovan.
                // $games = $xml->xpath('tpdb_schema[grp_nr="' . $this->scope . '" and datum != ""]');
                $games = $xml->xpath('tpdb_schema[grp_nr="' . $this->scope . '"]');
            }
            return $games;
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function gamesarena()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            return $xml->xpath('tpdb_schema[spelplats="' . $this->scope . '" and plan="' . $this->param4 . '"]');
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function gamesteam()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            return $xml->xpath('tpdb_schema[(grp_nr="' . $this->scope . '" or contains(grp_nr,"' . $this->scope . '-")) and (hemma="' . $this->param4 . '" or borta="' . $this->param4 . '")]');
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function gamesclass()
    {
        if ($this->method == 'GET') {
            // Strip group number
            if (strpos($this->scope, '-')) {
                $this->scope = substr($this->scope, 0, strcspn($this->scope, '-'));
            }
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            return $xml->xpath('tpdb_schema[grp_nr="' . $this->scope . '" or contains(grp_nr,"' . $this->scope . '-")]');
            // return $xml->xpath('tpdb_schema[grp_nr="' . $this->scope . '" or contains(grp_nr,"' . $this->scope . '-") and datum != ""]');
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function gameslatest()
    {
        if ($this->method == 'GET') {

            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            $games = $xml->xpath('tpdb_schema[datum != "" and status != "0"]');

            // Sort
            $sort = array();
            foreach ($games as $k => $v) {
                $sort['datum'][$k] = (array) $v->datum;
                $sort['tid'][$k] = (array) $v->tid;
            }
            array_multisort($sort['datum'], SORT_DESC, $sort['tid'], SORT_DESC, $games);

            return $games;
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function gamesunplayed()
    {
        if ($this->method == 'GET') {

            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/resultat.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            // $games = $xml->xpath('tpdb_schema[status = "0" and dolj != "true"]');
            $games = $xml->xpath('tpdb_schema[status = "0"]'); // Slevik vill se alla. 180601

            return $games;
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Lineups
    // ***************************
    protected function lineups()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/matchspelare.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if (empty($xml)) {
                return array();
            } else {
                return $xml->xpath('tpdb_lag[matchnr="' . $this->scope . '" and klubb="' . $this->param4 . '"]');
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Arena
    // ***************************
    protected function arenas()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/spelplatser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            return $xml->xpath('tpdb_plats[namn != ""]');
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Teams
    // ***************************
    protected function teams()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/lag.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $teams = $xml->xpath('tpdb_klubb[id != ""]');
            } else {
                // Strip group number
                if (strpos($this->scope, '-')) {
                    $this->scope = substr($this->scope, 0, strcspn($this->scope, '-'));
                }
                if (empty($this->param4)) {
                    $teams = $xml->xpath('tpdb_klubb[klass="' . $this->scope . '"]');
                } else {
                    $teams = $xml->xpath('tpdb_klubb[(klass="' . $this->scope . '" or contains(klass,"' . $this->scope . '-")) and klubb="' . $this->param4 . '"]');
                }
            }
            return $teams;
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Fairplay
    // ***************************
    protected function fairplay()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/fairplay.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            // if (empty($xml)) {
            // return array();
            // }

            if ($this->scope == "all" or empty($this->scope)) {
                $selectedData = $xml->xpath('statf[klass !=""]');
            } else {
                $selectedData = $xml->xpath('statf[klass="' . $this->scope . '"]');
            }
            return $selectedData;
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // News
    // ***************************
    protected function news()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/nyheter.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            return $xml->xpath('nyheter[datumtid !=""]');
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Occasions
    // ***************************
    protected function occasions()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/matchhandelser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            return $xml->xpath('tpdb_prot[matchnr="' . $this->scope . '"]');
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // People
    // ***************************
    protected function players()
    {
        // public static function getPlayers($folder, $scope, $team) {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/personer.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $people = $xml->xpath('tpdb_medlem[medlem!="" and spe="true"]');
            } elseif (empty($this->param4)) {
                $people = $xml->xpath('tpdb_medlem[kategori="' . $this->scope . '" and spe="true"]');
            } else {
                if (strpos($this->scope, '-')) { // Strip group number
                    $this->scope = substr($this->scope, 0, strcspn($this->scope, '-'));
                }
                $people = $xml->xpath('tpdb_medlem[kategori="' . $this->scope . '" and spe="true" and klubb="' . $this->param4 . '"]');
            }
            return $people;
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function leaders()
    // public static function getLeaders($folder, $this->scope, $team)
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/personer.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $people = $xml->xpath('tpdb_medlem[medlem!="" and led="true"]');
            } elseif (empty($this->param4)) {
                $people = $xml->xpath('tpdb_medlem[kategori="' . $this->scope . '" and led="true"]');
            } else {
                if (strpos($this->scope, '-')) { // Strip group number
                    $this->scope = substr($this->scope, 0, strcspn($this->scope, '-'));
                }
                $people = $xml->xpath('tpdb_medlem[kategori="' . $this->scope . '" and led="true" and klubb="' . $this->param4 . '"]');
            }
            return $people;
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function referees()
    // public static function getReferees($folder)
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/personer.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            return $xml->xpath('tpdb_medlem[dom="true"]');
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Places (map)
    // ***************************
    protected function places()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/platser.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                return $xml->xpath('tpdb_plats[typ!=""]');
            } else {
                return $xml->xpath('tpdb_plats[typ="' . $this->scope . '"]');
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Player stats - sorted on goals
    // ***************************
    protected function playerstatsgoals()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/spelarstatistik.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $players = $xml->xpath('stats[grp_nr!=""]');
            } elseif (!empty($this->param4)) {
                $players = $xml->xpath('stats[grp_nr="' . $this->scope . '" and klubb="' . $this->param4 . '"]');
            } else {
                $players = $xml->xpath('stats[grp_nr="' . $this->scope . '"]');
            }

            usort($players, function ($a, $b) {
                $total1 = ($a->mal) + ($a->ass * 0.01);
                $total2 = ($b->mal) + ($b->ass * 0.01);
                if ($total1 == $total2)
                    return 0;
                return ($total1 > $total2) ? -1 : 1;
            });

            return array_slice($players, 0, 200);  // Return max
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Player stats - sorted on assists
    // ***************************
    protected function playerstatsassists()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/spelarstatistik.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $players = $xml->xpath('stats[grp_nr!=""]');
            } elseif (!empty($this->param4)) {
                $players = $xml->xpath('stats[grp_nr="' . $this->scope . '" and klubb="' . $this->param4 . '"]');
            } else {
                $players = $xml->xpath('stats[grp_nr="' . $this->scope . '"]');
            }

            usort($players, function ($a, $b) {
                $total1 = ($a->ass) + ($a->mal * 0.01);
                $total2 = ($b->ass) + ($b->mal * 0.01);
                if ($total1 == $total2)
                    return 0;
                return ($total1 > $total2) ? -1 : 1;
            });

            return array_slice($players, 0, 200);  // Return max
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Player stats - sorted on +/- goals
    // ***************************
    protected function playerstatsgoaldiff()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/spelarstatistik.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $players = $xml->xpath('stats[grp_nr!=""]');
            } elseif (!empty($this->param4)) {
                $players = $xml->xpath('stats[grp_nr="' . $this->scope . '" and klubb="' . $this->param4 . '"]');
            } else {
                $players = $xml->xpath('stats[grp_nr="' . $this->scope . '"]');
            }

            usort($players, function ($a, $b) {
                $total1 = $a->plusmal + (($a->plusmal - $a->minusmal) * 0.01);
                $total2 = $b->plusmal + (($b->plusmal - $b->minusmal) * 0.01);
                if ($total1 == $total2)
                    return 0;
                return ($total1 > $total2) ? -1 : 1;
            });

            return array_slice($players, 0, 200);  // Return max
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Player stats - as is (pre-sorted xml)
    // ***************************
    protected function playerstats()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/spelarstatistik.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                return $xml->xpath('stats[grp_nr!="" and position()<=200]');  // Begränsa eftersom kan bli extremt många
                //                return $xml->xpath('stats[grp_nr!=""]');
            } elseif (!empty($this->param4)) {
                return $xml->xpath('stats[grp_nr="' . $this->scope . '" and klubb="' . $this->param4 . '"]');
            } else {
                return $xml->xpath('stats[grp_nr="' . $this->scope . '"]');
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Player game highlights - Most points
    // ***************************
    protected function playerhighpoints()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/matchspelare.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $players = $xml->xpath('tpdb_lag[grp_nr != ""]');
            } else {
                $players = $xml->xpath('tpdb_lag[grp_nr="' . $this->scope . '" or contains(grp_nr,"' . $this->scope . '-")]');
            }

            usort($players, function ($a, $b) {
                $total1 = ($a->mal + $a->ass) + $a->mal * 0.01;
                $total2 = ($b->mal + $b->ass) + $b->mal * 0.01;
                if ($total1 == $total2)
                    return 0;
                return ($total1 > $total2) ? -1 : 1;
            });

            return array_slice($players, 0, 10);  // Return top games
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Player game highlights - Most goals
    // ***************************
    protected function playerhighgoals()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/matchspelare.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $players = $xml->xpath('tpdb_lag[grp_nr != ""]');
            } else {
                $players = $xml->xpath('tpdb_lag[grp_nr="' . $this->scope . '" or contains(grp_nr,"' . $this->scope . '-")]');
            }

            usort($players, function ($a, $b) {
                $total1 = (int)$a->mal;
                $total2 = (int)$b->mal;
                if ($total1 == $total2)
                    return 0;
                return ($total1 > $total2) ? -1 : 1;
            });

            return array_slice($players, 0, 10);  // Return top games
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Player game highlights - Most assists
    // ***************************
    protected function playerhighassists()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/matchspelare.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $players = $xml->xpath('tpdb_lag[grp_nr != ""]');
            } else {
                $players = $xml->xpath('tpdb_lag[grp_nr="' . $this->scope . '" or contains(grp_nr,"' . $this->scope . '-")]');
            }

            usort($players, function ($a, $b) {
                $total1 = (int)$a->ass;
                $total2 = (int)$b->ass;
                if ($total1 == $total2)
                    return 0;
                return ($total1 > $total2) ? -1 : 1;
            });

            return array_slice($players, 0, 10);  // Return top games
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Player game highlights - Most penalties
    // ***************************
    protected function playerhighpenalties()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/matchspelare.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                $players = $xml->xpath('tpdb_lag[grp_nr != ""]');
            } else {
                $players = $xml->xpath('tpdb_lag[grp_nr="' . $this->scope . '" or contains(grp_nr,"' . $this->scope . '-")]');
            }

            usort($players, function ($a, $b) {
                $total1 = (int)$a->utv;
                $total2 = (int)$b->utv;
                if ($total1 == $total2)
                    return 0;
                return ($total1 > $total2) ? -1 : 1;
            });

            return array_slice($players, 0, 10);  // Return top games
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Team stats
    // ***************************
    protected function teamstats()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/lagstatistik.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                return $xml->xpath('statk[grp_nr!=""]');
            } else {
                return $xml->xpath('statk[grp_nr="' . $this->scope . '"]');
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Referee schedules
    // ***************************
    protected function refereeschedules()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/domarschema.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                return $xml->xpath('statr[domare!=""]');
            } else {
                return $xml->xpath('statr[domare="' . $this->scope . '"]');
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Standings
    // ***************************
    protected function standings()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/tabell.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                return $xml->xpath('statt[grp_nr!=""]');
            } else {
                return $xml->xpath('statt[grp_nr="' . $this->scope . '" or contains(grp_nr,"' . $this->scope . '-")]');
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Standings
    // ***************************
    protected function showstandings()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/grupp.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            $group = $xml->xpath('tpdb_grupp[grp_typ="S" and grp_nr="' . $this->scope . '"]');

            if ($group[0]->dolj == 'true') {
                return true;
            } else {
                return false;
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // User pages
    // ***************************
    protected function userpages()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/sidor.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            if ($this->scope == "all" or empty($this->scope)) {
                return $xml->xpath('sidor[id!=""]');
            } else {
                return $xml->xpath('sidor[id="' . $this->scope . '"]');
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // User page menus
    // ***************************
    protected function userpagemenus()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/sidor.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }

            $menuitems = array();
            foreach ($xml->sidor as $item) {
                $menuitems[] = array(
                    'id' => $item->id,
                    'type' => $item->typ,
                    'menutitle' => $item->rubrik
                );
            }
            return $menuitems;
        } else {
            return "Only accepts GET requests";
        }
    }

    // ***************************
    // Settings
    // ***************************
    protected function settings()
    {
        if ($this->method == 'GET') {
            $xml = simplexml_load_file($this->baseUrl . $this->folder . '/installn.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR);
            if (!$xml) {
                exit();
            }
            return $xml->xpath('par[bool1!=""]');
        } else {
            return "Only accepts GET requests";
        }
    }
}
// For debug
// return array("status" => "success", "endpoint" => $this->endpoint, "verb" => $this->verb, "args" => $this->args, "request" => $this->request);
