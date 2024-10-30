<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="container">
        <div class="content">
                <h2><?php echo S_SPELARSTATISTIK ?></h2>

                <ul class="nav nav-pills" role="tablist">
                        <li role="presentation" <?php echo ($_GET['sort'] == "points" ? 'class="active"' : '') ?>><a href="?playerstat&home=<?php echo $_GET['home'] ?>&scope=<?php echo $_GET['scope'] ?>&team=<?php echo $_GET['team'] ?>&sort=points&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_POANG ?></a></li>
                        <li role="presentation" <?php echo ($_GET['sort'] == "goals" ? 'class="active"' : '') ?>><a href="?playerstat&home=<?php echo $_GET['home'] ?>&scope=<?php echo $_GET['scope'] ?>&team=<?php echo $_GET['team'] ?>&sort=goals&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_MAL ?></a></li>
                        <li role="presentation" <?php echo ($_GET['sort'] == "assists" ? 'class="active"' : '') ?>><a href="?playerstat&home=<?php echo $_GET['home'] ?>&scope=<?php echo $_GET['scope'] ?>&team=<?php echo $_GET['team'] ?>&sort=assists&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_ASSIST ?></a></li>
                        <li role="presentation"><a href="?playerhighlights&home=<?php echo $_GET['home'] ?>&scope=<?php echo $_GET['scope'] ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_HIGHLIGHTS ?></a></li>
                </ul>
                <br>
                <ul class="nav nav-pills" role="tablist">
                        <li role="presentation" <?php echo ($_GET['scope'] == "all" ? 'class="active"' : '') ?>><a href="?playerstat&home=<?php echo $_GET['home'] ?>&scope=all&sort=<?php echo $_GET['sort']; ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_SAMTLIGA ?></a></li>
                        <?php foreach ($classes as $x) {
                                echo '<li role="presentation" ' . ($x->grp_nr == $_GET['scope'] ? 'class="active"' : '') . '><a href="?playerstat&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '&sort=' . $_GET['sort'] . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $x->grp_nr . '</a></li>';
                        } ?>
                </ul>
                <br>

                <div class="table-responsive">
                        <table class="table table-condensed table-striped">
                                <thead>
                                        <tr>
                                                <th><?php echo S_SPELARE ?></th>
                                                <th><?php echo S_LAG ?></th>
                                                <th><?php echo S_KLASS ?></th>
                                                <th title="<?php echo S_ANTALSPELADEMATCHERGAMESPLAYED ?>"><?php echo S_GP ?></th>
                                                <th title="<?php echo S_MALGOALS ?>"><?php echo S_G ?></th>
                                                <?php echo ($baseInfo->bas->st_ass == 'true') ? "" : "<!--" ?>
                                                <th title="<?php echo S_ASSIST ?>"><?php echo S_A ?></th>
                                                <th title="<?php echo S_POANGPOINTS ?>"><?php echo S_PTS ?></th>
                                                <?php echo ($baseInfo->bas->st_ass == 'true') ? "" : "-->" ?>
                                                <th title="<?php echo S_POANG_MTCH ?>"><i><?php echo S_PTS_GP ?></i></th>
                                                <?php echo ($baseInfo->bas->st_utv == 'true') ? "" : "<!--" ?>
                                                <th title="<?php echo S_UTVISNINGPENALTIESINMINUTESANDSECONDS ?>"><?php echo S_PIM ?></th>
                                                <th title="<?php echo S_PIM_GP ?>"><i><?php echo S_PIM_GP ?></i></th>
                                                <?php echo ($baseInfo->bas->st_utv == 'true') ? "" : "-->" ?>
                                                <?php echo ($baseInfo->bas->prot_typ == 1 and $baseInfo->bas->st_utv == 'true') ? "" : "<!--" ?>
                                                <th title="<?php echo S_POWERPLAYMALPOWERPLAYGOALS ?>"><?php echo S_PPG ?></th>
                                                <th title="<?php echo S_POWERPLAYASSISTPOWERPLAYASSISTS ?>"><?php echo S_PPA ?></th>
                                                <th title="<?php echo S_BOXPLAYMALSHORTHANDEDGOALS ?>"><?php echo S_SHG ?></th>
                                                <th title="<?php echo S_BOXPLAYASSISTSHORTHANDEDASSISTS ?>"><?php echo S_SHA ?></th>
                                                <?php echo ($baseInfo->bas->prot_typ == 1 and $baseInfo->bas->st_utv == 'true') ? "" : "-->" ?>
                                                <?php echo ($baseInfo->bas->prot_typ == 1) ? "" : "<!--" ?>
                                                <th title="<?php echo S_MALETSOMGAVSEGERGAMEWINNINGGOAL ?>"><?php echo S_GWG ?></th>
                                                <th title="<?php echo S_MALETSOMGAVOAVGJORTGAMETYINGGOAL ?>"><?php echo S_GTG ?></th>
                                                <?php echo ($baseInfo->bas->prot_typ == 1) ? "" : "-->" ?>
                                                <?php echo ($baseInfo->bas->st_gulkort == 'true') ? "" : "<!--" ?>
                                                <th title="<?php echo S_GULTKORT ?>"><?php echo S_GULAKORT ?></th>
                                                <?php echo ($baseInfo->bas->st_gulkort == 'true') ? "" : "-->" ?>
                                                <?php echo ($baseInfo->bas->st_rodkort == 'true') ? "" : "<!--" ?>
                                                <th title="<?php echo S_ROTTKORT ?>"><?php echo S_RODAKORT ?></th>
                                                <?php echo ($baseInfo->bas->st_rodkort == 'true') ? "" : "-->" ?>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php render($playerstat, array('view' => '_playerstat', 'baseInfo' => $baseInfo)) ?>
                                </tbody>
                        </table>
                </div>
                <small><i>
                                <?php echo S_GP ?>=<?php echo S_ANTALSPELADEMATCHERGAMESPLAYED ?>,
                                <?php echo S_G ?>=<?php echo S_MALGOALS ?>,
                                <?php echo S_A ?>=<?php echo S_ASSIST ?>,
                                <?php echo S_PTS ?>=<?php echo S_POANGPOINTS ?>,
                                <?php echo S_PIM ?>=<?php echo S_UTVISNINGPENALTIESINMINUTESANDSECONDS ?>
                                <?php echo S_PPG ?>=<?php echo S_POWERPLAYMALPOWERPLAYGOALS ?>,
                                <?php echo S_PPA ?>=<?php echo S_POWERPLAYASSISTPOWERPLAYASSISTS ?>,
                                <?php echo S_SHG ?>=<?php echo S_BOXPLAYMALSHORTHANDEDGOALS ?>,
                                <?php echo S_SHA ?>=<?php echo S_BOXPLAYASSISTSHORTHANDEDASSISTS ?>,
                                <?php echo S_GWG ?>=<?php echo S_MALETSOMGAVSEGERGAMEWINNINGGOAL ?>,
                                <?php echo S_GTG ?>=<?php echo S_MALETSOMGAVOAVGJORTGAMETYINGGOAL ?>
                        </i></small>

        </div><!-- /.content -->
</div>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>