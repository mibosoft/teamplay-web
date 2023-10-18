<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="content">
        <h2><?php echo S_SPELARSTATISTIK ?></h2>

        <ul class="nav nav-pills" role="tablist">
                <li role="presentation"><a href="?playerstat&home=<?php echo $_GET['home'] ?>&scope=<?php echo $_GET['scope'] ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_POANGLIGA ?></a></li>
                <li role="presentation" class="active"><a href="?playerhighlights&home=<?php echo $_GET['home'] ?>&scope=<?php echo $_GET['scope'] ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_HIGHLIGHTS ?></a></li>
        </ul>
        <br>
        <ul class="nav nav-pills" role="tablist">
                <li role="presentation" <?php echo ($_GET['scope'] == "all" ? 'class="active"' : '') ?>><a href="?playerhighlights&home=<?php echo $_GET['home'] ?>&scope=all&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_SAMTLIGA ?></a></li>
                <?php foreach ($classes as $x) {
                        echo '<li role="presentation" ' . ($x->grp_nr == $_GET['scope'] ? 'class="active"' : '') . '><a href="?playerhighlights&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $x->grp_nr . '</a></li>';
                } ?>
        </ul>
        <br>
        
        <h3><?php echo S_FLESTPOANG ?></h3>
        <div class="table-responsive">
                <table class="table table-condensed table-striped">
                        <thead>
                                <tr>
                                        <th><?php echo S_MATCHNR ?></th>
                                        <th><?php echo S_SPELARE ?></th>
                                        <th><?php echo S_LAG ?></th>
                                        <th><?php echo S_KLASS ?></th>
                                        <th title="<?php echo S_POANGPOINTS ?>"><?php echo S_POANG ?></th>
                                </tr>
                        </thead>
                        <tbody>
                                <?php render($playerpoints, array('view' => '_playerhighpoints', 'baseInfo' => $baseInfo)) ?>
                        </tbody>
                </table>
        </div>

        <h3><?php echo S_FLESTMAL ?></h3>
        <div class="table-responsive">
                <table class="table table-condensed table-striped">
                        <thead>
                                <tr>
                                        <th><?php echo S_MATCHNR ?></th>
                                        <th><?php echo S_SPELARE ?></th>
                                        <th><?php echo S_LAG ?></th>
                                        <th><?php echo S_KLASS ?></th>
                                        <th title="<?php echo S_MAL?>"><?php echo S_MAL ?></th>
                                </tr>
                        </thead>
                        <tbody>
                                <?php render($playergoals, array('view' => '_playerhighgoals', 'baseInfo' => $baseInfo)) ?>
                        </tbody>
                </table>
        </div>

        <h3><?php echo S_FLESTASSIST ?></h3>
        <div class="table-responsive">
                <table class="table table-condensed table-striped">
                        <thead>
                                <tr>
                                        <th><?php echo S_MATCHNR ?></th>
                                        <th><?php echo S_SPELARE ?></th>
                                        <th><?php echo S_LAG ?></th>
                                        <th><?php echo S_KLASS ?></th>
                                        <th title="<?php echo S_ASSIST?>"><?php echo S_ASSIST ?></th>
                                </tr>
                        </thead>
                        <tbody>
                                <?php render($playerassists, array('view' => '_playerhighassists', 'baseInfo' => $baseInfo)) ?>
                        </tbody>
                </table>
        </div>

</div><!-- /.content -->

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>