<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="assets/css/timeline.css" />

<div class="container">
    <div class="content">
        <h2><?php echo $title ?></h2>

        <h4>
            <a href="?team&home=<?php echo $_GET['home']; ?>&scope=<?php echo $games[0]->grp_nr ?>&name=<?php echo urlencode($games[0]->hemma) ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo $games[0]->hemma ?></a> -
            <a href="?team&home=<?php echo $_GET['home']; ?>&scope=<?php echo $games[0]->grp_nr ?>&name=<?php echo urlencode($games[0]->borta) ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo $games[0]->borta ?></a> :
            <?php echo $games[0]->dolj == 'true' ? S_DOLT : $games[0]->m_hem . "-" . $games[0]->m_bor ?>
            <?php echo empty($games[0]->m_per) ? '' : '(' . $games[0]->m_per . ')' ?>
            <?php echo $games[0]->wo == "true" ? "(WO)" : ""; ?><?php echo $games[0]->straffl == "true" ? "(STR)" : ""; ?><?php echo $games[0]->forlangn == "true" ? "(FL)" : ""; ?>
            <?php echo ($games[0]->mediaurl != "" ? '<a href="' . $games[0]->mediaurl . '" target="_blank"><span class="glyphicon glyphicon-facetime-video" style="vertical-align: text-top;" title="' . S_VIDEO . '/' . S_FOTO . '"></span></a>' : "") ?>
        </h4>

        <br><br>
        <table class="table table-condensed">
            <tr>
                <td><strong><?php echo S_MATCHNR ?>:</strong></td>
                <td><?php echo $games[0]->matchnr ?> <?php echo empty($games[0]->anm) ? '' : "(" . $games[0]->anm . ")" ?></td>
                <td><strong><?php echo S_GRUPP ?>:</strong></td>
                <td><a href="<?php echo strpos($games[0]->grp_nr, "-") ? '?overviewgroup' : '?overviewplayoff'; ?>&home=<?php echo $_GET['home']; ?>&scope=<?php echo $games[0]->grp_nr ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo $games[0]->grp_nr ?></a></td>
            <tr>
                <td><strong><?php echo S_DAG ?>:</strong></td>
                <td><?php echo $games[0]->datum != "" ? dow(date("N", strtotime($games[0]->datum))) : ""; ?> <?php echo $games[0]->datum ?></td>
                <td><strong><?php echo S_TID ?>:</strong></td>
                <td><?php echo $games[0]->tid ?></td>
            </tr>
            <tr>
                <td><strong><?php echo S_PLATS ?>:</strong></td>
                <td><a href="?games&home=<?php echo $_GET['home']; ?>&scope=all&arena=<?php echo $games[0]->spelplats ?>&field=<?php echo $games[0]->plan ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo $games[0]->spelplats . ' ' . $games[0]->plan ?></a></td>
                <td><strong><?php echo S_PUBLIK ?>:</strong></td>
                <td><?php echo $games[0]->publik ?></td>
            </tr>
            <tr>
                <td><strong><?php echo S_STATUS ?>:</strong></td>
                <td style="vertical-align: middle;"><big><span class="<?php echo getGameStatus($games[0]->status) ?>"><?php echo getGameStatusText($games[0]->status) ?> <?php echo $games[0]->status == 1 ? $games[0]->matchtid : ""; ?></span></big></td>
                <td><strong><?php echo $baseInfo->bas->ben_funkt == "true" ? S_FUNKTIONARER : S_DOMARE ?>:</strong></td>
                <td><?php echo $games[0]->dom_1 . (empty($games[0]->dom_2) ? '' : ', ' . $games[0]->dom_2) ?><?php echo empty($games[0]->dom_3) ? '' : ', ' . $games[0]->dom_3 ?></td>
            </tr>
            <tr>
                <td><strong><?php echo $settings[0]->bool2 == "true" ? "" : S_SKOTT . ":" ?></strong></td>
                <td><?php echo (empty($games[0]->s_hem) and empty($games[0]->s_bor)) ? '-' : $games[0]->s_hem . "-" . $games[0]->s_bor ?> <?php echo empty($games[0]->s_per) ? '' : '(' . $games[0]->s_per . ')' ?></td>
                <td><strong><?php echo S_FAIRPLAY ?>:</strong></td>
                <td><?php echo (empty($games[0]->fplay_h) and empty($games[0]->fplay_b)) ? '-' : $games[0]->fplay_h . "-" . $games[0]->fplay_b ?></td>
            </tr>
        </table>

        <?php echo empty($games[0]->rapport) ? '<!--' : '' ?>
        <h4><?php echo S_KOMMENTAR ?></h4>
        <p><?php echo $games[0]->rapport ?></p>
        <?php echo empty($games[0]->rapport) ? '-->' : '' ?>

        <br>

        <!-- #### NAV #### -->
        <?php echo ($baseInfo->bas->prot_typ == 3) ? '' : '<ul class="nav nav-tabs">' ?>
        <?php echo ($baseInfo->bas->prot_typ == 1) ? '' : '<!--' ?>
        <li class="active"><a data-toggle="tab" id="nav_tab_1" href="#tab_1"><?php echo S_HANDELSER ?></a></li>
        <?php echo ($baseInfo->bas->prot_typ == 1) ? '' : '-->' ?>
        <?php echo ($baseInfo->bas->prot_typ < 3) ? '' : '<!--' ?>
        <li <?php echo ($baseInfo->bas->prot_typ == 1) ? '' : 'class="active"' ?>><a data-toggle="tab" id="nav_tab_2" href="#tab_2"><?php echo S_HEMMALAG ?></a></li>
        <li><a data-toggle="tab" id="nav_tab_3" href="#tab_3"><?php echo S_BORTALAG ?></a></li>
        <?php echo ($baseInfo->bas->prot_typ < 3) ? '' : '-->' ?>
        <?php echo ($baseInfo->bas->prot_typ == 3) ? '' : '</ul>' ?>

        <!-- #### TAB 1 #### -->
        <div class="tab-content">
            <div id="tab_1" class="tab-pane fade in active">
                <?php echo ($baseInfo->bas->prot_typ == 1) ? '' : '<!--' ?>

                <?php
                $previousPeriod = "init";
                $i = 0;
                if (is_array($occasions)) {
                    foreach (array_reverse($occasions) as $k) {
                        if ($previousPeriod != "init" and $previousPeriod != $k->period) {
                            echo '</div>';
                            echo '</section>';
                            echo '<p align="center">' . S_PER . ' '  . $previousPeriod . '</p>';
                        }
                        if ($previousPeriod != $k->period) {
                            echo '<br><section id="conference-timeline">';
                            echo '<div class="conference-center-line"></div>';
                            echo '<div class="conference-timeline-content">';
                        }
                        include "includes/views/_occasions.php";
                        $previousPeriod = $k->period;
                        $i++;
                    }
                    if ($i > 0) {
                        echo '</div>';
                        echo '</section>';
                        echo '<p align="center">' . S_PER . ' '  . $previousPeriod . '</p>';
                    }
                }
                ?>

                <?php echo ($baseInfo->bas->prot_typ == 1) ? '' : '-->' ?>
            </div> <!-- tab-1 -->

            <!-- #### TAB 2 #### -->
            <div id="tab_2" class="<?php echo ($baseInfo->bas->prot_typ == 1) ? 'tab-pane fade' : 'tab-pane fade in active' ?>">
                <?php echo ($baseInfo->bas->prot_typ < 3) ? '' : '<!--' ?>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th><?php echo S_NR ?></th>
                                <th><?php echo S_SPELARE ?></th>
                                <th><?php echo S_M_K ?></th>
                                <th><?php echo $baseInfo->bas->st_mip == 'true' ? S_MIP : '' ?></th>
                                <th><?php echo S_G ?></th>
                                <th><?php echo $baseInfo->bas->st_ass == 'true' ? S_A : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_ass == 'true' ? S_PTS : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_utv == 'true' ? S_PIM : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_mal == 'true' ? S_GF : '' ?></th>
                                <th><?php echo ($baseInfo->bas->st_mal == 'true' or $baseInfo->bas->st_mip == 'true') ? S_GA : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_skott_t == 'true' ? S_S : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_skott_m == 'true' ? S_SOG : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_tekn == 'true' ? S_FW : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_tekn == 'true' ? S_FL : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_brytn == 'true' ? S_BRYTN : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_gulkort == 'true' ? S_GULAKORT : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_rodkort == 'true' ? S_RODAKORT : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_straffs == 'true' ? S_PS : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_straffm == 'true' ? S_PSG : '' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php render($homelineup, array('view' => '_lineup', 'baseInfo' => $baseInfo)) ?>
                        </tbody>
                    </table>
                </div>
                <small><i>
                        <?php echo $baseInfo->bas->st_mip == 'true' ? S_MIP . '=' .  S_SPELADTIDMALVAKTERMIP : '' ?>
                        <?php echo S_G ?>=<?php echo S_MALGOALS ?>
                        <?php echo $baseInfo->bas->st_ass == 'true' ? S_A . '=' . S_ASSIST : '' ?>
                        <?php echo $baseInfo->bas->st_ass == 'true' ? S_PTS . '=' . S_POANGPOINTS : '' ?>
                        <?php echo $baseInfo->bas->st_utv == 'true' ? S_PIM . '=' . S_UTVISNINGPENALTIESINMINUTESANDSECONDS : '' ?>
                        <?php echo $baseInfo->bas->st_mal == 'true' ? S_GA . '=' . S_MALFRAMAT : '' ?>
                        <?php echo ($baseInfo->bas->st_mal == 'true' or $baseInfo->bas->st_mip == 'true') ? S_GF . '=' .  S_MALBAKAT : '' ?>
                        <?php echo $baseInfo->bas->st_skott_t == 'true' ? S_S . '=' .  S_SKOTTTOTALT : '' ?>
                        <?php echo $baseInfo->bas->st_skott_m == 'true' ? S_SOG . '=' .  S_SKOTTPAMALSHOTSONGOAL : '' ?>
                        <?php echo $baseInfo->bas->st_tekn == 'true' ? S_FW . '=' .  S_VUNNATEKN : '' ?>
                        <?php echo $baseInfo->bas->st_tekn == 'true' ? S_FL . '=' .  S_FORLTEKN : '' ?>
                        <?php echo $baseInfo->bas->st_brytn == 'true' ? S_BRYTN . '=' .  S_BRYTNINGAR : '' ?>
                        <?php echo $baseInfo->bas->st_straffs == 'true' ? S_PS . '=' .  S_STRAFFAR : '' ?>
                        <?php echo $baseInfo->bas->st_straffm == 'true' ? S_PSG . '=' .  S_STRAFFMAL : '' ?>
                    </i></small>
                <?php echo ($baseInfo->bas->prot_typ < 3) ? '' : '-->' ?>

            </div> <!-- tab-2 -->

            <!-- #### TAB 3 #### -->
            <div id="tab_3" class="tab-pane fade">
                <?php echo ($baseInfo->bas->prot_typ < 3) ? '' : '<!--' ?>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th><?php echo S_NR ?></th>
                                <th><?php echo S_SPELARE ?></th>
                                <th><?php echo S_M_K ?></th>
                                <th><?php echo $baseInfo->bas->st_mip == 'true' ? S_MIP : '' ?></th>
                                <th><?php echo S_G ?></th>
                                <th><?php echo $baseInfo->bas->st_ass == 'true' ? S_A : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_ass == 'true' ? S_PTS : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_utv == 'true' ? S_PIM : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_mal == 'true' ? S_GF : '' ?></th>
                                <th><?php echo ($baseInfo->bas->st_mal == 'true' or $baseInfo->bas->st_mip == 'true') ? S_GA : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_skott_t == 'true' ? S_S : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_skott_m == 'true' ? S_SOG : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_tekn == 'true' ? S_FW : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_tekn == 'true' ? S_FL : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_brytn == 'true' ? S_BRYTN : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_gulkort == 'true' ? S_GULAKORT : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_rodkort == 'true' ? S_RODAKORT : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_straffs == 'true' ? S_PS : '' ?></th>
                                <th><?php echo $baseInfo->bas->st_straffm == 'true' ? S_PSG : '' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php render($awaylineup, array('view' => '_lineup', 'baseInfo' => $baseInfo)) ?>
                        </tbody>
                    </table>
                </div>
                <small><i>
                        <?php echo $baseInfo->bas->st_mip == 'true' ? S_MIP . '=' .  S_SPELADTIDMALVAKTERMIP : '' ?>
                        <?php echo S_G ?>=<?php echo S_MALGOALS ?>
                        <?php echo $baseInfo->bas->st_ass == 'true' ? S_A . '=' . S_ASSIST : '' ?>
                        <?php echo $baseInfo->bas->st_ass == 'true' ? S_PTS . '=' . S_POANGPOINTS : '' ?>
                        <?php echo $baseInfo->bas->st_utv == 'true' ? S_PIM . '=' . S_UTVISNINGPENALTIESINMINUTESANDSECONDS : '' ?>
                        <?php echo $baseInfo->bas->st_mal == 'true' ? S_GA . '=' . S_MALFRAMAT : '' ?>
                        <?php echo ($baseInfo->bas->st_mal == 'true' or $baseInfo->bas->st_mip == 'true') ? S_GF . '=' .  S_MALBAKAT : '' ?>
                        <?php echo $baseInfo->bas->st_skott_t == 'true' ? S_S . '=' .  S_SKOTTTOTALT : '' ?>
                        <?php echo $baseInfo->bas->st_skott_m == 'true' ? S_SOG . '=' .  S_SKOTTPAMALSHOTSONGOAL : '' ?>
                        <?php echo $baseInfo->bas->st_tekn == 'true' ? S_FW . '=' .  S_VUNNATEKN : '' ?>
                        <?php echo $baseInfo->bas->st_tekn == 'true' ? S_FL . '=' .  S_FORLTEKN : '' ?>
                        <?php echo $baseInfo->bas->st_brytn == 'true' ? S_BRYTN . '=' .  S_BRYTNINGAR : '' ?>
                        <?php echo $baseInfo->bas->st_straffs == 'true' ? S_PS . '=' .  S_STRAFFAR : '' ?>
                        <?php echo $baseInfo->bas->st_straffm == 'true' ? S_PSG . '=' .  S_STRAFFMAL : '' ?>
                    </i></small>
                <?php echo ($baseInfo->bas->prot_typ < 3) ? '' : '-->' ?>
            </div> <!-- tab-3 -->

        </div> <!-- tab-content -->

    </div><!-- /.content -->
</div>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>